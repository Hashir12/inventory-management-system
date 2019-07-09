<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Product;
use App\SaleRecords;
use Illuminate\Http\Request;
use App\Customers;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function saleItem(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
        ]);

        $customer = Customers::find(request('customerId'));
        if (!$customer) {
            $customer = new Customers([
                'cname' => $request->input('name'),
                'contact' => $request->input('contact')
            ]);
            $customer->save();
        }
        $bill = new Bill([
            'customer_id' => $request->customerId,
            'user_id' => Auth::user()->id,
            'discount' => $request->discount,
            'date' => date('Y-m-d H:i:s'),
        ]);
        $bill->save();

        $items = \request('bill');
        foreach ($items as $billItem) {
            $item = Product::find($billItem['id']);
            $oldNumber = $item->number - $billItem['number'];
            $data = ['number' => $oldNumber];
            if ($oldNumber <= 0) {
                $data['product_status'] = 'inactive';
            }
            $item->update($data);
            $saleRecord = new SaleRecords([
                'products_id' => $item->id,
                'bill_id' => $bill->id,
                'price' => $item->price * $billItem['number'],
                'qty' => $billItem['number'],
            ]);
            $saleRecord->save();
            $saleRecord['soldRecord'] = $items;
            $saleRecord['discount'] = $request->discount;
            $saleRecord['name'] = $request->name;
            $saleRecord['contact'] = $request->contact;
        }

        return $saleRecord;
    }

    public function monthlySale(Request $request)
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
        $record = $record->where('date', '>=', $request->year . '-' . $month . '-01 00:00:00');
        $record = $record->where('date', '<', $nextYear . '-' . $nextMonth . '-01 00:00:00')->get();
        return $record;
    }

}
