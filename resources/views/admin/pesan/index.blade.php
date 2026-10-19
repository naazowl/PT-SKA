@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('heading', 'Pesan Masuk')

@section('content')

@include('admin.partials.message-styles')
@include('admin.partials.animations')

<div class="msg-page">

    <div class="admin-heading">
        <div>
            <h1>Pesan Masuk</h1>
            <p>Lihat dan kelola pesan yang dikirim pengunjung lewat halaman kontak.</p>
        </div>

        <a href="{{ route('admin.profile.edit') }}" class="msg-btn-main">
            <span>✎</span>
            Ubah info kontak
        </a>
    </div>

    @if (session('success'))
        <div class="msg-alert msg-alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <div class="msg-panel">

        <div class="msg-panel-top">
            <div class="msg-panel-title">
                <div class="msg-panel-icon">✉</div>
                <div>
                    <h5>Daftar Pesan</h5>
                    <p>Pesan baru ditandai agar mudah dikenali.</p>
                </div>
            </div>

            <div class="msg-top-badges">
                @if($unreadCount > 0)
                    <div class="msg-total msg-total-unread">{{ $unreadCount }} belum dibaca</div>
                @endif
                <div class="msg-total">{{ $items->total() }} pesan</div>
            </div>
        </div>

        <div class="msg-toolbar">
            <div class="msg-tabs">
                <a href="{{ route('admin.pesan.index', ['q' => $search]) }}"
                   class="msg-tab {{ $filter === 'all' ? 'active' : '' }}">Semua</a>
                <a href="{{ route('admin.pesan.index', ['status' => 'unread', 'q' => $search]) }}"
                   class="msg-tab {{ $filter === 'unread' ? 'active' : '' }}">Belum dibaca</a>
                <a href="{{ route('admin.pesan.index', ['status' => 'read', 'q' => $search]) }}"
                   class="msg-tab {{ $filter === 'read' ? 'active' : '' }}">Sudah dibaca</a>
            </div>

            <form method="GET" action="{{ route('admin.pesan.index') }}" class="msg-search">
                @if($filter !== 'all')
                    <input type="hidden" name="status" value="{{ $filter }}">
                @endif
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama, email, atau subjek...">
                <button type="submit">Cari</button>
            </form>
        </div>

        <div class="msg-table-wrap">
            <table class="table msg-table">
                <thead>
                    <tr>
                        <th class="msg-sender-col">Pengirim</th>
                        <th>Pesan</th>
                        <th class="msg-date-col">Tanggal</th>
                        <th class="msg-status-col">Status</th>
                        <th class="msg-action-col text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($items as $item)
                        <tr class="{{ $item->is_read ? '' : 'is-unread' }}">
                            <td>
                                <div class="msg-sender">
                                    <div class="msg-avatar">{{ strtoupper(mb_substr($item->name, 0, 1)) }}</div>
                                    <div>
                                        <span class="msg-sender-name">{{ $item->name }}</span>
                                        <span class="msg-sender-email">{{ $item->email }}</span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="msg-info">
                                    <a href="{{ route('admin.pesan.show', $item) }}"
                                       class="msg-info-subject"
                                       style="text-decoration:none;">
                                        {{ $item->subject }}
                                    </a>
                                    <p class="msg-info-excerpt">{{ $item->message }}</p>
                                </div>
                            </td>

                            <td class="msg-date">
                                {{ $item->created_at->format('d M Y') }}
                                <small>{{ $item->created_at->format('H:i') }} · {{ $item->created_at->diffForHumans() }}</small>
                            </td>

                            <td>
                                @if($item->is_read)
                                    <span class="msg-status msg-status-read">
                                        <span class="msg-status-dot"></span> Dibaca
                                    </span>
                                @else
                                    <span class="msg-status msg-status-new">
                                        <span class="msg-status-dot"></span> Baru
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="msg-action-group">
                                    <a href="{{ route('admin.pesan.show', $item) }}"
                                       class="msg-btn msg-btn-view">Lihat</a>

                                    <form method="POST"
                                          action="{{ route('admin.pesan.destroy', $item) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="msg-btn msg-btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="msg-empty">
                                    <div class="msg-empty-icon">✉</div>
                                    <h6>
                                        @if($search !== '' || $filter !== 'all')
                                            Pesan tidak ditemukan
                                        @else
                                            Belum ada pesan
                                        @endif
                                    </h6>
                                    <p>
                                        @if($search !== '' || $filter !== 'all')
                                            Coba ubah kata kunci atau filter pencarian.
                                        @else
                                            Pesan dari formulir kontak website akan muncul di sini.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
            <div class="msg-pagination">
                {{ $items->links() }}
            </div>
        @endif

    </div>

</div>

@endsection