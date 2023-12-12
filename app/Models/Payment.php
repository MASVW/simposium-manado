<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    public $timestamp = true; 
    public $incrementing = false;

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function buckets(){
        return $this->hasMany(Bucket::class);
    }
    public function datas(){
        return $this->hasMany(Datas::class);
    }
}
