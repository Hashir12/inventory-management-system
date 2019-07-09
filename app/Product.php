<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = ['itemname', 'companyname', 'model', 'color', 'number', 'price', 'product_status'];
}
