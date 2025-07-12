<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryVideo extends Model
{
    use HasFactory;

    protected $table = 'category_video';

    protected $fillable = [
    	'name', 'slug', 'parent_id'
    ];

    protected $hidden = [

    ];

    public function subcategory()
    {
        return $this->hasMany(CategoryVideo::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(CategoryVideo::class, 'parent_id');
    }
}
