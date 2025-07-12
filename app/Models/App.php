<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
    	'name',
    	'logo',
    	'favicon',
    	'title',
    	'description',
    	'link_web',
    	'banner',
    	'link_fb',
    	'link_ig',
    	'link_yt',
    	'link_banner',
    ];

    protected $hidden = [

    ];
}
