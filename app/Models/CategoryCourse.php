<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCourse extends Model
{
    use HasFactory;

    protected $table = 'category_course';

    protected $fillable = [
    	'name', 'slug', 'parent_id'
    ];

    protected $hidden = [

    ];

    public function subcategory()
    {
        return $this->hasMany(CategoryCourse::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(CategoryCourse::class, 'parent_id');
    }
}
