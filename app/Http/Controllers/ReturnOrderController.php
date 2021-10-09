<?php

namespace App\Http\Controllers;

use App\Order;
use App\ReturnOrder;
use Illuminate\Http\Request;

class ReturnOrderController extends Controller
{

    public function index()
    {
        return view('dashboard.return-order');
    }

    public function data()
    {
        $data = Order::where('status', 'RETURN')->with(['po.user', 'product']);
        return datatables($data)->toJson();
    }
}
