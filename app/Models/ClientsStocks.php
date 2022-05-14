<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsStocks extends Model
{
    use HasFactory;
    public $timestamps = true;
    public function stock(){
        return $this->belongsTo(Stocks::class , 'stock_id');
    }
    public function client(){
        return $this->belongsTo(Clients::class , 'client_id');
    }
}
