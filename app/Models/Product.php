<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    protected $hidden = [
        'deleted_at',
    ];



    public function scopeExpensive($query)
    {
        return $query->where('price', '>', 1000);
    }

    public function scopeCheap($query)
    {
        return $query->where('price', '<', 1000);
    }


   public function orders()
{
    return $this->belongsToMany(Order::class)
        ->withPivot('quantity', 'price')
        ->withTimestamps();
}
}
