<?php

namespace App\Http\Controllers;

use App\Image;
use App\LogStock;
use App\Product;
use App\Stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $stocks = Stock::where('user_id', Auth::user()->id)->get();
        return view('dashboard.product', compact('stocks'));
    }

    public function create()
    {
        return view('dashboard.new-product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json(['data' => $request->all()], 200);

        $input = $request->except(['_token', 'stock', 'photo']);

        try {
            DB::beginTransaction();

            $data = Product::create($input);

            Stock::create([
                'user_id' => Auth::id(),
                'product_id' => $data->id,
                'stock' => $request->get('stock')
            ]);

            Helper::storeImage($request, 'photo', function($hashname) use ($data) {
                Image::create([
                    'path' => $hashname,
                    'product_id' => $data->id
                ]);
            });

            DB::commit();
            return response([
                'message' => 'Berhasil Memasukkan data',
                'data' => $data
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response(['message' => 'error', 'exception' => $e->getTraceAsString()], 400);
        }
    }

    public function show(Product $product)
    {
        //
    }

    public function edit($product)
    {
        $product = Product::find($product);
        return view('dashboard.new-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

    }

    public function setVisible($product)
    {
        $product = Product::find($product);
        $status = $product->ditampilkan === 0 ? 'menampilkan' : 'menyembunyikan';

        try {
            DB::beginTransaction();

            $product->ditampilkan = $product->ditampilkan === 0 ? 1 : 0;
            $product->save();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => "Berhasil $status data produk dari katalog."
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => "Gagal $status data produk dari katalog."
            ], 400);
        }
    }

    public function inventory() {
        return view('dashboard.inventory');
    }

    public function updateStock(Request $request) {
        $input = $request->except('_token');
        LogStock::create($input);
        $stock = Stock::find($request->input('stock_id'));
        $stock->stock = $request->input('current');
        $stock->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengupdate stock product '. $stock->product->nama,
        ], 200);
    }

    public function inventoryDatatables() {
        $data = Product::with(['category', 'stock']);
        return datatables($data)->toJson();
    }

    public function inventoryInOutDatatables($type, $id) {
        $data = LogStock::whereHas('stock', function($table) use ($id) {
                return $table->where('user_id', Auth::user()->id)->where('product_id', $id);
            })
            ->where('type', strtoupper($type));

        return datatables($data)->toJson();
    }

    public function destroy($product)
    {
        try {
            DB::beginTransaction();

            $product = Product::find($product);
            $product->delete();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menghapus data product',
                'data' => $product
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data product'
            ], 400);
        }
    }
}
