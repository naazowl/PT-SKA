@extends('layouts.admin')

@section('title', 'Profil Perusahaan')
@section('heading', 'Profil Perusahaan')

@section('content')

@include('admin.partials.animations')

@php
    $profilePoints = [
        1 => [
            'title' => 'Berorientasi pada Pelanggan',
            'description' => 'Memahami kebutuhan dan mengutamakan komunikasi yang jelas dalam setiap kerja sama.',
        ],
        2 => [
            'title' => 'Solusi yang Relevan',
            'description' => 'Mengedepankan pendekatan yang sesuai dengan tujuan dan kebutuhan pelanggan.',
        ],
        3 => [
            'title' => 'Komitmen pada Kualitas',
            'description' => 'Berupaya menjaga profesionalisme, ketelitian, dan kualitas dalam pelayanan.',
        ],
    ];

    $profileValues = [
        1 => [
            'title' => 'Integritas',
            'description' => 'Menjunjung kejujuran, tanggung jawab, dan keterbukaan.',
        ],
        2 => [
            'title' => 'Inovasi',
            'description' => 'Terbuka terhadap perkembangan dan gagasan baru.',
        ],
        3 => [
            'title' => 'Profesionalisme',
            'description' => 'Mengutamakan komunikasi dan proses kerja yang profesional.',
        ],
        4 => [
            'title' => 'Kolaborasi',
            'description' => 'Membangun hubungan yang saling mendukung.',
        ],
    ];

    $profileCommitments = [
        1 => [
            'title' => 'Komunikasi Terbuka',
            'description' => 'Menjaga komunikasi agar kebutuhan dan tujuan kerja sama dapat dipahami dengan baik.',
        ],
        2 => [
            'title' => 'Pendekatan yang Tepat',
            'description' => 'Mempertimbangkan kebutuhan sebelum menentukan pendekatan dan solusi.',
        ],
        3 => [
            'title' => 'Perbaikan Berkelanjutan',
            'description' => 'Terus belajar dan mengevaluasi proses kerja untuk meningkatkan kualitas.',
        ],
        4 => [
            'title' => 'Hubungan Jangka Panjang',
            'description' => 'Mengutamakan kerja sama yang saling mendukung dan dilandasi kepercayaan.',
        ],
    ];
@endphp

