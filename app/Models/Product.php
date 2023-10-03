<?php

namespace App\Models;

use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'stock', 'vat', 'image_name'];

    public function properties()
    {
        return $this->hasMany(ProductProperty::class);
    }

    public static function getAllProperties()
    {
        return Property::all();
    }
}
