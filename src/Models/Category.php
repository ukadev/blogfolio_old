<?php

namespace Ukadev\Blogfolio\Model;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $fillable = ['name'];

    public function post()
    {
        return $this->belongsTo(\Ukadev\Blogfolio\Model\Post::class);
    }
}
