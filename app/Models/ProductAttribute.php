<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use Logable;

    //
    protected $fillable = ['product_id', 'attribute_id'];
}
