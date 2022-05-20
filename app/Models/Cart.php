<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Smartphone;

class Cart extends Model
{
    use HasFactory;

    public $table = 'carts';

    protected $fillable = ['smartphone_id', 'quantity', 'total_price',
                            'user_id', 'created_at', 'updated_at'];

    // Relationship

    public function smartphone() {
        return $this->hasMany(Smartphone::class, 'id', 'smartphone_id');
    }

}


