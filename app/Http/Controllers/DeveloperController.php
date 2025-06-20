<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class DeveloperController extends Controller
{
    public function settings()
    {
        return view('developer.settings');
    }

    // Contoh: Reset database dummy (opsional)
    public function reset()
    {
        Artisan::call('migrate:fresh --seed');

        return back()->with('success', 'Database berhasil direset ulang.');
    }
}
