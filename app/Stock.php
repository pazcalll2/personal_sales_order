<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    use Columns;

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
