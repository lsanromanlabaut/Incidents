<?php

namespace App\Http\Controllers;

use App\category;
use App\Project;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storage(Request $request, $id)
    {

        $this->validate($request, Category::$rules);
        $request['project_id'] = $id;
        Category::create($request->all());
        $project = Project::find($id);
        return redirect()->route('project.edit', ['project' => $project])->with('message', 'Category Created Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
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

        $Category = Category::find($request->category_id);


        $Category['name'] = $request['name'];
        $Category->save();

        $project = Project::find($Category['project_id']);

        return redirect()->route('project.edit', ['project' => $project])->with('message', 'Category Updated Successfully !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = Category::find($id);

        $project = Project::find($category['project_id']);

        $category->delete();

        return redirect()->route('project.edit', ['project' => $project])->with('message', 'Category Deleted Successfully !');
    }

    public function restore($id)
    {
        Category::withTrashed()->find($id)->restore();
        $category = Category::find($id);
        $project = Project::find($category['project_id']);
        return redirect()->route('project.edit', ['project' => $project])->with('message', 'Category Restored Successfully !');
    }
}
