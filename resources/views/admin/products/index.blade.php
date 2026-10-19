@extends('layouts.admin')

@section('title', 'Produk & Layanan')
@section('heading', 'Produk & Layanan')

@section('content')

@include('admin.partials.animations')

<style>
    .product-page {
        color: #172b4d;
    }

    .product-page .admin-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 28px;
    }

    .product-page .admin-heading h1 {
        margin-bottom: 7px;
        color: #142746;
        font-size: clamp(25px, 3vw, 30px);
        font-weight: 750;
        letter-spacing: -1px;
    }

    .product-page .admin-heading p {
        margin: 0;
        color: #8491a7;
        font-size: 14px;
    }

    .product-create-btn {
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

    .product-create-btn:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(37, 99, 235, .25);
    }

    .product-panel {
        overflow: hidden;
        border: 1px solid #e8edf5;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 10px 35px rgba(25, 48, 84, .045);
    }

    .product-panel-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        padding: 24px 28px;
        border-bottom: 1px solid #edf1f7;
    }

    .product-panel-title {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .product-panel-icon {
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

    .product-panel-title h5 {
        margin: 0 0 4px;
        color: #172b4d;
        font-size: 16px;
        font-weight: 750;
    }

    .product-panel-title p {
        margin: 0;
        color: #8b97aa;
        font-size: 12px;
    }

    .product-total {
        padding: 8px 12px;
        border: 1px solid #e5edff;
        border-radius: 10px;
        background: #f5f8ff;
        color: #3568cf;
        font-size: 12px;
        font-weight: 650;
    }

    .product-table-wrap {
        overflow-x: auto;
    }

    .product-modern-table {
        width: 100%;
        min-width: 850px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .product-modern-table thead th {
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

    .product-modern-table thead th:first-child,
    .product-modern-table tbody td:first-child {
        padding-left: 28px;
    }

    .product-modern-table thead th:last-child,
    .product-modern-table tbody td:last-child {
        padding-right: 28px;
    }

    .product-modern-table tbody td {
        padding: 19px 14px;
        border-bottom: 1px solid #f0f3f8;
        vertical-align: middle;
    }

    .product-modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    .product-modern-table tbody tr {
        transition: background .2s ease;
    }

    .product-modern-table tbody tr:hover {
        background: #fafcff;
    }

    .product-photo-col {
        width: 125px;
    }

    .product-category-col {
        width: 145px;
    }

    .product-status-col {
        width: 115px;
    }

    .product-featured-col {
        width: 125px;
    }

    .product-action-col {
        width: 155px;
    }

    .product-photo {
        display: block;
        width: 92px;
        height: 68px;
        object-fit: cover;
        border: 1px solid #e8edf5;
        border-radius: 12px;
        background: #f3f6fb;
        transition: transform .2s ease;
    }

    .product-modern-table tbody tr:hover .product-photo {
        transform: scale(1.035);
    }

    .product-photo-empty {
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

    .product-photo-empty span {
        font-size: 21px;
        line-height: 1;
    }

    .product-photo-empty small {
        font-size: 10px;
    }

    .product-info {
        min-width: 250px;
        max-width: 400px;
    }

    .product-info-title {
        display: block;
        margin-bottom: 6px;
        color: #1b2c49;
        font-size: 13px;
        font-weight: 750;
        line-height: 1.55;
        overflow-wrap: anywhere;
    }

    .product-info-description {
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

    .product-category {
        display: inline-block;
        max-width: 140px;
        color: #53627a;
        font-size: 12px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .product-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 11px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 750;
        white-space: nowrap;
    }

    .product-status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    .product-status-public {
        background: #e8f8ef;
        color: #168454;
    }

    .product-status-draft {
        background: #f0f2f6;
        color: #738096;
    }

    .product-featured {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #53627a;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .product-featured-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #2563eb;
    }

    .product-not-featured {
        color: #a0aabc;
        font-size: 13px;
    }

    .product-action-group {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 7px;
        white-space: nowrap;
    }

    .product-action-group form {
        margin: 0;
    }

    .product-btn {
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

    .product-btn-edit {
        border-color: #d6e4ff;
        background: #f5f8ff;
        color: #2563eb;
    }

    .product-btn-edit:hover {
        border-color: #2563eb;
        background: #2563eb;
        color: #fff;
    }

    .product-btn-delete {
        border-color: #ffe0e0;
        background: #fff6f6;
        color: #df454b;
    }

    .product-btn-delete:hover {
        border-color: #e5484d;
        background: #e5484d;
        color: #fff;
    }

    .product-empty {
        padding: 60px 20px;
        text-align: center;
    }

    .product-empty-icon {
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

    .product-empty h6 {
        margin-bottom: 7px;
        color: #172b4d;
        font-size: 15px;
        font-weight: 750;
    }

    .product-empty p {
        margin-bottom: 18px;
        color: #8995a9;
        font-size: 13px;
    }

    .product-pagination {
        padding: 20px 28px;
        border-top: 1px solid #edf1f7;
    }

    .product-pagination nav p {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .product-page .admin-heading {
            align-items: flex-start;
        }

        .product-panel-top {
            padding: 20px;
        }

        .product-modern-table thead th:first-child,
        .product-modern-table tbody td:first-child {
            padding-left: 20px;
        }

        .product-modern-table thead th:last-child,
        .product-modern-table tbody td:last-child {
            padding-right: 20px;
        }

        .product-pagination {
            padding: 18px 20px;
        }
    }
</style>

<div class="product-page">

    <div class="admin-heading">
        <div>
            <h1>Produk &amp; Layanan</h1>
            <p>Kelola produk dan layanan yang ditampilkan di website perusahaan.</p>
        </div>

        <a
            href="{{ route('admin.produk.create') }}"
            class="product-create-btn"
        >
            <span>＋</span>
            Tambah produk
        </a>
    </div>

    <div class="product-panel">

        <div class="product-panel-top">
            <div class="product-panel-title">
                <div class="product-panel-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div>
                    <h5>Daftar Produk &amp; Layanan</h5>
                    <p>Kelola informasi, status publikasi, dan produk unggulan.</p>
                </div>
            </div>

            <div class="product-total">
                {{ $items->total() }} produk
            </div>
        </div>

        <div class="product-table-wrap">
            <table class="table product-modern-table">
                <thead>
                    <tr>
                        <th class="product-photo-col">Foto</th>
                        <th>Nama Produk</th>
                        <th class="product-category-col">Kategori</th>
                        <th class="product-status-col">Status</th>
                        <th class="product-featured-col">Unggulan</th>
                        <th class="product-action-col text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                @if($item->image)
                                    <img
                                        src="{{ asset('storage/' . ltrim($item->image, '/')) }}"
                                        alt="{{ $item->name }}"
                                        class="product-photo"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="product-photo-empty">
                                        <span>▧</span>
                                        <small>Tanpa foto</small>
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div class="product-info">
                                    <strong class="product-info-title">
                                        {{ $item->name }}
                                    </strong>

                                    @if($item->short_description)
                                        <p class="product-info-description">
                                            {{ $item->short_description }}
                                        </p>
                                    @endif
                                </div>
                            </td>

                            <td>
                                <span class="product-category">
                                    {{ $item->category ?: '—' }}
                                </span>
                            </td>

                            <td>
                                @if($item->is_published)
                                    <span class="product-status product-status-public">
                                        <span class="product-status-dot"></span>
                                        Publik
                                    </span>
                                @else
                                    <span class="product-status product-status-draft">
                                        <span class="product-status-dot"></span>
                                        Draft
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($item->is_featured)
                                    <span class="product-featured">
                                        <span class="product-featured-dot"></span>
                                        Unggulan
                                    </span>
                                @else
                                    <span class="product-not-featured">—</span>
                                @endif
                            </td>

                            <td>
                                <div class="product-action-group">
                                    <a
                                        href="{{ route('admin.produk.edit', $item) }}"
                                        class="product-btn product-btn-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.produk.destroy', $item) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="product-btn product-btn-delete"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="product-empty">
                                    <div class="product-empty-icon">
                                        <i class="bi bi-box-seam"></i>
                                    </div>

                                    <h6>Belum ada produk atau layanan</h6>

                                    <p>
                                        Tambahkan produk pertama agar informasi layanan
                                        perusahaan dapat dikelola dari halaman ini.
                                    </p>

                                    <a
                                        href="{{ route('admin.produk.create') }}"
                                        class="product-create-btn"
                                    >
                                        ＋ Tambah produk
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
            <div class="product-pagination">
                {{ $items->links() }}
            </div>
        @endif

    </div>

</div>

@endsection