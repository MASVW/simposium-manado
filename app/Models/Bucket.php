<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    use HasFactory;

    protected $guarded=[''];

    protected $table = 'buckets';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    public $timestamp = true; 
    public $incrementing = true;
    public function payments(){
        return $this->belongsTo(Payment::class);
    }
    public function prices(){
        return $this->belongsTo(Prices::class);
    }
    
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function datas(){
        return $this->belongsTo(Datas::class);
    }
    public function events(){
        return $this->belongsTo(Events::class);
    }

}
