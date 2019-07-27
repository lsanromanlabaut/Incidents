<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $fillable = [
        'project_id', 'user_id', 'level_id'
    ];
    protected $table = 'project_user';

    public function project(){
    	return $this->belongsTo('App\Project');
    }

    public function level(){
    	return $this->belongsTo('App\Level');
    }
}
