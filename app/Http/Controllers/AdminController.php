<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Booking;
use Cookie;

class AdminController extends Controller
{
    // 

    function index(){
        $bookings = Booking::selectRaw('count(id) as total_bookings, checkin_date')->groupBy('checkin_date')->get();
        $labels = [];
        $data = [];
        foreach ($bookings as $booking) {
            # code...
            $labels[] = $booking['checkin_date'];
            $data[] = $booking['total_bookings'];
        }
        return view('landing', ['labels'=>$labels, 'data'=>$data]);
    }

    function login(){
        
        return view('login');
        
    }


    // check login
    function check_login(Request $request){

        $request->validate([
            "username" => 'required',
            "password" => 'required'
        ]);

        $admin = Admin::where(["username" => $request->username, "password" => sha1($request->password)])->count();
        if($admin > 0){

            $adminData = Admin::where(["username" => $request->username, "password" => sha1($request->password)])->get();

            session(["adminData"=>$adminData]);
            
            if($request->has("rememberme")){
                Cookie::queue("adminuser", $request->username, 1440);
                Cookie::queue("adminpwd", $request->password, 1440);
            }
            return redirect("admin");
        }else{
            return redirect("/login")->with("message", "Invalid Username or Password");
        }

    }

    // logout
    function logout(){
        session()->forget(["adminData"]);
        return redirect("login");
    }
}
