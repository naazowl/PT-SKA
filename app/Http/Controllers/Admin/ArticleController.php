<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.articles.index', [
            'items' => Article::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.articles.form', [
            'item' => new Article(),
            'action' => route('admin.artikel.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $r)
    {
        $d = $this->validated($r);
        $d['is_published'] = $r->boolean('is_published');

        if ($r->hasFile('image')) {
            $d['image'] = $r->file('image')->store('articles', 'public');
        }

        $d['slug'] = Str::slug($d['title']) . '-' . Str::lower(Str::random(5));
        $d['published_at'] = $d['is_published'] ? now() : null;

        Article::create($d);

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.form', [
            'item' => $article,
            'action' => route('admin.artikel.update', $article),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $r, Article $article)
    {
        $d = $this->validated($r);
        $d['is_published'] = $r->boolean('is_published');

        if ($r->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }

            $d['image'] = $r->file('image')->store('articles', 'public');
        }

        $d['slug'] = Str::slug($d['title']) . '-' . $article->id;

        $d['published_at'] = $d['is_published']
            ? ($article->published_at ?? now())
            : null;

        $article->update($d);

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return back()->with('success', 'Artikel dihapus.');
    }

    private function validated(Request $r): array
    {
        return $r->validate([
            'title' => 'required|string|max:180',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:3072',
            'is_published' => 'required|in:0,1',
        ]);
    }
}
