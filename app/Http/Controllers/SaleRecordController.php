<?php

namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;
use App\SaleRecords;

class SaleRecordController extends Controller
{

    public function index()
    {

        $records = SaleRecords::with(['bill.customer', 'product']);
        if ($search = \request('id')) {
            $records = $records->where('id', 'like', "%{$search}%");
        }
        $records = $records->paginate(\request('perPage'));
        return $records;
    }

    public function recordData(Request $request)
    {
        $month = $request->month;
        $nextMonth = $month + 1;
        $nextYear = $request->year;

        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear = $nextYear + 1;
        }
        if ($month < 10) {
            $month = "0" . $month;
        }
        if ($nextMonth < 10) {
            $nextMonth = "0" . $nextMonth;
        }


        $record = Bill::with(['customer', 'saleRecords.product']);
        $record = $record->where('user_id', '=', \request('userId'));
        $record = $record->where('date', '>=', $request->year . '-' . $month . '-01 00:00:00');
        $record = $record->where('date', '<', $nextYear . '-' . $nextMonth . '-01 00:00:00')->get();
        return $record;
    }
}