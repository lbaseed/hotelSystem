<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // display all rooms
        $data = Room::all();
        return view("room.rooms", ["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // display crate form
        $roomtypes = RoomType::all();
        return view("room.create", ["roomtypes" => $roomtypes]);
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
        $data = new Room;
        $data->title = $request->title;
        $data->room_type_id = $request->roomtype;
        $data->save();

        return redirect("/rooms/create")->with("success", "Room Added Successfully");
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
        $data = Room::find($id);
        return view("room.show",["data"=>$data]);
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
        $data = Room::find($id);
        $roomtypes = RoomType::all();
        return view("room.edit",["data"=>$data, "roomtypes" => $roomtypes]);
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
        $data = Room::find($id);
        $data->title = $request->title;
        $data->room_type_id = $request->roomtype;
        $data->save();

        return redirect("/rooms/$id")->with("success", "Room updated Successfully");

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
        Room::where('id', $id)->delete();
        return redirect("/rooms")->with("success", "Room Deleted Successfully");
    }
}
