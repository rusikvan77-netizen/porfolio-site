<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviews extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'post_id', 'comment', 'rating', 'approved', 'moderator_id', 'moderated_at', 'rejection_at'];
    protected $dates = ['deleted_at'];
    public function moderator()
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
