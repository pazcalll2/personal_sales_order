<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    //
    use Columns;
    // protected $visible = ['status'];

    public function orders() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function drivers() {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
