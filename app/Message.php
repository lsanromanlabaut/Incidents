<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message', 'user_id', 'incident_id'
    ];

    public function incident(){
        return $this->belongsTo('App\incident');
    }

    public function user(){
        return $this->belongsTo('App\user');
    }

}
