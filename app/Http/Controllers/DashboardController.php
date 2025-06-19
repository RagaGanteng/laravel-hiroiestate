<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use App\Models\Facility;
use App\Models\Agent;
use App\Models\Transaction;
use App\Models\PropertyTransaction;
use Carbon\Carbon;



class DashboardController extends Controller
{
    public function index()
    {
        $monthly = PropertyTransaction::selectRaw('MONTH(date) as month, COUNT(*) as total')
        ->whereYear('date', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $monthlyLabels = [];
        $monthlyData = [];

        $statusCounts = PropertyTransaction::selectRaw('status, COUNT(*) as total')
        ->groupBy('status')
        ->pluck('total', 'status');

        foreach (range(1, 12) as $m) {
            $label = Carbon::create()->month($m)->format('M');
            $monthlyLabels[] = $label;
            $item = $monthly->firstWhere('month', $m);
            $monthlyData[] = $item ? $item->total : 0;
        }

        return view('dashboard', [
            'propertyCount' => PropertyType::count(),
            'facilityCount' => Facility::count(),
            'agentCount' => Agent::count(),
            'transactionCount' => Transaction::count(),
            'transactionCount2' => PropertyTransaction::count(),
            'monthlyLabels' => $monthlyLabels,
            'monthlyData' => $monthlyData,
            'statusCounts' => $statusCounts,
        ]);
        
    }
}

