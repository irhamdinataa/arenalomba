<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagContest extends Model
{
    use HasFactory;

    protected $table = 'tag_contest';

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
