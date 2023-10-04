<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'intro', 'content', 'publication_date', 'category_id', 'image_name'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function getAllCategories()
    {
        return Category::all();
    }
}
