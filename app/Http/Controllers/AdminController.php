<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Booking;
use Cookie;

class AdminController extends Controller
{
    // 

    function index(){
        
        // for line chart

        $bookings = Booking::selectRaw('count(id) as total_bookings, checkin_date')->groupBy('checkin_date')->get();
        $labels = [];
        $data = [];
        foreach ($bookings as $booking) {
            # code...
            $labels[] = $booking['checkin_date'];
            $data[] = $booking['total_bookings'];
        }

        // for pie chart
        $rtbookings = DB::table('room_types as rt')
                ->join('rooms as r', 'r.room_type_id', '=', 'rt.id' )
                ->join('bookings as b', 'b.room_id', '=', 'r.id' )
                ->select('rt.*','rt.title as room_type','r.*','b.*', DB::raw('count(*) as total_bookings'))
                ->groupBy('r.room_type_id')
                ->get();

                // echo '<preg>';
                // print_r($rtbookings);

        $plabels = [];
        $pdata = [];
        $color = ['#4e73df','#1cc88a','#36b9cc'];
        foreach ($rtbookings as $booking) {
            # code...
            $plabels[] = $booking->room_type;
            $pdata[] = $booking->total_bookings;
        }
        // end pie chart
        return view('landing', ['labels'=>$labels, 'data'=>$data, 'plabels'=>$plabels, 'pdata'=>$pdata, 'color'=>$color]);
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
