<?php

namespace App\Http\Controllers;

use App\Order;
use App\Tracking;
use App\PurchaseOrder;
use App\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class OrderController extends Controller
{

    public function index()
    {
        $riwayat = PurchaseOrder::where('user_id', Auth::user()->id)->with(['user', 'orders.product'])->get();
        $user = Auth::user();
        if($user->group_id == 'DRIVER'){
            return view('driver.order', compact('riwayat'));
        }else{
            return view('client.order', compact('riwayat'));
        }
    }

    public function viewRiwayat() {
        return view('dashboard.riwayat');
    }

    public function dataRiwayat() {
        $data = PurchaseOrder::orderBy('created_at', 'desc')
            ->with(['orders.product', 'user'])
            ->get();
        return datatables($data)->toJson();
    }

    public function proses($id) {
        $user = Auth::user();
        $dataSend = [];
        
        if($user->group_id == 'DRIVER'){
            $data = Tagihan::with(['po.user', 'orders' => function($db) {
                                return $db->whereIn('status', ['DISETUJUI SEBAGIAN','DISETUJUI SEMUA','SENT']);
                            },'orders.product.stock','trackings','tracking_newest','order_last_status'])
                            ->where('driver_id',$user->id)
                            ->get();
            return datatables($data)->toJson(); 
        }else{
            $SQLtotalUangPesanan = Order::leftjoin('products as pr','pr.id','=','orders.product_id')
                                        ->selectRaw('sum(pr.harga*qty) as total_harga, po_id')
                                        ->groupBy('po_id')
                                        ->where('orders.status',DB::raw("'AWAL PESAN'"))
                                        ->toSql();
            // return $SQLtotalUangPesanan;
            $data = PurchaseOrder::with(['user', 'tagihans.orders.product.stock', 'tagihans.orders' => function($db) {
                            return $db->whereIn('status', ['DISETUJUI SEBAGIAN','DISETUJUI SEMUA','SENT']);
                        },'tagihans.trackings','tagihans.tracking_newest','tagihans.driver','order_last_status','order_awal.product'])
                        ->leftjoin(DB::raw('('.$SQLtotalUangPesanan.' )total_uang'),'total_uang.po_id','=','purchase_orders.id')
                        ->when($user, function ($db) use ($user){
                            if($user->group_id == 'DRIVER'){
                                return $db->whereHas('tagihans', function($table) use ($user) {
                                    return $table->where('driver_id',$user->id);
                                });
                            }else{
                                return $db->whereHas('user', function($table) use ($user) {
                                    return $table->where('user_id',$user->id);
                                });
                            }                       
                        })
                    ->get();
            return datatables($data)->toJson();
        }
        
    }

    public function tertunda($id) {
        $data = Order::where('status', 'PENDING')->whereHas('po', function($query) use ($id) {
                return $query->where('user_id', $id);
            })
            ->with(['product', 'po']);
        return datatables($data)->toJson();
    }

    public function return($id) {
        $data = Order::where('status', 'RETURN')->whereHas('po', function($query) use ($id) {
            return $query->where('user_id', $id);
        });
        return datatables($data)->toJson();
    }

    public function storeReturn(Request $request) {
        $orderIds = $request->input('returnIds') ?? [];
        $purchaseOrder = PurchaseOrder::find($request->input('id'));
        $purchaseOrder->orders->each(function($item, $key) use ($orderIds, $request) {
            foreach ($orderIds as $i => $it) {
                if ($item->id == $it) {
                    $replicate = $item->replicate();
                    $replicate->qty = $request->input($it);
                    $replicate->status = 'RETURN';
                    $replicate->save();

                    $item->status = 'DONE';
                    $item->save();

                    return;
                }
            }

            if ($item->status != 'PENDING' || $item->status != 'RETURN') {
                $item->status = 'DONE';
                $item->save();
            }
        });

        return response(['data' => 'success'], 200);
    }

    public function storePickup(Request $request) {
        // return $request->all();
        $orderIds = $request->input('id_order') ?? [];
        // $purchaseOrder = PurchaseOrder::find($request->input('id'));

        Tracking::create([
            'tagihan_id' => $request->id,
            'driver_id' => Auth::user()->id,
            'target' => $request->target,
            'status' => 'SENDING'
        ]);     

        return response(['data' => 'success'], 200);
    }

    public function storeArrive(Request $request) {
        // return $request->all();
        // $purchaseOrder = PurchaseOrder::find($request->input('id'));
        $cek_return = false;
        $orderIds = $request->input('id_order') ?? [];

        $order = Order::whereIn('id',$orderIds)->get();
        
        foreach ($order as $key => $value) {
            $newQty = $value->qty - $request->input($value->id);

            if ($newQty > 0) {
                $return = $value->replicate();
                $return->status = 'RETURN';
                $return->qty = $request->input($value->id);
                $return->created_at = date('Y-m-d H:i:s');
                $return->save();
                $cek_return = true;
            } else {
            }   
        }

        if ($cek_return == true) {
            $status = 'ARRIVED WITH RETURN';
        } else {
            $status = 'ARRIVED';
        }
        // return $status;
        
        Tracking::create([
            'tagihan_id' => $request->id,
            'driver_id' => Auth::user()->id,
            'target' => $request->target,
            'status' => $status
        ]);     

        return response(['data' => 'success'], 200);
    }

    public function storeConfirm(Request $request) {
        // return $request->all();
        $orderIds = $request->input('id_order') ?? [];
        $purchaseOrder = PurchaseOrder::find($request->input('id'));

        $order = Order::whereIn('id',$orderIds)->each(function($item, $key) use ($orderIds, $request) {
            $item->qty = $request->input($item->id);
            $item->status = 'DONE';
            $item->save();            
        });

        return response(['data' => 'success'], 200);
    }

    public function riwayat($id) {
        $data = PurchaseOrder::where('user_id', $id)->whereHas('orders', function($db) {
            return $db->where('status', 'DONE');
        });
        return datatables($data)->toJson();
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request)
    {
        try {
            $returns = $request->post('data');
            $po_id = 0;
            $cart = array();
            $order_ids = array();
            foreach ($returns as $returns => $item) {
                // return response($item, 200);
                # code...
                // array_push($product_ids, $item['product_id']);
                $data = Order::find($item['id']);
                $po_id = $item['po_id'];
                array_push($order_ids, $item['id']);
                // $data->qty = $item['qty'];
                // $data->qty = $data->qty - $item['qty'];
                $qty = $item['qty'];
                $newQty = $data->qty - $item['qty'];
                $status = '';
                if ($newQty > 0) {
                    # code...
                    $replicate = $data->replicate();
                    $replicate->status = 'PENDING';
                    $replicate->qty = $newQty;
                    $replicate->created_at = date('Y-m-d H:i:s');
                    $replicate->save();

                    $status = 'DISETUJUI SEBAGIAN';  
                }elseif ($newQty <= 0) {
                    $qty = $data->qty;
                    $status = 'DISETUJUI SEMUA';   
                }
                $data->status = $status;
                $data->qty = $qty;
                array_push($cart, $data);
                $data->save();
            }

            $partialOrder = Order::wherein('status', ['DISETUJUI SEBAGIAN', 'DISETUJUI SEMUA'])->where('po_id', $po_id)->whereIn('orders.id', $order_ids);
            // return response($partialOrder->get(), 200);
            $totalPartialApprove = $partialOrder->leftjoin('products as pr', 'pr.id', '=', 'orders.product_id')
                                                ->selectRaw('sum( pr.harga * qty) as total')
                                                ->first()->total;
            $partialData = [
                'po_id' => $po_id,
                'nominal_total' => $totalPartialApprove
            ];

            $partialDataTagihan = Tagihan::create($partialData);
   			$partialOrder->update([
                'tagihan_id' => $partialDataTagihan->id
            ]);
			// 	echo $partialOrder->get();
	
			// 	foreach ($partialApprove as $item) {
			// 		foreach ($awalPesan as $awalan) {
			// 			if ($awalan->product_id == $item->product_id) {
			// 				if ($awalan->qty == $item->qty) {
			// 					$item->status = 'DISETUJUI SEMUA';
			// 					$item->save();
			// 				}
			// 			}
			// 		}
			// 	}
			// }

            // $data->save();
            
            DB::commit();
            $code = 200;
        } catch(Exception $e) {
            DB::rollBack();
            $code = 400;
        }

        return response(['data' => $request->post('data')], 200);
    }
}
