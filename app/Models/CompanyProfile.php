<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table = 'company_profiles';

    protected $fillable = [
        // Informasi umum
        'company_name',
        'tagline',
        'about',
        'address',
        'phone',
        'email',
        'whatsapp',
        'vision',
        'mission',

        // Hero profil
        'profile_hero_title',
        'profile_hero_highlight',
        'profile_hero_description',

        // Keunggulan perusahaan
        'profile_point_1_title',
        'profile_point_1_description',
        'profile_point_2_title',
        'profile_point_2_description',
        'profile_point_3_title',
        'profile_point_3_description',

        // Nilai perusahaan
        'profile_value_1_title',
        'profile_value_1_description',
        'profile_value_2_title',
        'profile_value_2_description',
        'profile_value_3_title',
        'profile_value_3_description',
        'profile_value_4_title',
        'profile_value_4_description',

        // Komitmen perusahaan
        'profile_commitment_1_title',
        'profile_commitment_1_description',
        'profile_commitment_2_title',
        'profile_commitment_2_description',
        'profile_commitment_3_title',
        'profile_commitment_3_description',
        'profile_commitment_4_title',
        'profile_commitment_4_description',
    ];

    /**
     * Data bawaan bila tabel masih kosong.
     */
    public static function defaults(): array
    {
        return [
            'company_name' => 'PT Solusi Koneksi Anda',
            'tagline'      => 'Menghubungkan ide, menghadirkan solusi.',
            'about'        => 'Kami membantu bisnis berkembang melalui solusi teknologi, layanan digital, dan kemitraan yang berorientasi pada hasil.',
            'address'      => 'Jl. Raya Pajajaran No. 88 F, Kota Bogor 16153',
            'phone'        => '(0251) 000-000',
            'email'        => 'halo@koneksisolusianda.co.id',
            'whatsapp'     => '6281234567890',
            'vision'       => 'Menjadi mitra teknologi terpercaya untuk pertumbuhan bisnis.',
            'mission'      => "Menghadirkan solusi yang tepat guna.\nMembangun kemitraan jangka panjang.\nMengutamakan kualitas dan inovasi.",
        ];
    }

    public static function current(): self
    {
        return static::first() ?? new static(static::defaults());
    }
}