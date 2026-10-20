<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $item = CompanyProfile::first();

        if (!$item) {
            $item = new CompanyProfile([
                'company_name' => 'PT Solusi Koneksi Anda',
                'tagline' => 'Menghubungkan ide, menghadirkan solusi.',
                'about' => 'Kami membantu bisnis berkembang melalui solusi teknologi dan layanan digital.',
                'address' => 'Jl. Raya Pajajaran No. 88 F, Kota Bogor 16153',
                'phone' => '(0251) 000-000',
                'email' => 'halo@koneksisolusianda.co.id',
                'whatsapp' => '6281234567890',
                'vision' => 'Menjadi mitra teknologi terpercaya untuk pertumbuhan bisnis.',
                'mission' => "Menghadirkan solusi yang tepat guna.\nMembangun kemitraan jangka panjang.\nMengutamakan kualitas dan inovasi.",

                'profile_hero_highlight' => 'Teknologi yang Berdampak',

                'profile_point_1_title' => 'Solusi Terintegrasi',
                'profile_point_1_description' => 'Menghubungkan kebutuhan bisnis dengan solusi digital yang saling mendukung.',
                'profile_point_2_title' => 'Tim Profesional',
                'profile_point_2_description' => 'Mengutamakan komunikasi, kolaborasi, dan kualitas dalam setiap pekerjaan.',
                'profile_point_3_title' => 'Fokus pada Kebutuhan',
                'profile_point_3_description' => 'Merancang solusi berdasarkan tujuan dan kebutuhan setiap klien.',

                'profile_value_1_title' => 'Integritas',
                'profile_value_1_description' => 'Menjaga kepercayaan melalui sikap jujur dan bertanggung jawab.',
                'profile_value_2_title' => 'Inovasi',
                'profile_value_2_description' => 'Terus mencari pendekatan dan solusi yang lebih baik.',
                'profile_value_3_title' => 'Kolaborasi',
                'profile_value_3_description' => 'Membangun hubungan kerja yang terbuka dan saling mendukung.',
                'profile_value_4_title' => 'Kualitas',
                'profile_value_4_description' => 'Memberikan perhatian pada detail dan hasil kerja yang bermanfaat.',

                'profile_commitment_1_title' => 'Memahami Kebutuhan',
                'profile_commitment_1_description' => 'Mendengarkan kebutuhan klien sebelum menentukan solusi.',
                'profile_commitment_2_title' => 'Menjaga Kualitas',
                'profile_commitment_2_description' => 'Menerapkan standar kerja yang konsisten di setiap tahap.',
                'profile_commitment_3_title' => 'Komunikasi Terbuka',
                'profile_commitment_3_description' => 'Memberikan informasi perkembangan pekerjaan secara jelas.',
                'profile_commitment_4_title' => 'Kemitraan Jangka Panjang',
                'profile_commitment_4_description' => 'Mendukung kebutuhan bisnis klien seiring perkembangannya.',
            ]);
        }

        return view('admin.profile.edit', compact('item'));
    }

    /**
     * Memvalidasi dan menyimpan perubahan profil perusahaan.
     */
    public function update(Request $request)
    {
        $rules = [
            'company_name' => ['required', 'string', 'max:180'],
            'tagline' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:150'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'vision' => ['required', 'string'],
            'mission' => ['required', 'string'],

            'profile_hero_highlight' => ['nullable', 'string', 'max:255'],
        ];

        // Validasi tiga keunggulan perusahaan.
        for ($i = 1; $i <= 3; $i++) {
            $rules["profile_point_{$i}_title"] = [
                'nullable', 'string', 'max:255',
            ];

            $rules["profile_point_{$i}_description"] = [
                'nullable', 'string',
            ];
        }

        // Validasi empat nilai perusahaan.
        for ($i = 1; $i <= 4; $i++) {
            $rules["profile_value_{$i}_title"] = [
                'nullable', 'string', 'max:255',
            ];

            $rules["profile_value_{$i}_description"] = [
                'nullable', 'string',
            ];
        }

        // Validasi empat komitmen perusahaan.
        for ($i = 1; $i <= 4; $i++) {
            $rules["profile_commitment_{$i}_title"] = [
                'nullable', 'string', 'max:255',
            ];

            $rules["profile_commitment_{$i}_description"] = [
                'nullable', 'string',
            ];
        }

        $data = $request->validate($rules);

        $item = CompanyProfile::first();

        if (!$item) {
            $item = new CompanyProfile();
        }

        $item->fill($data);
        $item->save();

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Profil perusahaan berhasil disimpan.');
    }
}