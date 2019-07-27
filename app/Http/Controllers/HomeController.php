<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incident;
use App\ProjectUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->is_support){
            //My Incidents
            $my_incidents = Incident::where('project_id', $user->selected_project_id)->where('support_id', $user->id)->get();

            //Unassigned incidents
            $projectUser = ProjectUser::where('project_id', $user->selected_project_id)->where('user_id', $user->id)->first();
            $unassigned_incidents = Incident::where('support_id', null)->where('level_id', $projectUser->level_id)->get();
        }

        //Incidents reported by me
        $incidents_by_me = Incident::where('client_id', $user->id)->where('project_id', $user->selected_project_id)->get();

        return view('home')->with(compact('my_incidents', 'unassigned_incidents', 'incidents_by_me'));
    }

    public function selectproject($id){
        // Se puede validar que el usuario este asociado con el projecto

        $user = auth()->user();
        $user->selected_project_id = $id;
        $user->save();

        return back();
    }
}
