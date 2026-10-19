<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('status', 'all');
        $search = trim((string) $request->query('q', ''));

        $items = ContactMessage::query()
            ->when($filter === 'unread', fn ($q) => $q->unread())
            ->when($filter === 'read', fn ($q) => $q->read())
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($w) use ($search) {
                    $w->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('subject', 'like', "%{$search}%")
                      ->orWhere('message', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $unreadCount = ContactMessage::unread()->count();

        return view('admin.pesan.index', compact('items', 'filter', 'search', 'unreadCount'));
    }

    public function show(ContactMessage $pesan)
    {
        // Tandai dibaca otomatis saat pesan dibuka
        if (! $pesan->read_at) {
            $pesan->update(['read_at' => now()]);
        }

        return view('admin.pesan.show', ['item' => $pesan]);
    }

    public function toggleRead(ContactMessage $pesan)
    {
        $pesan->update(['read_at' => $pesan->read_at ? null : now()]);

        // Jika baru ditandai belum dibaca, kembali ke daftar
        // supaya tidak langsung ter-auto-read lagi oleh show()
        if (! $pesan->read_at) {
            return redirect()
                ->route('admin.pesan.index')
                ->with('success', 'Pesan ditandai belum dibaca.');
        }

        return back()->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function destroy(ContactMessage $pesan)
    {
        $pesan->delete();

        return redirect()
            ->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}