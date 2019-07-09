<?php

namespace App\Http\Controllers;

use App\SaleRecords;
use Illuminate\Http\Request;
use App\Product;
use App\Customers;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function fetchData()
    {
        $record = Product::query();
        if ($search = \request('searchName')) {
            $record = $record->where('model', 'like', "%{$search}%");
            $record = $record->orWhere('itemname', 'like', "%{$search}%");
            $record = $record->orWhere('companyname', 'like', "%{$search}%");
        }

        if (request('orderBy')) {
            $record = $record->orderBy(request('orderBy'), request('orderDirection'));
        }

        $record = $record->paginate(\request('perPage'));
        return $record;
    }

    public function orderby(Request $request)
    {
        $record = Product::query()->orderBy($request->data, 'asc');
        return $record;
    }

    public function addRecord(Request $request)
    {
        $record = new Product([
            'itemname' => $request->input('name'),
            'companyname' => $request->input('company'),
            'model' => $request->input('model'),
            'color' => $request->input('color'),
            'number' => $request->input('number'),
            'price' => $request->input('price'),
        ]);
        $record->save();
    }

    public function addItem()
    {
        $item = Product::find(\request('id'));
        $oldNumber = $item->number + 1;
        $item->update(['number' => $oldNumber]);
        if ($item->number > 0) {
            $item->update(['product_status' => 'active']);
        }

    }

    public function lessItem()
    {
        $item = Product::find(\request('id'));
        $oldNumber = $item->number - 1;
        $item->update(['number' => $oldNumber]);
        if ($item->number == 0) {
            $item->update(['product_status' => 'inactive']);
        }
    }

    public function saleItem(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        echo "<pre>";

        $customer = Customers::find(request('customerId'));
        if (!$customer) {
            $customer = new Customers([
                'cname' => $request->input('name'),
                'contact' => $request->input('contact')
            ]);
            $customer->save();
        }

        $item = Product::find(\request('id'));
        $oldNumber = $item->number - $request->bill['number'];
        $data = ['number' => $oldNumber];
        if ($oldNumber <= 0) {
            $data['product_status'] = 'inactive';
        }
        $item->update($data);
        $saleRecord = new SaleRecords([
            'products_id' => $item->id,
            'bill_id' => $customer->id,
            'user_id' => Auth::user()->id,
            'price' => $item->price * $request->qty,
            'qty' => $request->qty,
            'date' => date('Y-m-d H:i:s'),
        ]);
        $saleRecord->save();
        $customer['product_detail'] = $saleRecord->product;
        $customer['qty'] = request('qty');
        $customer['billId'] = $saleRecord->id;
        $customer['price'] = $saleRecord->price;

        return $customer;
    }

    public function update(Request $request)
    {

        $product = Product::find($request->record['id']);
        $product->itemname = $request->record['itemname'];
        $product->companyname = $request->record['companyname'];
        $product->model = $request->record['model'];
        $product->color = $request->record['color'];
        $product->price = $request->record['price'];
        $product->save();
    }

    public function records(Request $request)
    {
        return Product::where('number', ' <= ', $request->get('number'))->get();
//        echo "<pre>";
//        print_r($record);
//        echo "</pre>";
//        exit;
//        $data = $record->number <= $request->get('number');
//        return $data;
    }

    public function changeStatus()
    {
        $product = Product::find(\request('id'));
        $product->product_status = $product->product_status == 'active' ? 'inactive' : 'active';
        $product->save();
        return $product;
    }

    public function activerecord(Request $request)
    {
        if ($request->active) {
            return Product::where('product_status', 'active')->get();
        } else {
            return Product::where('product_status', 'inactive')->get();
        }

    }

}
