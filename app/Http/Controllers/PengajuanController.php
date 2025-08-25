<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Pengajuan',
            'menuAdminPengajuan' => 'active'
        );
        return view('admin.pengajuan.index', $data);
    }
}
