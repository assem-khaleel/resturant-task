<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name','stock','updated_stock'];

    // Relationship between Ingredient and Product
    public function products(){
        $this->belongsToMany(Product::class);
    }
}
