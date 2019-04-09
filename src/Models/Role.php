<?php

namespace Ukadev\Blogfolio\Model;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    protected $fillable = [
        'user_id', 'role_id',
    ];

    public function user()
    {
        return $this->belongsTo(\Ukadev\Blogfolio\Model\User::class);
    }
}
