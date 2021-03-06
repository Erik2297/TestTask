<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $fillable = [
        'unit_price',
        'updated_at'
    ];
    use HasFactory;
    public $timestamps = true;
}
