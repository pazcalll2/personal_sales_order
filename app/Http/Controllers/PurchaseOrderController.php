<?php

namespace App\Http\Controllers;

use App\LogStock;
use App\Order;
use App\Product;
use App\PurchaseOrder;
use App\Tracking;
use App\Tagihan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.purchase-order');
    }

    public function perintahKirim()
    {
        return view('dashboard.perintah-kirim');
    }

    public function tagihan()
    {
        return view('dashboard.tagihan');
    }

    public function pesananProses()
    {
        return view('dashboard.pesanan-proses');
    }

    public function dataTagihan(){
        return response([
            'status'  => 'message',
            'message' => 'Berhasil load data',
            'data'    => PurchaseOrder::whereHas('orders', function($table)  {
                return $table->where('jatuh_tempo','!=',null);
            })
            ->with('orders.product.stock', 'user')
            ->get()
        ], 200);
    }

    public function detailTagihan(Request $request){
        return response([
            'status'  => 'message',
            'message' => 'Berhasil load data',
            'data'    => Order::whereHas('po', function($table) use ($request)  {
                return $table   ->where('po_id', $request->po_id)
                                ->whereIn('status', ['DISETUJUI SEBAGIAN','DISETUJUI SEMUA', 'RETURN']);
            })->with('po.user','product')
            ->get()
        ], 200);
    }


    public function pending() {
        return view('dashboard.pending-order');
    }

    public function newPurchaseOrder() {
        $status = 'BELUM DISETUJUI';

        $data = PurchaseOrder::with(['orders.product.stock', 'user', 'orders'=> function($db) {
                return $db->where('status', 'BELUM DISETUJUI');
            }])
            ->whereHas('orders', function($table) use ($status){
                return $table->where('tagihan_id', null)->where('status', $status)->whereNotIn('status', ['AWAL PESAN', 'PENDING', 'DISETUJUI SEBAGIAN', 'DISETUJUI SEMUA']);
            })
            // ->whereHas('orders', function($table) use ($status){
            //     return $table->where('status', $status)->whereNotIn('status', ['AWAL PESAN']);
            // })
            // ->doesnthave('tagihans')
            ->get();

        return response([
            'status'  => 'message',
            'message' => 'Berhasil load data',
            'data'    => $data
        ], 200); 

        // $maxOrder = Order::selectRaw("MAX(id) AS id, product_id")->groupByRaw('product_id')->get()->pluck('id');

        // $data = PurchaseOrder::with(['orders.product.stock', 'user', 'orders' => function($db) use ($query,$maxOrder) {
        //         return $db->whereIn('id',$maxOrder)->where('status', $query);
        //     }])
        //     ->whereHas('orders', function($table) use ($query,$maxOrder) {
        //         return $table->whereIn('id',$maxOrder)->where('status', $query);
        //     })
        //     ->get();        
        // return $this->loadData();
    }

    public function pendingOrder() {
        return $this->loadData('PENDING');
    }

    public function sentOrder() {

        $data = PurchaseOrder::with(['user', 'tagihans.orders.product.stock', 'tagihans' => function($table)  {
                return $table->whereNull('driver_id');
            }])
            ->whereHas('tagihans', function($table)  {
                return $table->whereNull('driver_id');
            })
            ->get();
        // dd($data);
        return response([
            'status'  => 'message',
            'message' => 'Berhasil load data',
            'data'    => $data
        ], 200); 
    }

    public function riwayat() {
        $data = PurchaseOrder::with(['orders.product.stock', 'user', 'orders'])->orderBy('created_at', 'desc')->get();
        return response([
            'status'  => 'message',
            'message' => 'Berhasil load data',
            'data'    => $data
        ], 200);
    }

    private function loadData($query)
    {
        $data = PurchaseOrder::with(['orders.product.stock', 'user', 'orders' => function($db) use ($query) {
                return $db->where('status', $query);
            }])
            ->whereHas('orders', function($table) use ($query) {
                return $table->where('status', $query);
            })
            ->get();

        // $maxOrder = Order::selectRaw("MAX(id) AS id, product_id")->groupByRaw('product_id')->get()->pluck('id');

        // $data = PurchaseOrder::with(['orders.product.stock', 'user', 'orders' => function($db) use ($query,$maxOrder) {
        //         return $db->whereIn('id',$maxOrder)->where('status', $query);
        //     }])
        //     ->whereHas('orders', function($table) use ($query,$maxOrder) {
        //         return $table->whereIn('id',$maxOrder)->where('status', $query);
        //     })
        //     ->get();

        return response([
            'status'  => 'message',
            'message' => 'Berhasil load data',
            'data'    => $data
        ], 200);
    }

    public function getPesananProses()
    {
        // return PurchaseOrder::with(['orders.product'])->get();

        $data = PurchaseOrder::with(['user', 'tagihans.orders.product.stock', 'tagihans.orders' => function($db) {
                        return $db->whereIn('status', ['DISETUJUI SEBAGIAN','DISETUJUI SEMUA','SENT']);
                    },'tagihans.trackings','tagihans.tracking_newest','tagihans.driver'])
                ->whereHas('tagihans', function($table)  {
                    return $table->whereNotNull('driver_id');
                })
                ->get();
        
        // $data = PurchaseOrder::with(['orders.product.stock', 'user', 'orders' => function($db) {
        //         return $db->whereNotIn('status', ['PENDING']);
        //     }, 'tagihans.orders.tracking.drivers'])
        //     ->whereHas('tagihans', function($table)  {
        //         return $table->whereNotNull('driver_id');
        //     })
        //     ->get();

        return response([
            'status'  => 'message',
            'message' => 'Berhasil load data',
            'data'    => $data
        ], 200);
    }

    public function store(Request $request)
    {
        // dd($request->input('data'), $request->input('total'));
        DB::beginTransaction();
        if (Auth::user()->group_id == 'AGENT') {
            $limit = Auth::user()->agent->limit;
            if ($request->input('total') >= $limit) {
                return response([
                    'status'  => 'error',
                    'message' => 'Anda melebihi limit belanja.',
                    'data'    => []
                ], 400);
            }
        }
        try {

            $noNota = function() {
                $id = base64_encode(base64_encode(base64_encode(Auth::user()->id)));
                $time = date('YmdHis');
                return 'ORD-'.$id.$time;
            };

            $purchaseOrder = PurchaseOrder::create([
                'no_nota' => $noNota() ,
                'user_id' => Auth::user()->id ]
            );

            foreach($request->input('data') as $i => $item) {
                $newOrder = Order::create([
                    'po_id'      => $purchaseOrder->id,
                    'product_id' => $item['id'],
                    'qty'        => $item['qty']
                ]);

                $replicate = $newOrder->replicate();
                $replicate->status = 'BELUM DISETUJUI';
                $replicate->save();                
            }

            DB::commit();

            return response([
                'message' => 'Terimakasih sudah membeli product kami',
                'data' => []
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();

            return response(['message' => ''], 400);
        }
    }

    public function sentPesanan(Request $request){
            // return $request->all();

            foreach($request->data as $key => $item) {

                $tagihan = Tagihan::find($item['tagihan_id']);
                $tagihan->driver_id = $request->id_driver;
                $tagihan->save();

                $purchaseOrder = PurchaseOrder::find($item['po_id']);
                $purchaseOrder->jatuh_tempo = $request->input('jatuh_tempo');
                $purchaseOrder->save();

                $filteredPO = $purchaseOrder->with(['orders.product','orders' => function($db) use ($item){
                    $db->where('tagihan_id',$item['tagihan_id']);
                }])->whereHas('tagihans', function ($query) use ($item){
                    $query->where('id',$item['tagihan_id']);
                })->first();

                // return $filteredPO;
                Tracking::create([
                    'tagihan_id' => $item['tagihan_id'],
                    'driver_id' => $request->id_driver,
                    'target' => $purchaseOrder->user->group_id,
                    'status' => 'WAITING TO PICKUP'
                ]);

                foreach ($filteredPO->orders as $key1 => $value1) {
                    $stock = Product::find($value1->product_id)->stock;
                    $stock->stock = $stock->stock - $value1->qty;

                    LogStock::create([
                        'stock_id' => $stock->id,
                        'type' => 'OUT',
                        'note' => "Barang dibeli oleh ". $purchaseOrder->user->group_id. ' dengan nama : '. $purchaseOrder->user->name,
                        'before' => $stock->stock,
                        'current' => $stock->stock - $value1->qty
                    ]);
                    $stock->save();
                }

            }

        try {
            DB::beginTransaction();



            DB::commit();
            $code = 200;
        } catch(Exception $e) {
            DB::rollBack();
            $code = 400;
        }

        return response([
            'message' => 'Berhasil mengubah status order menjadi dikirim',
            'data' => []
        ], $code);
    }
}
