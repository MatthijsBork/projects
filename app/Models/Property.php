<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function productProperties()
    {
        return $this->hasMany(ProductProperty::class);
    }

    public function value($product_id)
    {
        $productProperty = ProductProperty::where('product_id', $product_id)
            ->where('property_id', $this->id)
            ->first();

        return $productProperty ? $productProperty->value : null;
    }

}
