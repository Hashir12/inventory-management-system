<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;

class TestController extends Controller
{
    public function test(Request $request)
    {
        return Customers::where('cname', 'like', '%' . $request->name . '%')->get();
    }
}
