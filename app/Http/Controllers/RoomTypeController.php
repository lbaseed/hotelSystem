<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
use App\Models\RoomType;
use App\Models\Roomtypeimage;

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
        // validate data
        $request->validate([
            'title'=>'required',
            'price'=>'required',
            'detail'=>'required',
        ]);
        //store posted data to database
        $data = new RoomType;
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->price = $request->price;
        $data->save();

        foreach($request->file('imgs') as $img){
            $imgpath = $img->store('public/rooms/images');
            $imgpath = substr($imgpath, 7);

            $imageData = new Roomtypeimage;
            $imageData->room_type_id = $data->id;
            $imageData->img_src = $imgpath;
            $imageData->img_alt = $request->title;
            $imageData->save();
        }
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

        //Add multiple images to room type
        if($request->hasFile('imgs')){
            foreach($request->file('imgs') as $img){
                $imgpath = $img->store('public/rooms/images');
                $imgpath = substr($imgpath, 7);
    
                $imageData = new Roomtypeimage;
                $imageData->room_type_id = $data->id;
                $imageData->img_src = $imgpath;
                $imageData->img_alt = $request->title;
                $imageData->save();
            }
        }
        

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

    public function destroy_image($id)
    {
        // delete data from database
        $data = Roomtypeimage::where('id', $id)->first();
        $img = public_path('storage/'.$data->img_src);
        if(file_exists($img)){
            unlink($img);
        }

        $delete = Roomtypeimage::where('id', $id)->delete();
        if ($delete){
            return response()->json(["bool"=>true]);
        }else{
        return response()->json(["bool"=>false]);
        }
    }
}
