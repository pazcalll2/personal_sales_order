<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tracking;

class Tagihan extends Model
{
    //
    use Columns;

    public function po() {
        return $this->belongsTo(PurchaseOrder::class, 'po_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'tagihan_id');
    }    

    public function trackings() {
        return $this->hasMany(Tracking::class, 'tagihan_id');
    }    

    public function driver() {
        return $this->belongsTo(User::class, 'driver_id');
    }    

    public function tracking_newest() {
        $data_tracking_terkini = Tracking::selectRaw("max(id) as id, tagihan_id")->groupBy('tagihan_id')->pluck('id');
        return $this->hasMany(Tracking::class, 'tagihan_id')->whereIn('id', $data_tracking_terkini);
    }    

    public function order_last_status() {
        $data_last_status = Order::selectRaw("max(id) as id, product_id")->groupBy('product_id')->whereNotIn('status',['PENDING'])->pluck('id');
        return $this->hasMany(Order::class, 'po_id')->whereIn('id', $data_last_status)->orderBy('product_id','asc');
    }    
}
