<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleRecords extends Model
{
    public $fillable = ['products_id', 'bill_id', 'user_id', 'price', 'qty'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }

}
