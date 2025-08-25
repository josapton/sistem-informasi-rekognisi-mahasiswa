<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Dashboard',
            'menuDashboard' => 'active'
        );
        return view('dashboard', $data);
    }
}
