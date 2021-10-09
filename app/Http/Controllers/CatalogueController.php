<?php

namespace App\Http\Controllers;

use App\Image;
use App\Product;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    public function index()
    {
        return view('catalogue.index');
    }

    public function tabel()
    {
        return view('catalogue.index-table');
    }

    public function notFound() {
        return view('catalogue.not-found');
    }

    public function show($id)
    {
        return view('catalogue.detail', compact('id'));
    }

    public function catalogue()
    {
        $product = Product::with(['images', 'stocks', 'category'])->where('ditampilkan', 0);
        return $this->response($product);
    }

    public function detail(Request $request){
        $product = Product::with(['images', 'stocks', 'category'])->where('ditampilkan', 0)->where("id", $request->id);
        return $this->response($product);
    }

    public function search(Request $request)
    {
        session()->forget(['filter']);
        $input = $request->search;
        $product = Product::with(['images', 'stocks', 'category'])->where('nama', 'like', '%' . $input . '%');
        return $this->response($product);
    }

    public function filter(Request $request)
    {
        if (!empty($request->all())) {
            $filterBy = $request->all();
            session(['filter' => $filterBy]);
        } else {
            return redirect(url('/'));
        }

        $filter = session()->get('filter') ?? [];
        $hargaMin = session()->get('filter')['hargaMin'];
        $hargaMax = session()->get('filter')['hargaMax'];
        $product = Product::with(['images', 'stocks', 'category']);

        if ($hargaMin != null) {
            $product = $product->where('harga', '>=', $hargaMin);
        }
        if ($hargaMax != null) {
            $product = $product->where('harga', '<=', $hargaMax);
        }
        foreach($filter as $key => $value) {
            if ($key != 'hargaMin' && $key != 'hargaMax' && $value != null) {
                $product = $product->where($key, $value);
            }
        }

        return $this->response($product);
    }

    private function response($product) {
        return response()->json([
            'status' => 'success',
            'message' => "Berhasil load data produk dari katalog.",
            'data' => $product->paginate(4)
        ], 200);
    }
}
