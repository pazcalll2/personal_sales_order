<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    use Columns;

    public function po() {
        return $this->belongsTo(PurchaseOrder::class, 'po_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function tagihan() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function tracking() {
        return $this->hasMany(Tracking::class, 'order_id');
    }


}
