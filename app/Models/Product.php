<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','quantity'];


    // Relationship between Product and Ingredient
    public function ingredients(){
        $this->belongsToMany(Ingredient::class);
    }

    // Relationship between Product and Order
    public function orders(){
        $this->belongsToMany(Order::class);
    }
}
