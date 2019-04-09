<?php

namespace Ukadev\Blogfolio\Model;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content'
    ];

    public function user()
    {
        return $this->belongsTo(\Ukadev\Blogfolio\Model\User::class);
    }

    public function category()
    {
        return $this->hasOne(PostsCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(PostsComment::class);
    }
}