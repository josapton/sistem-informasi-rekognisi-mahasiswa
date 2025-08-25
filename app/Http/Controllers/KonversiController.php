<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonversiController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Konversi SKS',
            'menuAdminKonversi' => 'active'
        );
        return view('admin.konversi.index', $data);
    }
}
