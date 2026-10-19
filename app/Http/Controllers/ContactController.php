<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // 1. Simpan ke database dulu agar pesan tidak hilang
        try {
            ContactMessage::create($validated + [
                'ip_address' => $request->ip(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan pesan kontak.', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'message' => 'Pesan belum dapat dikirim. Silakan coba lagi nanti.',
                ]);
        }

        // 2. Kirim notifikasi email ke admin (kalau gagal, pesan tetap tersimpan)
        $company = CompanyProfile::first();

        if ($company && $company->email) {
            try {
                Mail::raw(
                    "Pesan baru dari halaman kontak website.\n\n"
                    . "Nama: {$validated['name']}\n"
                    . "Email: {$validated['email']}\n"
                    . "Subjek: {$validated['subject']}\n\n"
                    . "Isi pesan:\n{$validated['message']}",
                    function ($mail) use ($validated, $company) {
                        $mail->to($company->email)
                            ->replyTo($validated['email'], $validated['name'])
                            ->subject('Pesan Kontak: ' . $validated['subject']);
                    }
                );
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim email notifikasi pesan kontak.', [
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return back()->with(
            'success',
            'Pesan berhasil dikirim. Terima kasih telah menghubungi kami.'
        );
    }
}