<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    use HasFactory;
    protected $guarded = [''];

    protected $table = 'prices';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    public $timestamp = true; 
    public $incrementing = true;

    public function buckets(){
        return $this->hasMany(Bucket::class);
    }
    public function events(){
        return $this->belongsTo(Events::class);
    }
    public function jobs(){
        return $this->belongsTo(Events::class);
    }
}
