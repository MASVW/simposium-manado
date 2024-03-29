<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'positions';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    public $timestamps = false; 
    public $incrementing = false;
    public function prices(){
        return $this->hasMany(Prices::class);
    }
    public function datas(){
        return $this->hasMany(Datas::class);
    }
}
