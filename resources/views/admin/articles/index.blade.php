@extends('layouts.admin')

@section('title', 'Artikel')
@section('heading', 'Artikel')

@section('content')

@include('admin.partials.animations')

<style>
    .article-page {
        color: #172b4d;
    }

    .article-page .admin-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 28px;
    }

    .article-page .admin-heading h1 {
        margin-bottom: 7px;
        color: #142746;
        font-size: clamp(25px, 3vw, 30px);
        font-weight: 750;
        letter-spacing: -1px;
    }

    .article-page .admin-heading p {
        margin: 0;
        color: #8491a7;
        font-size: 14px;
    }

    .article-create-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 12px 19px;
        border: 0;
        border-radius: 12px;
        background: linear-gradient(135deg, #2878ff, #155eef);
        color: #fff;
        font-size: 13px;
        font-weight: 650;
        text-decoration: none;
        box-shadow: 0 7px 16px rgba(37, 99, 235, .18);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .article-create-btn:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(37, 99, 235, .25);
    }

    .article-panel {
        overflow: hidden;
        border: 1px solid #e8edf5;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 10px 35px rgba(25, 48, 84, .045);
    }

    .article-panel-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        padding: 24px 28px;
        border-bottom: 1px solid #edf1f7;
    }

    .article-panel-title {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .article-panel-icon {
        display: flex;
        width: 44px;
        height: 44px;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 14px;
        background: #edf4ff;
        color: #2563eb;
        font-size: 21px;
    }

    .article-panel-title h5 {
        margin: 0 0 4px;
        color: #172b4d;
        font-size: 16px;
        font-weight: 750;
    }

    .article-panel-title p {
        margin: 0;
        color: #8b97aa;
        font-size: 12px;
    }

    .article-total {
        padding: 8px 12px;
        border: 1px solid #e5edff;
        border-radius: 10px;
        background: #f5f8ff;
        color: #3568cf;
        font-size: 12px;
        font-weight: 650;
    }

    .article-table-wrap {
        overflow-x: auto;
    }

    .article-modern-table {
        width: 100%;
        min-width: 790px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .article-modern-table thead th {
        padding: 16px 14px;
        border-bottom: 1px solid #edf1f7;
        background: #fafbfe;
        color: #8b97aa;
        font-size: 10px;
        font-weight: 750;
        letter-spacing: 1px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .article-modern-table thead th:first-child,
    .article-modern-table tbody td:first-child {
        padding-left: 28px;
    }

    .article-modern-table thead th:last-child,
    .article-modern-table tbody td:last-child {
        padding-right: 28px;
    }

    .article-modern-table tbody td {
        padding: 19px 14px;
        border-bottom: 1px solid #f0f3f8;
        vertical-align: middle;
    }

    .article-modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    .article-modern-table tbody tr {
        transition: background .2s ease;
    }

    .article-modern-table tbody tr:hover {
        background: #fafcff;
    }

    .article-photo-col {
        width: 125px;
    }

    .article-date-col {
        width: 130px;
    }

    .article-status-col {
        width: 120px;
    }

    .article-action-col {
        width: 155px;
    }

    .article-photo {
        display: block;
        width: 92px;
        height: 68px;
        object-fit: cover;
        border: 1px solid #e8edf5;
        border-radius: 12px;
        background: #f3f6fb;
        transition: transform .2s ease;
    }

    .article-modern-table tbody tr:hover .article-photo {
        transform: scale(1.035);
    }

    .article-photo-empty {
        display: flex;
        width: 92px;
        height: 68px;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        border: 1px dashed #dce4f0;
        border-radius: 12px;
        background: #f6f8fc;
        color: #9aa7bb;
    }

    .article-photo-empty span {
        font-size: 21px;
        line-height: 1;
    }

    .article-photo-empty small {
        font-size: 10px;
    }

    .article-info {
        min-width: 260px;
        max-width: 440px;
    }

    .article-info-title {
        display: block;
        margin-bottom: 6px;
        color: #1b2c49;
        font-size: 13px;
        font-weight: 750;
        line-height: 1.55;
        overflow-wrap: anywhere;
    }

    .article-info-excerpt {
        display: -webkit-box;
        overflow: hidden;
        margin: 0;
        color: #8995a9;
        font-size: 12px;
        line-height: 1.65;
        overflow-wrap: anywhere;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    .article-date {
        color: #53627a;
        font-size: 12px;
        font-weight: 550;
        white-space: nowrap;
    }

    .article-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 11px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 750;
        white-space: nowrap;
    }

    .article-status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    .article-status-public {
        background: #e8f8ef;
        color: #168454;
    }

    .article-status-draft {
        background: #f0f2f6;
        color: #738096;
    }

    .article-action-group {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 7px;
        white-space: nowrap;
    }

    .article-action-group form {
        margin: 0;
    }

    .article-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 48px;
        padding: 8px 11px;
        border: 1px solid transparent;
        border-radius: 9px;
        background: #fff;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: all .18s ease;
    }

    .article-btn-edit {
        border-color: #d6e4ff;
        background: #f5f8ff;
        color: #2563eb;
    }

    .article-btn-edit:hover {
        border-color: #2563eb;
        background: #2563eb;
        color: #fff;
    }

    .article-btn-delete {
        border-color: #ffe0e0;
        background: #fff6f6;
        color: #df454b;
    }

    .article-btn-delete:hover {
        border-color: #e5484d;
        background: #e5484d;
        color: #fff;
    }

    .article-empty {
        padding: 60px 20px;
        text-align: center;
    }

    .article-empty-icon {
        display: flex;
        width: 60px;
        height: 60px;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        border-radius: 18px;
        background: #edf4ff;
        color: #2563eb;
        font-size: 27px;
    }

    .article-empty h6 {
        margin-bottom: 7px;
        color: #172b4d;
        font-size: 15px;
        font-weight: 750;
    }

    .article-empty p {
        margin-bottom: 18px;
        color: #8995a9;
        font-size: 13px;
    }

    .article-pagination {
        padding: 20px 28px;
        border-top: 1px solid #edf1f7;
    }

    .article-pagination nav p {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .article-page .admin-heading {
            align-items: flex-start;
        }

        .article-panel-top {
            padding: 20px;
        }

        .article-modern-table thead th:first-child,
        .article-modern-table tbody td:first-child {
            padding-left: 20px;
        }

        .article-modern-table thead th:last-child,
        .article-modern-table tbody td:last-child {
            padding-right: 20px;
        }

        .article-pagination {
            padding: 18px 20px;
        }
    }
</style>

<div class="article-page">

    <div class="admin-heading">
        <div>
            <h1>Artikel & Informasi</h1>
            <p>Kelola berita dan wawasan yang tampil untuk pengunjung.</p>
        </div>

        <a href="{{ route('admin.artikel.create') }}" class="article-create-btn">
            <span>＋</span>
            Tulis artikel
        </a>
    </div>

    <div class="article-panel">

        <div class="article-panel-top">
            <div class="article-panel-title">
                <div class="article-panel-icon">▤</div>
                <div>
                    <h5>Daftar Artikel</h5>
                    <p>Kelola artikel dan status publikasinya.</p>
                </div>
            </div>

            <div class="article-total">
                {{ $items->total() }} artikel
            </div>
        </div>

        <div class="article-table-wrap">
            <table class="table article-modern-table">
                <thead>
                    <tr>
                        <th class="article-photo-col">Foto</th>
                        <th>Judul Artikel</th>
                        <th class="article-date-col">Tanggal</th>
                        <th class="article-status-col">Status</th>
                        <th class="article-action-col text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                @if($item->image)
                                    <img
                                        src="{{ asset('storage/' . ltrim($item->image, '/')) }}"
                                        alt="{{ $item->title }}"
                                        class="article-photo"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="article-photo-empty">
                                        <span>▧</span>
                                        <small>Tanpa foto</small>
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div class="article-info">
                                    <strong class="article-info-title">
                                        {{ $item->title }}
                                    </strong>

                                    @if($item->excerpt)
                                        <p class="article-info-excerpt">
                                            {{ $item->excerpt }}
                                        </p>
                                    @endif
                                </div>
                            </td>

                            <td class="article-date">
                                {{ optional($item->published_at)->format('d M Y') ?? '—' }}
                            </td>

                            <td>
                                @if($item->is_published)
                                    <span class="article-status article-status-public">
                                        <span class="article-status-dot"></span>
                                        Publik
                                    </span>
                                @else
                                    <span class="article-status article-status-draft">
                                        <span class="article-status-dot"></span>
                                        Draft
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="article-action-group">
                                    <a
                                        href="{{ route('admin.artikel.edit', $item) }}"
                                        class="article-btn article-btn-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.artikel.destroy', $item) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus artikel ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="article-btn article-btn-delete"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="article-empty">
                                    <div class="article-empty-icon">▤</div>
                                    <h6>Belum ada artikel</h6>
                                    <p>Tambahkan artikel pertama untuk mengisi website kamu.</p>

                                    <a
                                        href="{{ route('admin.artikel.create') }}"
                                        class="article-create-btn"
                                    >
                                        ＋ Tulis artikel
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
            <div class="article-pagination">
                {{ $items->links() }}
            </div>
        @endif

    </div>

</div>

@endsection