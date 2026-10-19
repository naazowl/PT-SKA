@extends('layouts.admin')

@section('title', $item->exists ? 'Edit Produk' : 'Tambah Produk')
@section('heading', 'Produk & Layanan')

@section('content')

<style>
    .product-form-page { color: #172b4d; }

    .product-form-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 28px;
    }

    .product-form-heading h1 {
        margin: 0 0 7px;
        color: #142746;
        font-size: clamp(25px, 3vw, 30px);
        font-weight: 750;
        letter-spacing: -1px;
    }

    .product-form-heading p {
        margin: 0;
        color: #8491a7;
        font-size: 14px;
    }

    .product-back-btn,
    .product-cancel-btn,
    .product-submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 43px;
        padding: 11px 18px;
        border: 1px solid transparent;
        border-radius: 11px;
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
        cursor: pointer;
        transition: all .2s ease;
    }

    .product-back-btn,
    .product-cancel-btn {
        border-color: #e0e7f1;
        background: #fff;
        color: #53627a;
    }

    .product-back-btn:hover,
    .product-cancel-btn:hover {
        border-color: #b8ceff;
        background: #f5f8ff;
        color: #2563eb;
    }

    .product-form-panel {
        overflow: hidden;
        border: 1px solid #e8edf5;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 10px 35px rgba(25, 48, 84, .045);
    }

    .product-form-panel-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 24px 28px;
        border-bottom: 1px solid #edf1f7;
    }

    .product-form-icon {
        display: flex;
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: #edf4ff;
        color: #2563eb;
        font-size: 22px;
    }

    .product-form-panel-header h5 {
        margin: 0 0 5px;
        color: #172b4d;
        font-size: 16px;
        font-weight: 750;
    }

    .product-form-panel-header p {
        margin: 0;
        color: #8995a9;
        font-size: 12px;
    }

    .product-form-body { padding: 28px; }

    .product-field { margin-bottom: 23px; }

    .product-field:last-child { margin-bottom: 0; }

    .product-field label,
    .product-field-label {
        display: block;
        margin-bottom: 9px;
        color: #34445e;
        font-size: 13px;
        font-weight: 700;
    }

    .product-required { color: #e5484d; }

    .product-control {
        display: block;
        width: 100%;
        min-height: 46px;
        padding: 12px 14px;
        border: 1px solid #dfe6f0;
        border-radius: 11px;
        outline: none;
        background: #fbfcff;
        color: #263750;
        font-size: 13px;
        line-height: 1.6;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .product-control::placeholder { color: #a1adbf; }

    .product-control:focus {
        border-color: #78a5ff;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .09);
    }

    textarea.product-control {
        min-height: 190px;
        resize: vertical;
    }

    .product-field-hint {
        margin-top: 7px;
        color: #94a0b3;
        font-size: 11px;
        line-height: 1.6;
    }

    .product-divider {
        height: 1px;
        margin: 28px 0;
        background: #edf1f7;
    }

    .product-bottom-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.2fr) minmax(250px, .8fr);
        gap: 24px;
    }

    .product-upload-box {
        display: flex;
        min-height: 155px;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 22px;
        border: 1.5px dashed #cbd8eb;
        border-radius: 14px;
        background: #f9fbff;
        text-align: center;
        transition: border-color .2s ease, background .2s ease;
    }

    .product-upload-box:hover {
        border-color: #7da8ff;
        background: #f4f8ff;
    }

    .product-upload-icon {
        display: flex;
        width: 43px;
        height: 43px;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #e8f0ff;
        color: #2563eb;
        font-size: 22px;
    }

    .product-upload-box strong {
        color: #34445e;
        font-size: 12px;
        font-weight: 750;
    }

    .product-upload-box small {
        color: #8d9ab0;
        font-size: 11px;
    }

    .product-file-input {
        display: block;
        width: 100%;
        max-width: 100%;
        margin-top: 8px;
        color: #64748b;
        font-size: 11px;
    }

    .product-file-input::file-selector-button {
        margin-right: 10px;
        padding: 8px 11px;
        border: 1px solid #dce5f3;
        border-radius: 8px;
        background: #fff;
        color: #3c5b8c;
        font-size: 11px;
        font-weight: 650;
        cursor: pointer;
    }

    .product-preview-wrap {
        margin-top: 17px;
        padding: 12px;
        border: 1px solid #e8edf5;
        border-radius: 13px;
        background: #fff;
    }

    .product-preview-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
        color: #53627a;
        font-size: 11px;
        font-weight: 700;
    }

    .product-preview-status {
        color: #168454;
        font-size: 10px;
        font-weight: 650;
    }

    .product-preview-image {
        display: block;
        width: 100%;
        max-height: 240px;
        object-fit: contain;
        border-radius: 9px;
        background: #f3f6fb;
    }

    .product-preview-empty {
        padding: 20px 10px;
        border: 1px dashed #dce4ef;
        border-radius: 9px;
        background: #f8faff;
        color: #94a0b3;
        font-size: 12px;
        text-align: center;
    }

    .product-option-card {
        padding: 20px;
        border: 1px solid #e5ebf4;
        border-radius: 15px;
        background: #fbfcff;
    }

    .product-option-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 7px;
        color: #263750;
        font-size: 14px;
        font-weight: 750;
    }

    .product-option-title i {
        color: #2563eb;
        font-size: 18px;
    }

    .product-option-description {
        margin-bottom: 18px;
        color: #8995a9;
        font-size: 11px;
        line-height: 1.7;
    }

    .product-status-option {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 10px;
        padding: 14px;
        border: 1px solid #e3e9f2;
        border-radius: 12px;
        background: #fff;
        cursor: pointer;
        transition: all .2s ease;
    }

    .product-status-option:last-child { margin-bottom: 0; }

    .product-status-option:has(input:checked) {
        border-color: #8bb2ff;
        background: #f3f7ff;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, .05);
    }

    .product-status-option input {
        width: 16px;
        height: 16px;
        margin-top: 2px;
        flex-shrink: 0;
        accent-color: #2563eb;
        cursor: pointer;
    }

    .product-status-option strong {
        display: block;
        margin-bottom: 4px;
        color: #34445e;
        font-size: 12px;
        font-weight: 750;
    }

    .product-status-option small {
        display: block;
        color: #8995a9;
        font-size: 11px;
        line-height: 1.6;
    }

    /* Produk unggulan dipisahkan dan menggunakan switch on/off. */
    .product-featured-panel {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-top: 16px;
        padding: 15px;
        border: 1px solid #e3e9f2;
        border-radius: 12px;
        background: #fff;
    }

    .product-featured-text strong {
        display: block;
        margin-bottom: 5px;
        color: #34445e;
        font-size: 12px;
        font-weight: 750;
    }

    .product-featured-text small {
        display: block;
        color: #8995a9;
        font-size: 11px;
        line-height: 1.6;
    }

    .product-featured-switch {
        flex-shrink: 0;
        margin: 0;
        padding: 0;
    }

    .product-featured-switch .form-check-input {
        float: none;
        width: 2.6em;
        height: 1.4em;
        margin: 0;
        border-color: #cbd5e1;
        background-color: #e2e8f0;
        box-shadow: none;
        cursor: pointer;
        transition: background-color .2s ease, border-color .2s ease;
    }

    .product-featured-switch .form-check-input:checked {
        border-color: #2563eb;
        background-color: #2563eb;
    }

    .product-featured-switch .form-check-input:focus {
        border-color: #78a5ff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    .product-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 23px;
    }

    .product-form-footer-note {
        color: #8995a9;
        font-size: 11px;
    }

    .product-form-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .product-submit-btn {
        background: linear-gradient(135deg, #2878ff, #155eef);
        color: #fff;
        box-shadow: 0 6px 14px rgba(37, 99, 235, .17);
    }

    .product-submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 9px 20px rgba(37, 99, 235, .24);
        color: #fff;
    }

    .product-validation-error {
        margin-top: 7px;
        color: #dc3545;
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .product-form-body { padding: 20px; }
        .product-form-panel-header { padding: 20px; }
        .product-bottom-grid { grid-template-columns: 1fr; }
        .product-form-footer { align-items: stretch; }
        .product-form-actions { width: 100%; }

        .product-form-actions a,
        .product-form-actions button { flex: 1; }
    }
