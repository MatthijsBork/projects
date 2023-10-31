<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    public function addOne()
    {
        $this->amount++;
        $this->save();
    }

    public function subtractOne()
    {
        if ($this->amount <= 1) {
            $this->delete();
        } else {
            $this->amount--;
            $this->save();
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        $this->belongsTo(Order::class);
    }
}
