<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contest';

     protected $fillable = [
    	'users_id', 
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

    public function participants()
    {
    	return $this->hasMany(Participant::class, 'contest_id','id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
