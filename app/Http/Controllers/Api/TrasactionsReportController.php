<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Http\Resources\Api\TransactionsReportResource;

class TrasactionsReportController extends Controller
{
    public function generateMonthlyReport(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $report = Transaction::selectRaw('
                MONTH(due_on) as month,
                YEAR(due_on) as year,
                SUM(CASE WHEN status = "paid" THEN amount ELSE 0 END) as paid,
                SUM(CASE WHEN status = "outstanding" THEN amount ELSE 0 END) as outstanding,
                SUM(CASE WHEN status = "overdue" THEN amount ELSE 0 END) as overdue
            ')
            ->whereBetween('due_on', [$startDate, $endDate])
            ->groupByRaw('MONTH(due_on), YEAR(due_on)')
            ->orderByRaw('year, month')
            ->get();
        return $this->successResponse(TransactionsReportResource::collection($report), __('transactions report'), 200);
    
    }
}
