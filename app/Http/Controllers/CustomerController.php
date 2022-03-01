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

        if ($fields->hasFile('photo')) {
            $imgpath = $fields->file('photo')->store('public/customer/images');
            $imgpath = substr($imgpath, 7);
        }else{
            $imgpath = "none";
        }
        $data = new Customer;
        $data->fullname = $fields->fullname;
        $data->email = $fields->email;
        $data->phone = $fields->phone;
        $data->address = $fields->address;
        $data->photo = $imgpath;
        $data->password = sha1($fields->password);
        $data->save();

        if($fields->ref == 'front'){
            return redirect("cust/register")->with("success", "Registration successful, Please Login Now.");

        }else{
            return redirect("customer/create")->with("success", "Customer Added Successfully");

        }

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

        if($fields->hasFile('photo')){
            $imgpath = $fields->file('photo')->store('public/customer/images');
            $imgpath = substr($imgpath, 7);
            // delete prev pic
            $pic = public_path('storage/'.$data->photo);
            if(file_exists($pic)){
                unlink($pic);
            }
            $data->photo = $imgpath;
            }else{
                $imgpath = $fields->prev_photo;
            }
        
        $data->save();

        if($fields->ref == 'front') {

            return redirect("cust/dash")->with("success", "Customer updated Successfully");
        
        }else{
        
            return redirect("/customer/$id")->with("success", "Customer updated Successfully");

        }

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
        $data = Customer::find($id);
        $pic = public_path('storage/'.$data->photo);
            if(file_exists($pic)){
                unlink($pic);
            }

        // now delete customer
        Customer::where('id',$id)->delete();
        return redirect("customer")->with("success", "Item Deleted Successfully");
    }

    function register(){
        return view("front_auth.register");
    }

    function login(){
        return view("front_auth.login");
    }

    // check customer login
    function check_login(Request $request){

        $request->validate([
            "phone" => 'required',
            "password" => 'required'
        ]);

        $customer = Customer::where(["phone" => $request->phone, "password" => sha1($request->password)])->count();
        if($customer > 0){

            $customerData = Customer::where(["phone" => $request->phone, "password" => sha1($request->password)])->first();

            session(['customerLogin'=>true,"customerData"=>$customerData]);
            
            if($request->has("rememberme")){
                Cookie::queue("phone", $request->phone, 10080);
                Cookie::queue("custpwd", $request->password, 10080);
            }
            return redirect("cust/dash");
        }else{
            return redirect("cust/login")->with("error", "Invalid Username or Password");
        }
    }

    // customer dashbaord after successful login
    function cust_dash(){
        $customerData = session()->get('customerData');
        $data = Customer::find($customerData->id);
        return view("customer.dash", ['data'=>$data]);
    }

    // customer logout
    function logout(){
        session()->forget(["customerData", "customerLogin"]);
        return redirect("cust/login");
    }

    // edit customer info from front end
    function cust_dash_edit(){

        $customerData = session()->get('customerData');
        $data = Customer::find($customerData->id);
        return view("customer.front_edit", ['data'=>$data]);
    }
}
