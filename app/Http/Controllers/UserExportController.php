<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf;

class UserExportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportPDF()
    {
        $users = User::all();
        $pdf = Pdf::loadView('users.export-pdf', compact('users'));
        return $pdf->download('users.pdf');
    }
}

