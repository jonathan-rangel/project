<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smartphone extends Model
{
    use HasFactory;

    public $table = 'smartphones';

    protected $fillable = ['name', 'slug', 'brand', 'description',
                             'specs', 'stock', 'image_name',
                             'price', 'sale_price', 'created_at',
                             'updated_at'];
}
