<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class incident extends Model
{
    //
    protected $fillable = ['title', 'description', 'severity', 'category_id', 'level_id', 'client_id', 'support_id', 'project_id'];

    public static $rules = [
            'title' =>  'required|min:5',
            'description' => 'required|min:10',
            'category_id' => 'nullable |exists:categories,id',
            'severity' => 'required|in:l,n,h',
        ];

    //relationships
    public function category(){
    	return $this->belongsTo('App\category');
    }

    public function project(){
    	return $this->belongsTo('App\project');
    }

    public function support(){
    	return $this->belongsTo('App\user', 'support_id');
    }

    public function client(){
    	return $this->belongsTo('App\user', 'client_id');
    }

    public function level(){
        return $this->belongsTo('App\level');
    }

    public function messages(){
        return $this->hasMany('App\message');
    }



    //Accessors
    public function getSeverityFullAttribute(){
    	switch ($this->severity) {
    		case 'l':
    			return "Low";
    			break;
    		case 'n':
    			return "Normal";
    			break;
    		case 'h':
    			return "High";
    			break;

    		default:
    			return "Very High";
    			break;
    	}
    }

    public function getTitleFullAttribute(){
    	return mb_strimwidth($this->title, 0, 15, '...');
    }

    public function getCategoryNameAttribute(){
    	if ($this->category){
    		return $this->category->name;
    	}

    	return 'General';
    }

    public function getSupportNameAttribute(){
    	if ($this->support){
    		return $this->support->name;
    	}

    	return 'Not Assigned';
    }

    public function getStatusAttribute(){
    	if ($this->active == 0){
    		return 'Determined';
    	}
    	if ($this->support_id){
    		return 'Assigned';
    	}

    	return 'Pending';
    }
}
