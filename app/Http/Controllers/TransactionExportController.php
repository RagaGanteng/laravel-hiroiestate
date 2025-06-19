<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Models\PropertyTransaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionExportController extends Controller
{
    public function form()
    {
        return view('transactions.export_form');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new TransactionsExport($request->from, $request->to), 'transactions.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $transactions = PropertyTransaction::with('propertyType', 'agent')
            ->whereBetween('date', [$request->from, $request->to])
            ->get();

        $pdf = PDF::loadView('transactions.report_pdf', compact('transactions'));
        return $pdf->download('transactions.pdf');
    }
}

