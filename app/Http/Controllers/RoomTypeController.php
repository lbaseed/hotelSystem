<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // display all rooms
        $data = RoomType::all();
        return view("roomtype.roomtypes", ["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // display crate form
        return view("roomtype.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store posted data to database
        $data = new RoomType;
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->price = $request->price;
        $data->save();

        return redirect("/roomtype/create")->with("success", "Room Type Added Successfully");
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
        $data = RoomType::find($id);
        return view("roomtype.show",["data"=>$data]);
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
        $data = RoomType::find($id);
        return view("roomtype.edit",["data"=>$data]);
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
        $data = RoomType::find($id);
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->price = $request->price;
        $data->save();

        return redirect("/roomtype/$id")->with("success", "Room Type updated Successfully");

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
        RoomType::where('id', $id)->delete();
        return redirect("/roomtype")->with("success", "Room Type Deleted Successfully");
    }
}
