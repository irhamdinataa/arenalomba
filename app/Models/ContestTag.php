<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestTag extends Model
{
    use HasFactory;

    protected $table = 'contest_tag_contest';

    protected $fillable = [
    	'contest_id', 'tag_contest_id'
    ];

    protected $hidden = [

    ];

    public function contest()
    {
        return $this->hasMany(Contest::class, 'id','post_id');
    }

}
