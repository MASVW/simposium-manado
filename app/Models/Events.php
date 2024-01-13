<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function buckets(){
        return $this->belongsTo(Bucket::class);
    }
    public function prices(){
        return $this->hasMany(Prices::class);
    }
    public function datas(){
        return $this->hasMany(Datas::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
