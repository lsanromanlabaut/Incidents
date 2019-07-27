<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'startdate',
    ];

    public static $rules = [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:6', 'max:255'],
            'startdate' => ['required', 'date'],
    ];

    //Relationships
    public function users(){
    	return $this->belongsToMany('App\User');
    }

    public function categories(){
        return $this->hasMany('App\Category');
    }

    public function levels(){
        return $this->hasMany('App\Level');
    }

    public function incidents(){
        return $this->hasMany('App\Incident');
    }

    // Accessors
    public function getFirstLevelIdAttribute(){
        return $this->levels->first()->id;
    }
}
