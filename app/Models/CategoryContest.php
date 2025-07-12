<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryContest extends Model
{
    use HasFactory;

    protected $table = 'category_contest';

    protected $fillable = [
    	'name', 'slug', 'parent_id'
    ];

    protected $hidden = [

    ];

    public function subcategory()
    {
        return $this->hasMany(CategoryContest::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(CategoryContest::class, 'parent_id');
    }
}
