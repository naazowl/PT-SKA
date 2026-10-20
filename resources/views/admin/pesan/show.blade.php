@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('heading', 'Pesan Masuk')

@section('content')

@include('admin.partials.message-styles')

<div class="msg-page">

    <div class="admin-heading">
        <div>
            <h1>Detail Pesan</h1>
            <p>Pesan dari {{ $item->name }}, diterima {{ $item->created_at->format('d M Y, H:i') }}.</p>
        </div>

        <a href="{{ route('admin.pesan.index') }}" class="msg-btn msg-btn-neutral" style="padding:12px 19px;font-size:13px;">
            ← Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="msg-alert msg-alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <div class="msg-panel">

        <div class="msg-panel-top">
            <div class="msg-panel-title">
                <div class="msg-panel-icon">{{ strtoupper(mb_substr($item->name, 0, 1)) }}</div>
                <div>
                    <h5>{{ $item->name }}</h5>
                    <p>{{ $item->email }}</p>
                </div>
            </div>

            @if($item->is_read)
                <span class="msg-status msg-status-read"><span class="msg-status-dot"></span> Dibaca</span>
            @else
                <span class="msg-status msg-status-new"><span class="msg-status-dot"></span> Baru</span>
            @endif
        </div>

        <div class="msg-detail-body">

            <div class="msg-detail-meta">
                <div>
                    <span class="msg-meta-label">Nama</span>
                    <span class="msg-meta-value">{{ $item->name }}</span>
                </div>
                <div>
                    <span class="msg-meta-label">Email</span>
                    <span class="msg-meta-value">
                        <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                    </span>
                </div>
                <div>
                    <span class="msg-meta-label">Diterima</span>
                    <span class="msg-meta-value">{{ $item->created_at->format('d M Y, H:i') }}</span>
                </div>
                @if($item->ip_address)
                    <div>
                        <span class="msg-meta-label">IP Address</span>
                        <span class="msg-meta-value">{{ $item->ip_address }}</span>
                    </div>
                @endif
            </div>

            <h2 class="msg-detail-subject">{{ $item->subject }}</h2>

            <div class="msg-detail-text">{{ $item->message }}</div>

            <div class="msg-detail-actions">
               
                        <a class="msg-btn-main"
                           href="https://mail.google.com/mail/?view=cm&fs=1&to={{ rawurlencode($item->email) }}&su={{ rawurlencode('Re: ' . $item->subject) }}"
                           target="_blank"
                           rel="noopener noreferrer">
                            <i class="bi bi-envelope me-1"></i>
                            Balas via email
                        </a>

                <form method="POST" action="{{ route('admin.pesan.toggle', $item) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="msg-btn msg-btn-neutral">
                        {{ $item->is_read ? 'Tandai belum dibaca' : 'Tandai sudah dibaca' }}
                    </button>
                </form>

                <form method="POST"
                      action="{{ route('admin.pesan.destroy', $item) }}"
                      onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="msg-btn msg-btn-delete">Hapus</button>
                </form>
            </div>

        </div>
    </div>

</div>

@endsection