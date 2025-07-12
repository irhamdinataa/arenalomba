<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagVideo extends Model
{
    use HasFactory;

    protected $table = 'tag_video';

    protected $fillable = [
    	'name', 'slug'
    ];

    protected $hidden = [

    ];

    public function post()
    {
        return $this->belongsToMany(Video::class);
    }
}
