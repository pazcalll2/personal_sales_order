<?php

namespace App\Http\Controllers;

use App\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function index()
    {
        return response([
            'status' => 'success',
            'message' => 'Berhasil load data',
            'data'    => Driver::where('status', 'ACTIVE')->with('user')->get()
        ], 200);
    }
}
