<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['name', 'price', 'description', 'category_id', 'img'];
    protected $created_at = 'Y-m-d';
    protected $update_at = 'Y-m-d';
    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function genre(){
        return $this->belongsTo(Genre::class);
    }
}
