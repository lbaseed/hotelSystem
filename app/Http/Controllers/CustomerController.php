<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Customer::all();
        return view("customer.customers", ["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("customer.create");
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
            'phone' => 'required',
        ]);

        $imgpath = $fields->file('photo')->store('customer/images');

        $data = new Customer;
        $data->fullname = $fields->fullname;
        $data->email = $fields->email;
        $data->phone = $fields->phone;
        $data->address = $fields->address;
        $data->photo = $imgpath;
        $data->password = \bcrypt("password");
        $data->save();

        return redirect("/customer/create")->with("success", "Customer Added Successfully");

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
        $data = Customer::find($id);
        return view("customer.show", ["data"=>$data]);
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
        $data = Customer::find($id);
        return view("customer.edit", ["data"=>$data]);
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
            'phone' => 'required',
        ]);

        $data = Customer::find($id);
        $data->fullname = $fields->fullname;
        $data->email = $fields->email;
        $data->phone = $fields->phone;
        $data->address = $fields->address;
        
        
        $data->save();
        return redirect("/customer/$id")->with("success", "Customer updated Successfully");

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

        Customer::where('id',$id)->delete();
        return redirect("customers")->with("success", "Item Deleted Successfully");
    }
}
