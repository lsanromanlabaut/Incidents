<?php

namespace App\Http\Controllers;

use App\incident;
use App\Category;
use App\Project;
use App\ProjectUser;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('incidents.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incidents.create', ['categories' => Category::where('project_id', 1)->get()]);
        /*
        $categories = Category::where('project_id', 1)->get();
        return view('incidents.create')->with(compact('$categories'));
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Incident::$rules);

        $fields['title'] = $request->get('title');
        $fields['description'] = $request->get('description');
        $fields['severity'] = $request->get('severity');
        $fields['category_id'] = $request->get('category_id') ?: null;

        $user = auth()->user();

        $fields['client_id'] = $user->id;
        $fields['project_id'] = $user->selected_project_id;

        $fields['level_id'] = Project::find($user->selected_project_id)->first_level_id;

        Incident::create($fields);
        return redirect()->route('incident.create')->with('message', 'Incident Created Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incident = Incident::findOrFail($id);
        $messages = $incident->messages;

        return view('incidents.show')->with(['incident' => $incident, 'messages' => $messages]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incident = Incident::findOrFail($id);
        $categories = $incident->project->categories;
        return view('incidents.edit')->with(['incident' => $incident, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, Incident::$rules);

        $incident = Incident::findOrFail($id);

        $incident->title = $request->get('title');
        $incident->description = $request->get('description');
        $incident->severity = $request->get('severity');
        $incident->category_id = $request->get('category_id') ?: null;

        $incident->save();

        return view('incidents.show', ['incident' => $incident])->with('message', 'Incident Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function destroy(incident $incident)
    {
        //
    }

    /**
     * take the incident for this user.
     *
     * @param  \App\incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function take($id)
    {
        $user = auth()->user();

        //The user is support
        if (! $user->is_support){
            return back;
        }

        //there is a relationship between user and project
        $incident = Incident::findOrFail($id);

        $project_user = ProjectUser::where('project_id', $incident->project_id)->where('user_id', $user->id)->first();
        if (! $project_user)
            return back();

        // level is the same
        if ($project_user->level_id != $incident->level_id)
            return back();

        $incident->support_id = $user->id;
        $incident->save();

        return back();
    }

    /**
     * solver the incident .
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function solve($id)
    {
        $incident = Incident::findOrFail($id);
        if ($incident->client_id != auth()->user()->id){
            return back();
        }

        $incident->active = 0;
        $incident->save();

        return back();
    }

    /**
     * open the incident .
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function open($id)
    {
        $incident = Incident::findOrFail($id);
        if ($incident->client_id != auth()->user()->id){
            return back();
        }

        $incident->active = 1;
        $incident->save();

        return back();
    }

    /**
     * transfer to the next level the incident .
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function nextlevel($id)
    {
        $incident = Incident::findOrFail($id);
        $level_id = $incident->level_id;

        $project = $incident->project;
        $levels = $project->levels;

        $next_level_id = $this->getNextLevelId($level_id, $levels);

        if ($next_level_id){
            $incident->level_id = $next_level_id;
            $incident->support_id = null;
            $incident->save();
            return back();
        }

        return back()->with('message', 'Error, I can not assign the incident to a next level');
    }

    public function getNextLevelId($level_id, $levels){
        if (sizeof($levels) <= 1){
            return null;
        }

        $position = -1;
        for ($i = 0; $i <sizeof($levels)-1; $i++){
            if ($levels[$i]->id == $level_id){
                $position = $i;
                break;
            }
        }

        if ($position == -1){
            return null;
        }

        return $levels[$position+1]->id;
    }


}
