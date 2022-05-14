<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [
        'cash'
    ];
    use HasFactory;
    public $timestamps = true;
    public function stocks(){
        return $this->hasMany(ClientsStocks::class , 'client_id')->with('stock');
    }
}
