<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'amount',
        'price',
        'created_at',
        'updated_at',
    ];
}
