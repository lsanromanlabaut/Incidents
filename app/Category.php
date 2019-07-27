<?php

namespace App;
use App\project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'project_id'
    ];

    public static $rules = [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:6', 'max:255'],
    ];

}
