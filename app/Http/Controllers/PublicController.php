<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CompanyProfile;
use App\Models\Gallery;
use App\Models\Product;

class PublicController extends Controller
{
    /**
     * Mengambil profil perusahaan dari database.
     */
    private function company(): CompanyProfile
    {
        return CompanyProfile::current();
    }

    /**
     * Halaman beranda.
     * Hanya produk yang sudah dipublikasikan dan ditandai
     * sebagai produk unggulan yang ditampilkan di beranda.
     */
    public function home()
    {
        return view('public.home', [
            'company' => $this->company(),

            'products' => Product::where('is_published', true)
                ->where('is_featured', true)
                ->latest()
                ->take(3)
                ->get(),

            'articles' => Article::where('is_published', true)
                ->latest()
                ->take(3)
                ->get(),

            'gallery' => Gallery::latest()
                ->take(4)
                ->get(),
        ]);
    }

    /**
     * Halaman profil perusahaan.
     */
    public function profile()
    {
        return view('public.profile', [
            'company' => $this->company(),
        ]);
    }

    /**
     * Halaman semua produk dan layanan yang dipublikasikan.
     * Produk unggulan maupun produk biasa tetap ditampilkan.
     * Maksimal 9 card per halaman.
     */
    public function products()
    {
        return view('public.products', [
            'company' => $this->company(),

            'products' => Product::where('is_published', true)
                ->latest()
                ->paginate(9)
                ->withQueryString(),
        ]);
    }

    /**
     * Detail produk.
     * Produk yang belum dipublikasikan tidak bisa diakses publik.
     */
    public function productDetail(Product $product)
    {
        abort_unless($product->is_published, 404);

        return view('public.product-detail', [
            'company' => $this->company(),
            'product' => $product,
        ]);
    }

    /**
     * Halaman artikel yang sudah dipublikasikan.
     * Maksimal 9 card per halaman.
     */
    public function articles()
    {
        return view('public.articles', [
            'company' => $this->company(),

            'articles' => Article::where('is_published', true)
                ->latest()
                ->paginate(9)
                ->withQueryString(),
        ]);
    }

    /**
     * Detail artikel.
     * Artikel draft tidak bisa diakses publik.
     */
    public function articleDetail(Article $article)
    {
        abort_unless($article->is_published, 404);

        return view('public.article-detail', [
            'company' => $this->company(),
            'article' => $article,
        ]);
    }

    /**
     * Halaman galeri.
     * Maksimal 9 card per halaman.
     */
    public function gallery()
    {
        return view('public.gallery', [
            'company' => $this->company(),

            'gallery' => Gallery::latest()
                ->paginate(9)
                ->withQueryString(),
        ]);
    }

    public function contact()
    {
        return view('public.contact', [
            'company' => $this->company(),
        ]);
    }
}