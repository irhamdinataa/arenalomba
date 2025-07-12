<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantRequest extends Model
{
    use HasFactory;

    protected $table = 'participant_request';

    public $timestamps = false;

    protected $fillable = [
    	'contest_id', 
        'name'
    ];
}
