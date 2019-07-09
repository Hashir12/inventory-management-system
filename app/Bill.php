<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $fillable = ['customer_id', 'user_id', 'discount', 'date'];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function saleRecords()
    {
        return $this->hasMany(SaleRecords::class, 'bill_id');
    }

}
