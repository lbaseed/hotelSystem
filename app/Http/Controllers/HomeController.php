<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;


class HomeController extends Controller
{
    //
    function home(){
        $data = RoomType::all();
        return view("home", ['roomtypes'=>$data]);
    }
}
