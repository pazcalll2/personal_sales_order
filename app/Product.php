<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use Columns;

    public function category() {
        return $this->belongsTo(Category::class, 'kategori');
    }

    public function forecasts() {
        return $this->hasMany(Forecast::class, 'product_id');
    }

    public function images() {
        return $this->hasMany(Image::class, 'product_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'product_id');
    }

    public function stock() {
        return $this->belongsTo(Stock::class, 'id', 'product_id');
    }

    public function stocks() {
        return $this->hasMany(Stock::class, 'product_id');
    }

    public function variation() {
        return $this->hasMany(Variation::class, 'product_id');
    }

    public function merek() {
        return $this->belongsTo(Merek::class, 'merek');
    }

}
