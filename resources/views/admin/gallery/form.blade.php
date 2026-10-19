@extends('layouts.admin')

@section('title', $item->exists ? 'Edit Foto' : 'Tambah Foto')
@section('heading', 'Galeri')

@section('content')

<style>
    .gallery-form-page { color: #172b4d; }

    .gallery-form-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 28px;
    }

    .gallery-form-heading h1 {
        margin: 0 0 7px;
        color: #142746;
        font-size: clamp(25px, 3vw, 30px);
        font-weight: 750;
        letter-spacing: -1px;
    }

    .gallery-form-heading p {
        margin: 0;
        color: #8491a7;
        font-size: 14px;
    }

    .gallery-back-btn,
    .gallery-cancel-btn,
    .gallery-submit-btn {
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

    .gallery-back-btn,
    .gallery-cancel-btn {
        border-color: #e0e7f1;
        background: #fff;
        color: #53627a;
    }

    .gallery-back-btn:hover,
    .gallery-cancel-btn:hover {
        border-color: #b8ceff;
        background: #f5f8ff;
        color: #2563eb;
    }

    .gallery-form-panel {
        overflow: hidden;
        border: 1px solid #e8edf5;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 10px 35px rgba(25, 48, 84, .045);
    }

    .gallery-form-panel-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 24px 28px;
        border-bottom: 1px solid #edf1f7;
    }

    .gallery-form-icon {
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

    .gallery-form-panel-header h5 {
        margin: 0 0 5px;
        color: #172b4d;
        font-size: 16px;
        font-weight: 750;
    }

    .gallery-form-panel-header p {
        margin: 0;
        color: #8995a9;
        font-size: 12px;
    }

    .gallery-form-body { padding: 28px; }

    .gallery-field { margin-bottom: 23px; }

    .gallery-field:last-child { margin-bottom: 0; }

    .gallery-field label,
    .gallery-field-label {
        display: block;
        margin-bottom: 9px;
        color: #34445e;
        font-size: 13px;
        font-weight: 700;
    }

    .gallery-required { color: #e5484d; }

    .gallery-control {
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

    .gallery-control::placeholder { color: #a1adbf; }

    .gallery-control:focus {
        border-color: #78a5ff;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .09);
    }

    textarea.gallery-control {
        min-height: 150px;
        resize: vertical;
    }

    .gallery-field-hint {
        margin-top: 7px;
        color: #94a0b3;
        font-size: 11px;
        line-height: 1.6;
    }

    .gallery-divider {
        height: 1px;
        margin: 28px 0;
        background: #edf1f7;
    }

    .gallery-upload-box {
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

    .gallery-upload-box:hover {
        border-color: #7da8ff;
        background: #f4f8ff;
    }

    .gallery-upload-icon {
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

    .gallery-upload-box strong {
        color: #34445e;
        font-size: 12px;
        font-weight: 750;
    }

    .gallery-upload-box small {
        color: #8d9ab0;
        font-size: 11px;
    }

    .gallery-file-input {
        display: block;
        width: 100%;
        max-width: 100%;
        margin-top: 8px;
        color: #64748b;
        font-size: 11px;
    }

    .gallery-file-input::file-selector-button {
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

    .gallery-preview-wrap {
        margin-top: 17px;
        padding: 12px;
        border: 1px solid #e8edf5;
        border-radius: 13px;
        background: #fff;
    }

    .gallery-preview-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
        color: #53627a;
        font-size: 11px;
        font-weight: 700;
    }

    .gallery-preview-status {
        color: #168454;
        font-size: 10px;
        font-weight: 650;
    }

    .gallery-preview-image {
        display: block;
        width: 100%;
        max-height: 320px;
        object-fit: contain;
        border-radius: 9px;
        background: #f3f6fb;
    }

    .gallery-preview-empty {
        padding: 20px 10px;
        border: 1px dashed #dce4ef;
        border-radius: 9px;
        background: #f8faff;
        color: #94a0b3;
        font-size: 12px;
        text-align: center;
    }

    .gallery-info-card {
        margin-top: 20px;
        padding: 18px;
        border: 1px solid #e5ebf4;
        border-radius: 15px;
        background: #fbfcff;
    }

    .gallery-info-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 8px;
        color: #263750;
        font-size: 13px;
        font-weight: 750;
    }

    .gallery-info-title i { color: #2563eb; }

    .gallery-info-card p {
        margin: 0;
        color: #8995a9;
        font-size: 12px;
        line-height: 1.7;
    }

    .gallery-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 23px;
    }

    .gallery-form-footer-note {
        color: #8995a9;
        font-size: 11px;
    }

    .gallery-form-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .gallery-submit-btn {
        background: linear-gradient(135deg, #2878ff, #155eef);
        color: #fff;
        box-shadow: 0 6px 14px rgba(37, 99, 235, .17);
    }

    .gallery-submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 9px 20px rgba(37, 99, 235, .24);
        color: #fff;
    }

    .gallery-validation-error {
        margin-top: 7px;
        color: #dc3545;
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .gallery-form-body { padding: 20px; }
        .gallery-form-panel-header { padding: 20px; }
        .gallery-form-footer { align-items: stretch; }
        .gallery-form-actions { width: 100%; }

        .gallery-form-actions a,
        .gallery-form-actions button { flex: 1; }
    }
</style>

<div class="gallery-form-page">

    <div class="gallery-form-heading">
        <div>
            <h1>{{ $item->exists ? 'Edit foto galeri' : 'Tambah foto galeri' }}</h1>
            <p>
                {{ $item->exists
                    ? 'Perbarui informasi kegiatan dan foto yang tersimpan.'
                    : 'Tambahkan dokumentasi kegiatan perusahaan ke galeri.' }}
            </p>
        </div>

        <a href="{{ route('admin.galeri.index') }}" class="gallery-back-btn">
            <i class="bi bi-arrow-left"></i>
            Kembali ke galeri
        </a>
    </div>

    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @csrf

        @if($method === 'PUT')
            @method('PUT')
        @endif

        <div class="gallery-form-panel">

            <div class="gallery-form-panel-header">
                <div class="gallery-form-icon">
                    <i class="bi bi-images"></i>
                </div>

                <div>
                    <h5>Informasi Foto Galeri</h5>
                    <p>Lengkapi judul, tanggal, keterangan, dan gambar kegiatan.</p>
                </div>
            </div>

            <div class="gallery-form-body">

                <div class="gallery-field">
                    <label for="title">
                        Judul kegiatan <span class="gallery-required">*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="gallery-control"
                        value="{{ old('title', $item->title) }}"
                        placeholder="Contoh: Kegiatan kunjungan perusahaan"
                        maxlength="180"
                        required
                    >

                    @error('title')
                        <div class="gallery-validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="gallery-field">
                    <label for="event_date">Tanggal kegiatan</label>

                    <input
                        type="date"
                        id="event_date"
                        name="event_date"
                        class="gallery-control"
                        value="{{ old('event_date', $item->event_date ? \Illuminate\Support\Carbon::parse($item->event_date)->format('Y-m-d') : '') }}"
                    >

                    @error('event_date')
                        <div class="gallery-validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="gallery-field">
                    <label for="description">Keterangan kegiatan</label>

                    <textarea
                        id="description"
                        name="description"
                        class="gallery-control"
                        rows="5"
                        placeholder="Tuliskan keterangan singkat tentang kegiatan ini..."
                    >{{ old('description', $item->description) }}</textarea>

                    @error('description')
                        <div class="gallery-validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="gallery-divider"></div>

                <div class="gallery-field">
                    <label for="image">
                        Foto kegiatan
                        @if(!$item->exists)
                            <span class="gallery-required">*</span>
                        @else
                            <span style="color:#8995a9;font-weight:500;">(opsional)</span>
                        @endif
                    </label>

                    <div class="gallery-upload-box">
                        <div class="gallery-upload-icon">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>

                        <strong>Pilih foto dari komputer</strong>
                        <small>Gunakan gambar yang sesuai dengan kegiatan perusahaan.</small>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            class="gallery-file-input"
                            accept="image/*"
                            {{ $item->exists ? '' : 'required' }}
                        >
                    </div>

                    <div class="gallery-field-hint">
                        {{ $item->exists
                            ? 'Kosongkan jika tidak ingin mengganti foto saat ini.'
                            : 'Foto wajib dipilih saat menambahkan data galeri.' }}
                    </div>

                    @error('image')
                        <div class="gallery-validation-error">{{ $message }}</div>
                    @enderror

                    <div class="gallery-preview-wrap">
                        <div class="gallery-preview-label">
                            <span>Pratinjau Foto</span>
                            <span class="gallery-preview-status" id="gallery-preview-status">
                                {{ $item->image ? 'Foto tersimpan' : 'Belum ada foto' }}
                            </span>
                        </div>

                        @if($item->image)
                            <img
                                id="gallery-image-preview"
                                src="{{ asset('storage/' . ltrim($item->image, '/')) }}"
                                alt="{{ $item->title }}"
                                class="gallery-preview-image"
                            >

                            <div id="gallery-preview-empty" class="gallery-preview-empty" hidden>
                                Foto yang dipilih akan muncul di sini.
                            </div>
                        @else
                            <div id="gallery-preview-empty" class="gallery-preview-empty">
                                Foto yang dipilih akan muncul di sini.
                            </div>

                            <img
                                id="gallery-image-preview"
                                src=""
                                alt="Pratinjau foto galeri"
                                class="gallery-preview-image"
                                hidden
                            >
                        @endif
                    </div>
                </div>

                <div class="gallery-info-card">
                    <div class="gallery-info-title">
                        <i class="bi bi-info-circle"></i>
                        Informasi penyimpanan
                    </div>

                    <p>
                        Foto akan diunggah melalui form ini. Saat mengedit data,
                        kamu dapat mempertahankan foto lama dengan tidak memilih
                        file gambar baru.
                    </p>
                </div>

            </div>
        </div>

        <div class="gallery-form-footer">
            <div class="gallery-form-footer-note">
                <i class="bi bi-shield-check me-1"></i>
                Pastikan data kegiatan sudah benar.
            </div>

            <div class="gallery-form-actions">
                <a href="{{ route('admin.galeri.index') }}" class="gallery-cancel-btn">
                    Batal
                </a>

                <button type="submit" class="gallery-submit-btn">
                    <i class="bi bi-check-lg"></i>
                    {{ $item->exists ? 'Simpan perubahan' : 'Simpan foto' }}
                </button>
            </div>
        </div>

    </form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('image');
        const preview = document.getElementById('gallery-image-preview');
        const emptyState = document.getElementById('gallery-preview-empty');
        const status = document.getElementById('gallery-preview-status');

        if (!input || !preview || !emptyState) return;

        let previewUrl = null;

        input.addEventListener('change', function () {
            const file = this.files && this.files[0];

            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }

            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Silakan pilih file gambar yang valid.');
                this.value = '';
                return;
            }

            previewUrl = URL.createObjectURL(file);
            preview.src = previewUrl;
            preview.hidden = false;
            emptyState.hidden = true;

            if (status) {
                status.textContent = 'Foto baru dipilih';
            }
        });
    });
</script>

@endsection