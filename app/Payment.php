<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    use Columns;
    
    public function po() {
        return $this->belongsTo(PurchaseOrder::class, 'po_id');
    }
}