<div class="admin-heading">
    <div>
        <h1>Profil Perusahaan</h1>
        <p>Kelola informasi perusahaan yang ditampilkan di website.</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.profile.update') }}">
    @csrf
    @method('PUT')

    <div class="panel adm-scroll">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="adm-icon d-flex align-items-center justify-content-center rounded-3"
                 style="width:44px;height:44px;background:#edf3ff;color:#2563eb;">
                <i class="bi bi-building fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Informasi Umum</h5>
                <p class="text-secondary small mb-0">Nama dan identitas perusahaan.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Nama perusahaan *</label>
                <input type="text"
                       class="form-control"
                       name="company_name"
                       value="{{ old('company_name', $item->company_name ?? 'PT Solusi Koneksi Anda') }}"
                       required>
                @error('company_name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Tagline *</label>
                <input type="text"
                       class="form-control"
                       name="tagline"
                       value="{{ old('tagline', $item->tagline ?? 'Menghubungkan ide, menghadirkan solusi.') }}"
                       required>
                @error('tagline')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Tentang perusahaan *</label>
                <textarea class="form-control"
                          name="about"
                          rows="6"
                          required>{{ old('about', $item->about ?? '') }}</textarea>
                <small class="text-secondary">
                    Isi profil lengkap perusahaan. Tekan Enter untuk memisahkan paragraf.
                </small>
                @error('about')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="panel mt-4 adm-scroll">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="adm-icon d-flex align-items-center justify-content-center rounded-3"
                 style="width:44px;height:44px;background:#edf3ff;color:#2563eb;">
                <i class="bi bi-window fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Tampilan Utama Profil</h5>
                <p class="text-secondary small mb-0">
                    Teks utama pada bagian atas halaman profil publik.
                </p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <label class="form-label">Kalimat sorotan</label>
                <input type="text"
                       class="form-control"
                       name="profile_hero_highlight"
                       value="{{ old('profile_hero_highlight', $item->profile_hero_highlight ?? 'Menghubungkan Ide, Mendorong Kemajuan.') }}"
                       placeholder="Menghubungkan Ide, Mendorong Kemajuan.">
                @error('profile_hero_highlight')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="panel mt-4 adm-scroll">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="adm-icon d-flex align-items-center justify-content-center rounded-3"
                 style="width:44px;height:44px;background:#edf3ff;color:#2563eb;">
                <i class="bi bi-check2-circle fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Poin Keunggulan Perusahaan</h5>
                <p class="text-secondary small mb-0">
                    Tiga poin checklist pada bagian Tentang Kami.
                </p>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($profilePoints as $number => $point)
                @php
                    $titleField = "profile_point_{$number}_title";
                    $descriptionField = "profile_point_{$number}_description";
                @endphp

                <div class="col-12">
                    <div class="adm-subcard p-3 rounded-3 border">
                        <h6 class="fw-bold mb-3">Poin {{ $number }}</h6>

                        <div class="mb-3">
                            <label class="form-label">Judul poin {{ $number }}</label>
                            <input type="text"
                                   class="form-control"
                                   name="{{ $titleField }}"
                                   value="{{ old($titleField, $item->{$titleField} ?? $point['title']) }}">
                            @error($titleField)
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Deskripsi poin {{ $number }}</label>
                            <textarea class="form-control"
                                      name="{{ $descriptionField }}"
                                      rows="2">{{ old($descriptionField, $item->{$descriptionField} ?? $point['description']) }}</textarea>
                            @error($descriptionField)
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="panel mt-4 adm-scroll">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="adm-icon d-flex align-items-center justify-content-center rounded-3"
                 style="width:44px;height:44px;background:#edf3ff;color:#2563eb;">
                <i class="bi bi-gem fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Nilai Perusahaan</h5>
                <p class="text-secondary small mb-0">
                    Nilai yang menjadi dasar dalam menjalankan perusahaan.
                </p>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($profileValues as $number => $value)
                @php
                    $titleField = "profile_value_{$number}_title";
                    $descriptionField = "profile_value_{$number}_description";
                @endphp

                <div class="col-md-6">
                    <div class="adm-subcard p-3 rounded-3 border h-100">
                        <h6 class="fw-bold mb-3">Nilai {{ $number }}</h6>

                        <div class="mb-3">
                            <label class="form-label">Nama nilai</label>
                            <input type="text"
                                   class="form-control"
                                   name="{{ $titleField }}"
                                   value="{{ old($titleField, $item->{$titleField} ?? $value['title']) }}">
                            @error($titleField)
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Penjelasan nilai</label>
                            <textarea class="form-control"
                                      name="{{ $descriptionField }}"
                                      rows="3">{{ old($descriptionField, $item->{$descriptionField} ?? $value['description']) }}</textarea>
                            @error($descriptionField)
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="panel mt-4 adm-scroll">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="adm-icon d-flex align-items-center justify-content-center rounded-3"
                 style="width:44px;height:44px;background:#edf3ff;color:#2563eb;">
                <i class="bi bi-telephone fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Informasi Kontak</h5>
                <p class="text-secondary small mb-0">Alamat dan kontak perusahaan.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <label class="form-label">Alamat *</label>
                <input type="text"
                       class="form-control"
                       name="address"
                       value="{{ old('address', $item->address ?? '') }}"
                       required>
                @error('address')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Telepon *</label>
                <input type="text"
                       class="form-control"
                       name="phone"
                       value="{{ old('phone', $item->phone ?? '') }}"
                       required>
                @error('phone')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Email *</label>
                <input type="email"
                       class="form-control"
                       name="email"
                       value="{{ old('email', $item->email ?? '') }}"
                       required>
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">WhatsApp</label>
                <input type="text"
                       class="form-control"
                       name="whatsapp"
                       value="{{ old('whatsapp', $item->whatsapp ?? '') }}"
                       placeholder="628xxxxxxxxxx">
                @error('whatsapp')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="panel mt-4 adm-scroll">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="adm-icon d-flex align-items-center justify-content-center rounded-3"
                 style="width:44px;height:44px;background:#edf3ff;color:#2563eb;">
                <i class="bi bi-bullseye fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Visi &amp; Misi</h5>
                <p class="text-secondary small mb-0">Arah dan tujuan perusahaan.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Visi *</label>
                <textarea class="form-control"
                          name="vision"
                          rows="5"
                          required>{{ old('vision', $item->vision ?? '') }}</textarea>
                @error('vision')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Misi *</label>
                <textarea class="form-control"
                          name="mission"
                          rows="5"
                          required>{{ old('mission', $item->mission ?? '') }}</textarea>
                @error('mission')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="panel mt-4 adm-scroll">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="adm-icon d-flex align-items-center justify-content-center rounded-3"
                 style="width:44px;height:44px;background:#edf3ff;color:#2563eb;">
                <i class="bi bi-shield-check fs-5"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Komitmen Perusahaan</h5>
                <p class="text-secondary small mb-0">
                    Empat komitmen yang ditampilkan pada profil publik.
                </p>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($profileCommitments as $number => $commitment)
                @php
                    $titleField = "profile_commitment_{$number}_title";
                    $descriptionField = "profile_commitment_{$number}_description";
                @endphp

                <div class="col-md-6">
                    <div class="adm-subcard p-3 rounded-3 border h-100">
                        <h6 class="fw-bold mb-3">Komitmen {{ $number }}</h6>

                        <div class="mb-3">
                            <label class="form-label">Judul komitmen</label>
                            <input type="text"
                                   class="form-control"
                                   name="{{ $titleField }}"
                                   value="{{ old($titleField, $item->{$titleField} ?? $commitment['title']) }}">
                            @error($titleField)
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Deskripsi komitmen</label>
                            <textarea class="form-control"
                                      name="{{ $descriptionField }}"
                                      rows="3">{{ old($descriptionField, $item->{$descriptionField} ?? $commitment['description']) }}</textarea>
                            @error($descriptionField)
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4 d-flex flex-wrap gap-2 adm-scroll">
        <button type="submit" class="btn btn-primary px-4 py-2">
            <i class="bi bi-check2-circle me-1"></i>
            Simpan profil
        </button>

        <a href="{{ route('admin.profile.edit') }}"
           class="btn btn-outline-secondary px-4 py-2">
            <i class="bi bi-arrow-counterclockwise me-1"></i>
            Batal
        </a>
    </div>
</form>

@endsection