</style>

<div class="product-form-page">

    <div class="product-form-heading">
        <div>
            <h1>{{ $item->exists ? 'Edit produk' : 'Tambah produk' }}</h1>
            <p>
                {{ $item->exists
                    ? 'Perbarui informasi, gambar, dan status produk atau layanan.'
                    : 'Tambahkan produk atau layanan baru untuk website perusahaan.' }}
            </p>
        </div>

        <a href="{{ route('admin.produk.index') }}" class="product-back-btn">
            <i class="bi bi-arrow-left"></i>
            Kembali ke produk
        </a>
    </div>

    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @csrf

        @if($method === 'PUT')
            @method('PUT')
        @endif

        <div class="product-form-panel">

            <div class="product-form-panel-header">
                <div class="product-form-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div>
                    <h5>Informasi Produk &amp; Layanan</h5>
                    <p>Lengkapi informasi utama produk dengan jelas.</p>
                </div>
            </div>

            <div class="product-form-body">

                <div class="product-field">
                    <label for="name">
                        Nama produk/layanan <span class="product-required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="product-control"
                        value="{{ old('name', $item->name) }}"
                        placeholder="Contoh: Website Company Profile"
                        maxlength="180"
                        required
                    >

                    @error('name')
                        <div class="product-validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="product-field">
                    <label for="category">Kategori</label>

                    <input
                        type="text"
                        id="category"
                        name="category"
                        class="product-control"
                        value="{{ old('category', $item->category) }}"
                        placeholder="Contoh: Web Development"
                    >

                    @error('category')
                        <div class="product-validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="product-field">
                    <label for="short_description">
                        Deskripsi singkat <span class="product-required">*</span>
                    </label>

                    <input
                        type="text"
                        id="short_description"
                        name="short_description"
                        class="product-control"
                        value="{{ old('short_description', $item->short_description) }}"
                        placeholder="Ringkasan singkat produk atau layanan."
                        maxlength="255"
                        required
                    >

                    <div class="product-field-hint">
                        Maksimal 255 karakter.
                    </div>

                    @error('short_description')
                        <div class="product-validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="product-field">
                    <label for="description">
                        Deskripsi lengkap <span class="product-required">*</span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="product-control"
                        rows="7"
                        placeholder="Jelaskan manfaat, fitur, dan detail layanan."
                        required
                    >{{ old('description', $item->description) }}</textarea>

                    @error('description')
                        <div class="product-validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="product-divider"></div>

                <div class="product-bottom-grid">

                    {{-- FOTO PRODUK --}}
                    <div class="product-field">
                        <label for="image">
                            Foto Produk
                            <span style="color:#8995a9;font-weight:500;">(opsional)</span>
                        </label>

                        <div class="product-upload-box">
                            <div class="product-upload-icon">
                                <i class="bi bi-cloud-arrow-up"></i>
                            </div>

                            <strong>Pilih foto untuk produk</strong>
                            <small>Format JPG, PNG, atau WebP. Maksimal 3 MB.</small>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="product-file-input"
                                accept="image/jpeg,image/png,image/webp"
                            >
                        </div>

                        @error('image')
                            <div class="product-validation-error">{{ $message }}</div>
                        @enderror

                        <div class="product-preview-wrap">
                            <div class="product-preview-label">
                                <span>Pratinjau Foto</span>
                                <span class="product-preview-status" id="product-preview-status">
                                    {{ $item->image ? 'Foto tersimpan' : 'Belum ada foto baru' }}
                                </span>
                            </div>

                            @if($item->image)
                                <img
                                    id="product-image-preview"
                                    src="{{ asset('storage/' . ltrim($item->image, '/')) }}"
                                    alt="{{ $item->name ?: 'Foto produk' }}"
                                    class="product-preview-image"
                                >

                                <div id="product-preview-empty"
                                     class="product-preview-empty"
                                     hidden>
                                    Foto yang dipilih akan muncul di sini.
                                </div>
                            @else
                                <div id="product-preview-empty" class="product-preview-empty">
                                    Foto yang dipilih akan muncul di sini.
                                </div>

                                <img
                                    id="product-image-preview"
                                    src=""
                                    alt="Pratinjau foto produk"
                                    class="product-preview-image"
                                    style="display:none;"
                                >
                            @endif
                        </div>
                    </div>

                    {{-- STATUS PUBLIKASI DAN PRODUK UNGGULAN --}}
                    <div class="product-field">
                        <div class="product-field-label">
                            Status dan pengaturan
                        </div>

                        <div class="product-option-card">
                            <div class="product-option-title">
                                <i class="bi bi-globe2"></i>
                                Status publikasi
                            </div>

                            <p class="product-option-description">
                                Tentukan apakah produk dapat dilihat pengunjung website.
                            </p>

                            <label class="product-status-option">
                                <input
                                    type="radio"
                                    name="is_published"
                                    value="1"
                                    @checked((string) old('is_published', $item->exists ? (int) $item->is_published : 1) === '1')
                                >

                                <span>
                                    <strong>Publik</strong>
                                    <small>Produk ditampilkan di website.</small>
                                </span>
                            </label>

                            <label class="product-status-option">
                                <input
                                    type="radio"
                                    name="is_published"
                                    value="0"
                                    @checked((string) old('is_published', $item->exists ? (int) $item->is_published : 1) === '0')
                                >

                                <span>
                                    <strong>Draft</strong>
                                    <small>Produk tersimpan di admin dan tidak ditampilkan kepada pengunjung.</small>
                                </span>
                            </label>

                            @error('is_published')
                                <div class="product-validation-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- SWITCH PRODUK UNGGULAN TERPISAH --}}
                        <div class="product-featured-panel">
                            <div class="product-featured-text">
                                <strong>Produk unggulan</strong>
                                <small>
                                    Aktifkan untuk memprioritaskan produk pada bagian unggulan website.
                                </small>
                            </div>

                            <div class="form-check form-switch product-featured-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    role="switch"
                                    id="is_featured"
                                    name="is_featured"
                                    value="1"
                                    @checked((bool) old('is_featured', $item->is_featured))
                                >
                            </div>
                        </div>

                        @error('is_featured')
                            <div class="product-validation-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div class="product-form-footer">
            <div class="product-form-footer-note">
                <i class="bi bi-info-circle me-1"></i>
                Periksa kembali data sebelum menyimpan.
            </div>

            <div class="product-form-actions">
                <a href="{{ route('admin.produk.index') }}" class="product-cancel-btn">
                    Batal
                </a>

                <button type="submit" class="product-submit-btn">
                    <i class="bi bi-check-lg"></i>
                    {{ $item->exists ? 'Simpan perubahan' : 'Simpan produk' }}
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('image');
        const preview = document.getElementById('product-image-preview');
        const emptyState = document.getElementById('product-preview-empty');
        const status = document.getElementById('product-preview-status');

        if (!input || !preview || !emptyState) return;

        let previewUrl = null;

        input.addEventListener('change', function () {
            const file = this.files && this.files[0];

            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Silakan pilih file gambar yang valid.');
                this.value = '';
                return;
            }

            if (file.size > 3 * 1024 * 1024) {
                alert('Ukuran gambar maksimal 3 MB.');
                this.value = '';
                return;
            }

            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
            }

            previewUrl = URL.createObjectURL(file);
            preview.src = previewUrl;
            preview.style.display = 'block';
            preview.hidden = false;
            emptyState.style.display = 'none';
            emptyState.hidden = true;

            if (status) {
                status.textContent = 'Foto baru dipilih';
            }
        });
    });
</script>

@endsection