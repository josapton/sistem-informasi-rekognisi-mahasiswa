<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Kegiatan',
            'menuAdminKegiatan' => 'active'
        );
        return view('admin.kegiatan.index', $data);
    }
}
