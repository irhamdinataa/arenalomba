<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagCourse extends Model
{
    use HasFactory;

    protected $table = 'tag_course';

    protected $fillable = [
    	'name', 'slug'
    ];

    protected $hidden = [

    ];

    public function post()
    {
        return $this->belongsToMany(Post::class);
    }
}
