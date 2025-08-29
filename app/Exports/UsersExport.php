<?php

namespace App\Exports;

use App\Invoice;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    public function view(): View
    {
        $data = array(
            'users' => User::orderBy('role', 'asc')->get(),
            'date' => now()->format('Y-m-d'),
            'jam' => now()->format('H:i:s'),
        );
        return view('admin.users.excel', $data);
    }
}