<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Department;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Staff::all();
        return view("staff.index", ["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Department::all();
        return view("staff.create", ["data" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $fields)
    {
        //
        $fields->validate([
            'fullname' => 'required',
            'department' => 'required',
            'salary_type' => 'required',
            'salary_amt' => 'required',
            'phone' => 'required',
        ]);

        $imgpath = $fields->file('photo')->store('public/staff/images');
        $imgpath = substr($imgpath, 7);

        $data = new Staff;
        $data->fullname = $fields->fullname;
        $data->department_id = $fields->department;
        $data->email = $fields->email;
        $data->phone = $fields->phone;
        $data->bio = $fields->bio;
        $data->salary_type = $fields->salary_type;
        $data->salary_amt = $fields->salary_amt;
        $data->address = $fields->address;
        $data->photo = $imgpath;
        // $data->password = sha1("password");
        $data->save();

        return redirect("/staff/create")->with("success", "Staff Added Successfully");

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
        $data = Staff::find($id);
        return view("staff.show", ["data"=>$data]);
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
        $data = Staff::find($id);
        $departments = Department::all();
        return view("staff.edit", ["data"=>$data, "departments"=>$departments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $fields, $id)
    {
        //
        $fields->validate([
            'fullname' => 'required',
            'department' => 'required',
            'salary_type' => 'required',
            'salary_amt' => 'required',
            'phone' => 'required',
        ]);

        $data = Staff::find($id);
        $data->fullname = $fields->fullname;
        $data->department_id = $fields->department;
        $data->email = $fields->email;
        $data->phone = $fields->phone;
        $data->bio = $fields->bio;
        $data->salary_type = $fields->salary_type;
        $data->salary_amt = $fields->salary_amt;
        $data->address = $fields->address;

        if($fields->hasFile('photo')){
            $imgpath = $fields->file('photo')->store('public/staff/images');
            $imgpath = substr($imgpath, 7);
            // delete prev pic
            $pic = public_path('storage/'.$data->photo);
            if(file_exists($pic)){
                unlink($pic);
            }
            $data->photo = $imgpath;
            }
        
        $data->save();
        return redirect("/staff/$id")->with("success", "Staff updated Successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete item from database

        // delete pic first
        $data = Staff::find($id);
        $pic = public_path('storage/'.$data->photo);
            if(file_exists($pic)){
                unlink($pic);
            }

        // now delete customer
        Staff::where('id',$id)->delete();
        return redirect("staff")->with("success", "Item Deleted Successfully");
    }

    function add_payment($id){

        return view("staffpayment.add");
    }
}
