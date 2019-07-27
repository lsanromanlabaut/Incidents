<?php

namespace App\Http\Controllers;

use App\project;
use App\level;
use App\category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::withTrashed()->get();
        return view('project.index')->with(compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Project::$rules);

        Project::create($request->all());
        return redirect()->route('project.index')->with('message', 'Project Created Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {

        $levels = Level::withTrashed()->where('project_id', $project->id)->get();
        //$levels = Level::where('project_id', $project->id)->get();
        $categories = Category::withTrashed()->where('project_id', $project->id)->get();

        return view('project.edit', ['project' => Project::findOrFail($project['id']), 'projects' => Project::all(), 'levels' => $levels, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        $this->validate($request, Project::$rules);

        $project['name'] = $request->get('name');
        $project['description'] = $request->get('description');
        $project['startdate'] = $request->get('startdate');

        $project->save();
        return redirect()->route('project.edit', ['project' => $project])->with('message', 'Project updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = project::find($id);
        $project->delete();
        $projects = project::all();
        return redirect()->route('project.index', ['projects' => $projects])->with('message', 'Project Deleted Successfully !');
    }

    public function restore($id)
    {
        project::withTrashed()->find($id)->restore();

        return redirect()->route('project.index')->with('message', 'Project Restored Successfully !');
    }
}
