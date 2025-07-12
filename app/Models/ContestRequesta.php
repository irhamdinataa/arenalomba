<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContestRequesta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contest_request';

     protected $fillable = [
    	'name', 
        'categories_id', 
        'sub_categories', 
        'post_title', 
        'post_teaser', 
        'post_content', 
        'slug', 
        'level', 
        'start_date', 
        'end_date', 
        'price', 
        'organizer', 
        'status', 
        'location', 
        'payment', 
        'post_status', 
        'post_image',
        'post_image_description',
        'published_at',
        'is_approve',
    ];

    protected $hidden = [

    ];

    public function tag()
    {
        return $this->belongsToMany(TagContest::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryContest::class, 'categories_id','id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id','users_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
