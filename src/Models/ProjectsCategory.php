<?php

namespace Ukadev\Blogfolio\Model;

use Illuminate\Database\Eloquent\Model;


class ProjectsCategory extends Model
{
    protected $fillable = ['name'];

    public function projects()
    {
        return $this->belongsTo(\Ukadev\Blogfolio\Model\Project::class);
    }
}