<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'datas';
    protected $primaryKey = 'id';
    protected $keyType  = 'int';
    public $timestamps = true; 
    public $incrementing = true;

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function buckets(){
        return $this->hasOne(Bucket::class);
    }
    public function positions(){
        return $this->belongsTo(Position::class);
    }
    public function payments(){
        return $this->belongsTo(Payment::class);
    }

}
