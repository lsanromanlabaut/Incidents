<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectUser;
use App\User;
use App\Level;
use App\Project;

class ProjectUserController extends Controller
{
    public function store(Request $request){
		$user = User::findOrFail($request['user_id']);

		$level = Level::findOrFail($request['select-level']);

		$project = Project::findOrFail($request['select-project']);

		if ($level->project_id == $request['select-project']){

			$project_id = $project->id;
			$user_id = $user->id;

			$project_user = ProjectUser::where('project_id', $project_id)->where('user_id', $user_id)->first();
			if ($project_user){
				return back()->with('message', 'This User belongs to this Project !');
			}

			$project_user = new ProjectUser();

			$project_user->project_id = $project->id;
			$project_user->user_id = $user->id;
			$project_user->level_id = $level->id;
			$project_user->save();

    		return back()->with('message', 'Project and Level Saved  Successfully !');
		}else{
			return back()->with('message', 'That level do not belongs to that project');
		}
    }

    public function delete($id){
		ProjectUser::find($id)->delete();
		return back()->with('message', 'Relation Deleted, This User now do not belongs to this Project !');
    }
}
