<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\project;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
	use SoftDeletes;
	protected $fillable = [
        'name', 'code', 'project_id'
    ];

    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
    ];
}
