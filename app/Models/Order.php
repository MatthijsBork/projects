<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    private function recalculateTotals()
    {
        // $total = $this->price * $this->amount;
        // $this->gross_total += $total;
        // $this->net_total += $total + $total * ($this->vat / 100);
        // $this->taxed_total += $total * ($this->vat / 100);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function shipping()
    {
        return $this->addresses()->byType('shipping')->first();
    }

    public function invoice()
    {
        return $this->addresses()->byType('invoice')->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function productsNotInOrder()
    {
        $assignedProductIds = $this->products->pluck('product_id');
        return Product::whereNotIn('id', $assignedProductIds)->get();
    }

    public function netTotal()
    {
        $net = 0;
        $net_product = 0;
        foreach ($this->products as $product) {
            $net_product = $product->price + ($product->price * ($product->vat / 100));
            $net += $net_product * $product->amount;
        }
        return $net;
    }
}
