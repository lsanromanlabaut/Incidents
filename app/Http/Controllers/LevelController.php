<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\Project;

class LevelController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storage(Request $request, $id)
    {

        $this->validate($request, Level::$rules);
		$request['project_id'] = $id;
        $level = Level::create($request->all());

        $level['code'] = 'N'.$level->id;
        $level->save();

        $project = Project::find($id);
        return redirect()->route('project.edit', ['project' => $project])->with('message', 'Level Created Successfully !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
        ];

        $this->validate($request, $rules);

        $level = level::find($request->level_id);


        $level['name'] = $request['name'];
        $level->save();

        $project = Project::find($level['project_id']);

        return redirect()->route('project.edit', ['project' => $project])->with('message', 'Level Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $level = Level::find($id);

        $project = Project::find($level['project_id']);

        $level->delete();

        return redirect()->route('project.edit', ['project' => $project])->with('message', 'Level Deleted Successfully !');
    }

    public function restore($id)
    {
        Level::withTrashed()->find($id)->restore();
        $level = level::find($id);
        $project = Project::find($level['project_id']);
        return redirect()->route('project.edit', ['project' => $project])->with('message', 'level Restored Successfully !');
    }

    public function byProject($id){
        return Level::where('project_id', $id)->get();
    }
}
