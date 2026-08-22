<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';
    protected $fillable = ['nameGenre', 'description'];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
