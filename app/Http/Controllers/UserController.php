<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\ProjectUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 1)->get();
        return view('user.index')->with(compact('users'));
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ];

        $this->validate($request, $rules);

        $fields['email'] = $request->get('email');
        $fields['name'] = $request->get('name');
        $fields['password'] = bcrypt($request->get('password'));
        $fields['role'] = 1;

        User::create($fields);
        return redirect()->route('user.index')->with('message', 'User Created Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $projects = Project::all();
        $project_users = ProjectUser::where('user_id', $user->id)->get();

        return view('user.edit', ['user' => $user, 'projects' => $projects, 'project_users' => $project_users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $password = $request->get('password');

        if ($password != ""){
            $user->password = bcrypt($password);
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['min:6'],
            ];
        }else{
            $rules = [
                'name' => ['required', 'string', 'max:255'],
            ];
        }

        $this->validate($request, $rules);

        $user['email'] = $request->get('email');
        $user['name'] = $request->get('name');

        $user->save();
        return redirect()->route('user.edit', ['user' => $user])->with('message', 'User updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $users = User::where('role', 1)->get();
        return redirect()->route('user.index', ['users' => $users])->with('message', 'User Deleted Successfully !');
    }
}
