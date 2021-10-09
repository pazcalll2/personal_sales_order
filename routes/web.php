<?php

use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/page/{blade}', function ($blade) {
    return view($blade);
});

Route::get('/', [CatalogueController::class, 'index']);
Route::post('/search', [CatalogueController::class, 'search']);
Route::get('/filter', [CatalogueController::class, 'filter']);


Route::get('/index-tabel', [CatalogueController::class, 'tabel']);
Route::get('/not-found', [CatalogueController::class, 'notFound']);
Route::get('/product/{id}', [CatalogueController::class, 'show']);
Route::post('/detail', [CatalogueController::class, 'detail']);
Route::get('/tracking', [TrackingController::class, 'client']);


// IKI CUMA GE RETURN DATA JSON TULUNG LAH BEN RAPI NGONO BEN PENAK APAL"ANE
Route::prefix('data')->group(function () {
    Route::get('catalogue/products', [CatalogueController::class, 'catalogue']);

    Route::get('/purchase-order/new', 'PurchaseOrderController@newPurchaseOrder');
    Route::get('/purchase-order/pending', 'PurchaseOrderController@pendingOrder');
    Route::get('/purchase-order/perintah-kirim', 'PurchaseOrderController@sentOrder');
    Route::get('/purchase-order/proses', 'PurchaseOrderController@getPesananProses');
    Route::get('/purchase-order/riwayat', 'PurchaseOrderController@riwayat');

    Route::post('/purchase-order/kirim', 'PurchaseOrderController@sentPesanan');
    Route::get('/purchase-order/tagihan', 'PurchaseOrderController@dataTagihan');
    Route::post('/purchase-order/detailTagihan', 'PurchaseOrderController@detailTagihan');

    Route::get('/order/{id_user}/prosses', [OrderController::class, 'proses']);
    Route::get('/order/{id_user}/tertunda', [OrderController::class, 'tertunda']);
    Route::get('/order/{id_user}/return', [OrderController::class, 'return']);
    Route::get('/order/riwayat', [OrderController::class, 'dataRiwayat']);
    Route::post('/order/return', [OrderController::class, 'storeReturn']);
    Route::post('/order/pickup', [OrderController::class, 'storePickup'])->name('storePickup');
    Route::post('/order/arrive', [OrderController::class, 'storeArrive'])->name('storeArrive');
    Route::post('/order/confirm', [OrderController::class, 'storeConfirm'])->name('storeConfirm');

    Route::get('/return/pesanan', 'ReturnOrderController@data');

    Route::get('/drivers', [DriverController::class, 'index']);
    Route::get('/tracking', 'TrackingController@data');
});

// admin
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::resources([
        'menu' => 'MenuController',
        'user' => 'AgentController',
        'merek' => 'MerekController',
        'kategori' => 'KategoriController',
        'tracking' => 'TrackingController',
        'forecasting' => 'ForecastController'
    ]);

    // produk
    Route::resource('produk', 'ProductController');
    Route::post('produk/{produk}/visible', 'ProductController@setVisible');
    Route::get('produk/inventory/stock', 'ProductController@inventory');
    Route::post('produk/inventory/stock', 'ProductController@updateStock');
    Route::get('produk/inventory/stock/datatables', 'ProductController@inventoryDatatables');
    Route::get('produk/inventory/stock/{type}/{id}/datatables', 'ProductController@inventoryInOutDatatables');

    Route::get('/order/purchase-order', 'PurchaseOrderController@index');
    Route::get('/order/perintah-kirim', 'PurchaseOrderController@perintahKirim');
    Route::get('/order/tagihan', 'PurchaseOrderController@tagihan');
    Route::get('/order/proses', 'PurchaseOrderController@pesananProses');
    Route::get('/order/pending', 'PendingOrderController@index');
    Route::get('/order/pending', 'PurchaseOrderController@pending');
    Route::post('/order/update', 'OrderController@update');
    Route::get('/order/riwayat', 'OrderController@viewRiwayat');

    // return
    Route::get('/return/pesanan', 'ReturnOrderController@index');
    Route::get('/return/approval', 'ReturnOrderController@data');

    // tagihan
    Route::get('/tagihan/kirim', 'TagihanController@index');
    Route::get('/tagihan/lihat', 'TagihanController@show');
    Route::get('/tagihan/bayar', 'TagihanController@bayar')->name('pembayaran');
    Route::get('/tagihan/cetak', 'TagihanController@cetak_tagihan')->name('cetak_tagihan');
    Route::get('/surat_jalan/cetak', 'TagihanController@cetak_surat_jalan')->name('cetak_surat_jalan');
    Route::post('/tagihan/add', 'TagihanController@store')->name('addTagihan');

    // Pembayaran
    Route::get('/pembayaran');
});

// untuk user: agent dan customer
Route::group(['middleware' => 'auth'], function () {
    Route::resource('/profile', 'ProfilController');
    Route::post('/profile_update/{id?}', 'ProfilController@update')->name('profile_update');

    Route::get('/profile_pending', 'ProfilController@pending');
    Route::get('/profile_return', 'ProfilController@return');

    // purchase-order
    Route::get('/order', 'OrderController@index');
    Route::post('/order/purchase-order', 'PurchaseOrderController@store');
    Route::post('/order/upload', 'TagihanController@upload');
    Route::get('/order/payment', 'PaymentController@index');
    Route::get('/order/getPayment', 'PaymentController@getPayment');

    Route::get('/session/{key}', 'SessionController@retrieve');
    Route::post('/session/save', 'SessionController@store');
    Route::post('/session/remove', 'SessionController@remove');
});


Route::get('storage/{foldername}/{filename}', function ($foldername, $filename) {
    $path = storage_path('app/public/' . $foldername . '/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }

    $path = storage_path('app/public/' . $foldername . '/' . $filename);
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
