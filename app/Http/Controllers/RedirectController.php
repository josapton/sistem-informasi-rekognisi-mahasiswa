<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
    /**
     * Redirect user to the WhatsApp contact link.
     */
    public function toWhatsapp()
    {
        // Ambil nomor dari file .env
        $phoneNumber = env('WHATSAPP_CONTACT_NUMBER');

        // Jika nomor tidak ada, kembalikan ke halaman utama untuk keamanan
        if (!$phoneNumber) {
            return redirect('/');
        }

        // Buat URL lengkap WhatsApp
        $whatsappUrl = "https://web.whatsapp.com/send?phone=" . $phoneNumber;

        // Lakukan redirect ke URL eksternal
        return Redirect::away($whatsappUrl);
    }
}
