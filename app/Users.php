<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = ['username', 'password', 'user_type', 'user_role', 'email'];

    public function products()
    {
        return $this->hasMany(SaleRecords::class, 'user_id', 'id');
    }
}
