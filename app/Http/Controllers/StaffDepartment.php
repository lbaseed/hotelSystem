<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class StaffDepartment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // display all departments
        $data = Department::all();
        return view("department.index", ["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // display crate form
        return view("department.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data
        $request->validate([
            'title' => "required",
        ]);
        //store posted data to database
        $data = new Department;
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->save();

        return redirect("/department/create")->with("success", "Department Added Successfully");
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
        $data = Department::find($id);
        return view("department.show",["data"=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Department::find($id);
        return view("department.edit",["data"=>$data]);
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
        //
        $data = Department::find($id);
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->save();

        return redirect("/department/$id")->with("success", "Department updated Successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete data from database
        Department::where('id', $id)->delete();
        return redirect("/department")->with("success", "Department Deleted Successfully");
    }
}
