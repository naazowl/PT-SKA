@extends('layouts.admin')

@section('title', $item->exists ? 'Edit Artikel' : 'Tulis Artikel')
@section('heading', 'Artikel')

@section('content')

<style>
    .article-form-page { color: #172b4d; }

    .article-form-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 28px;
    }

    .article-form-heading h1 {
        margin: 0 0 7px;
        color: #142746;
        font-size: clamp(25px, 3vw, 30px);
        font-weight: 750;
        letter-spacing: -1px;
    }

    .article-form-heading p {
        margin: 0;
        color: #8491a7;
        font-size: 14px;
    }

    .article-back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 15px;
        border: 1px solid #e0e7f1;
        border-radius: 11px;
        background: #fff;
        color: #53627a;
        font-size: 13px;
        font-weight: 650;
        text-decoration: none;
        transition: all .2s ease;
    }

    .article-back-btn:hover {
        border-color: #b8ceff;
        background: #f5f8ff;
        color: #2563eb;
    }

    .article-form-panel {
        overflow: hidden;
        border: 1px solid #e8edf5;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 10px 35px rgba(25, 48, 84, .045);
    }

    .article-form-panel-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 24px 28px;
        border-bottom: 1px solid #edf1f7;
    }

    .article-form-icon {
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

    .article-form-panel-header h5 {
        margin: 0 0 5px;
        color: #172b4d;
        font-size: 16px;
        font-weight: 750;
    }

    .article-form-panel-header p {
        margin: 0;
        color: #8995a9;
        font-size: 12px;
    }

    .article-form-body { padding: 28px; }

    .article-field { margin-bottom: 23px; }

    .article-field:last-child { margin-bottom: 0; }

    .article-field label,
    .article-field-label {
        display: block;
        margin-bottom: 9px;
        color: #34445e;
        font-size: 13px;
        font-weight: 700;
    }

    .article-required { color: #e5484d; }

    .article-form-control {
        display: block;
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #dfe6f0;
        border-radius: 11px;
        outline: none;
        background-color: #fbfcff;
        color: #263750;
        font-size: 13px;
        line-height: 1.6;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .article-form-control::placeholder { color: #a1adbf; }

    .article-form-control:focus {
        border-color: #78a5ff;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .09);
    }

    textarea.article-form-control {
        min-height: 240px;
        resize: vertical;
    }

    .article-form-divider {
        height: 1px;
        margin: 28px 0;
        background: #edf1f7;
    }

    .article-bottom-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.3fr) minmax(250px, .9fr);
        gap: 24px;
    }

    .article-upload-box {
        position: relative;
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

    .article-upload-box:hover {
        border-color: #7da8ff;
        background: #f4f8ff;
    }

    .article-upload-icon {
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

    .article-upload-box strong {
        color: #34445e;
        font-size: 12px;
        font-weight: 750;
    }

    .article-upload-box small {
        color: #8d9ab0;
        font-size: 11px;
    }

    .article-file-input {
        display: block;
        width: 100%;
        max-width: 100%;
        margin-top: 8px;
        color: #64748b;
        font-size: 11px;
    }

    .article-file-input::file-selector-button {
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

    .article-preview-wrap {
        margin-top: 17px;
        padding: 12px;
        border: 1px solid #e8edf5;
        border-radius: 13px;
        background: #fff;
    }

    .article-preview-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
        color: #53627a;
        font-size: 11px;
        font-weight: 700;
    }

    .article-preview-label span {
        color: #168454;
        font-size: 10px;
        font-weight: 650;
    }

    .article-preview-image {
        display: block;
        width: 100%;
        max-height: 230px;
        object-fit: contain;
        border-radius: 9px;
        background: #f3f6fb;
    }

    .article-preview-empty {
        padding: 20px 10px;
        border: 1px dashed #dce4ef;
        border-radius: 9px;
        background: #f8faff;
        color: #94a0b3;
        font-size: 12px;
        text-align: center;
    }

    .article-status-card {
        padding: 20px;
        border: 1px solid #e5ebf4;
        border-radius: 15px;
        background: #fbfcff;
    }

    .article-status-card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 7px;
        color: #263750;
        font-size: 14px;
        font-weight: 750;
    }

    .article-status-card-title span {
        color: #2563eb;
        font-size: 18px;
    }

    .article-status-card-description {
        margin-bottom: 18px;
        color: #8995a9;
        font-size: 11px;
        line-height: 1.7;
    }

    .article-status-option {
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

    .article-status-option:last-child { margin-bottom: 0; }

    .article-status-option:has(input:checked) {
        border-color: #8bb2ff;
        background: #f3f7ff;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, .05);
    }

    .article-status-option input {
        width: 16px;
        height: 16px;
        margin-top: 2px;
        flex-shrink: 0;
        accent-color: #2563eb;
        cursor: pointer;
    }

    .article-status-option strong {
        display: block;
        margin-bottom: 4px;
        color: #34445e;
        font-size: 12px;
        font-weight: 750;
    }

    .article-status-option small {
        display: block;
        color: #8995a9;
        font-size: 11px;
        line-height: 1.6;
    }

    .article-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 23px;
    }

    .article-form-footer-note {
        color: #8995a9;
        font-size: 11px;
    }

    .article-form-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .article-submit-btn,
    .article-cancel-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 43px;
        padding: 11px 19px;
        border: 1px solid transparent;
        border-radius: 11px;
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
        cursor: pointer;
        transition: all .2s ease;
    }

    .article-submit-btn {
        background: linear-gradient(135deg, #2878ff, #155eef);
        color: #fff;
        box-shadow: 0 6px 14px rgba(37, 99, 235, .17);
    }

    .article-submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 9px 20px rgba(37, 99, 235, .24);
        color: #fff;
    }

    .article-cancel-btn {
        border-color: #dfe6f0;
        background: #fff;
        color: #53627a;
    }

    .article-cancel-btn:hover {
        border-color: #bdc9da;
        background: #f7f9fc;
        color: #263750;
    }

    .article-validation-error {
        margin-top: 7px;
        color: #dc3545;
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .article-form-body { padding: 20px; }
        .article-form-panel-header { padding: 20px; }
        .article-bottom-grid { grid-template-columns: 1fr; }
        .article-form-footer { align-items: stretch; }
        .article-form-actions { width: 100%; }

        .article-form-actions a,
        .article-form-actions button { flex: 1; }
    }
</style>

<div class="article-form-page">

    <div class="article-form-heading">
        <div>
            <h1>{{ $item->exists ? 'Edit artikel' : 'Tulis artikel' }}</h1>
            <p>
                {{ $item->exists
                    ? 'Perbarui konten, foto, dan status publikasi artikel.'
                    : 'Buat artikel baru untuk dibagikan kepada pengunjung website.' }}
            </p>
        </div>

        <a href="{{ route('admin.artikel.index') }}" class="article-back-btn">
            <span>←</span>
            Kembali ke artikel
        </a>
    </div>

    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @csrf

        @if($method === 'PUT')
            @method('PUT')
        @endif

        <div class="article-form-panel">

            <div class="article-form-panel-header">
                <div class="article-form-icon">✎</div>
                <div>
                    <h5>Informasi Artikel</h5>
                    <p>Lengkapi informasi artikel dengan jelas dan menarik.</p>
                </div>
            </div>

            <div class="article-form-body">

                <div class="article-field">
                    <label for="title">
                        Judul Artikel <span class="article-required">*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="article-form-control"
                        value="{{ old('title', $item->title) }}"
                        placeholder="Contoh: Mengapa Website Profesional Penting untuk Bisnis"
                        maxlength="180"
                        required
                    >

                    @error('title')
                        <div class="article-validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="article-field">
                    <label for="excerpt">
                        Ringkasan Artikel <span class="article-required">*</span>
                    </label>

                    <input
                        type="text"
                        id="excerpt"
                        name="excerpt"
                        class="article-form-control"
                        value="{{ old('excerpt', $item->excerpt) }}"
                        placeholder="Tulis ringkasan singkat yang menarik perhatian pembaca."
                        maxlength="255"
                        required
                    >

                    @error('excerpt')
                        <div class="article-validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="article-field">
                    <label for="content">
                        Isi Artikel <span class="article-required">*</span>
                    </label>

                    <textarea
                        id="content"
                        name="content"
                        class="article-form-control"
                        rows="10"
                        placeholder="Mulai tulis isi artikel di sini..."
                        required
                    >{{ old('content', $item->content) }}</textarea>

                    @error('content')
                        <div class="article-validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="article-form-divider"></div>

                <div class="article-bottom-grid">

                    {{-- FOTO ARTIKEL --}}
                    <div class="article-field">
                        <label for="image">
                            Foto Artikel
                            <span style="color:#8995a9;font-weight:500;">(opsional)</span>
                        </label>

                        <div class="article-upload-box">
                            <div class="article-upload-icon">
                                <i class="bi bi-cloud-arrow-up"></i>
                            </div>

                            <strong>Pilih foto untuk artikel</strong>
                            <small>Format JPG, PNG, atau WebP. Maksimal 3 MB.</small>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="article-file-input"
                                accept="image/jpeg,image/png,image/webp"
                            >
                        </div>

                        @error('image')
                            <div class="article-validation-error">{{ $message }}</div>
                        @enderror

                        <div class="article-preview-wrap">
                            <div class="article-preview-label">
                                <div>Pratinjau Foto</div>

                                <span id="preview-status">
                                    {{ $item->image ? 'Foto tersimpan' : 'Belum ada foto baru' }}
                                </span>
                            </div>

                            @if($item->image)
                                <img
                                    id="article-image-preview"
                                    src="{{ asset('storage/' . ltrim($item->image, '/')) }}"
                                    alt="{{ $item->title ?: 'Foto artikel' }}"
                                    class="article-preview-image"
                                >

                                <div id="article-preview-empty"
                                     class="article-preview-empty"
                                     hidden>
                                    Foto yang dipilih akan muncul di sini.
                                </div>
                            @else
                                <div id="article-preview-empty" class="article-preview-empty">
                                    Foto yang dipilih akan muncul di sini.
                                </div>

                                <img
                                    id="article-image-preview"
                                    src=""
                                    alt="Pratinjau foto artikel"
                                    class="article-preview-image"
                                    style="display:none;"
                                >
                            @endif
                        </div>
                    </div>

                    {{-- STATUS PUBLIKASI --}}
                    <div class="article-field">
                        <div class="article-field-label">
                            Status Publikasi <span class="article-required">*</span>
                        </div>

                        <div class="article-status-card">
                            <div class="article-status-card-title">
                                <span>◉</span>
                                Tampilkan artikel
                            </div>

                            <div class="article-status-card-description">
                                Pilih status sesuai kebutuhan publikasi artikel.
                            </div>

                            <label class="article-status-option">
                                <input
                                    type="radio"
                                    name="is_published"
                                    value="1"
                                    @checked((string) old('is_published', $item->exists ? (int) $item->is_published : 1) === '1')
                                >

                                <span>
                                    <strong>Publik</strong>
                                    <small>Artikel ditampilkan di halaman website.</small>
                                </span>
                            </label>

                            <label class="article-status-option">
                                <input
                                    type="radio"
                                    name="is_published"
                                    value="0"
                                    @checked((string) old('is_published', $item->exists ? (int) $item->is_published : 1) === '0')
                                >

                                <span>
                                    <strong>Draft</strong>
                                    <small>Artikel disimpan di admin dan tidak ditampilkan kepada pengunjung.</small>
                                </span>
                            </label>

                            @error('is_published')
                                <div class="article-validation-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="article-form-footer">
            <div class="article-form-footer-note">
                <span class="article-required">*</span> Wajib diisi.
            </div>

            <div class="article-form-actions">
                <a href="{{ route('admin.artikel.index') }}" class="article-cancel-btn">
                    Batal
                </a>

                <button type="submit" class="article-submit-btn">
                    <span>✓</span>
                    {{ $item->exists ? 'Simpan perubahan' : 'Simpan artikel' }}
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('image');
        const preview = document.getElementById('article-image-preview');
        const emptyState = document.getElementById('article-preview-empty');
        const previewStatus = document.getElementById('preview-status');

        if (input && preview && emptyState) {
            let temporaryImageUrl = null;

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

                if (temporaryImageUrl) {
                    URL.revokeObjectURL(temporaryImageUrl);
                }

                temporaryImageUrl = URL.createObjectURL(file);
                preview.src = temporaryImageUrl;
                preview.style.display = 'block';
                emptyState.style.display = 'none';

                if (previewStatus) {
                    previewStatus.textContent = 'Foto baru dipilih';
                }
            });
        }
    });
</script>

@endsection