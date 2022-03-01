<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        return view("booking.index", ["bookings" => $bookings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view("booking.create", ["customers" => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $fields)
    {
        $fields->validate([
            'customer' => 'required',
            'room' => 'required',
            'checkin' => 'required',
            'total_adult' => 'required',
        ]);

        // check booking conditions
        // 1. checkout date must be greater checkin date
        // 2. roomtype booked must be available on the said date
       
        $data = new Booking;
        $data->customer_id = $fields->customer;
        $data->room_id = $fields->room;
        $data->checkin_date = $fields->checkin;
        $data->checkout_date = $fields->checkout;
        $data->total_adult = $fields->total_adult;
        $data->total_children = $fields->total_children;
        $data->save();

        if($fields->ref == 'front'){
            return redirect("cust/booking")->with("success", "Room Booked Successfully");
        } else{
        return redirect("/booking/create")->with("success", "Room Booked Successfully");
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
        
        $data = Booking::find($id);
        return view("booking.show", ["data"=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::all();
        $data = Booking::find($id);
        $arooms = DB::SELECT("SELECT * FROM rooms WHERE id NOT IN 
        (SELECT room_id FROM bookings WHERE '$data->checkin_date' BETWEEN checkin_date AND checkout_date)");
        return view("booking.edit", ["data"=>$data, "customers" => $customers, "arooms"=>$arooms]);
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
        $fields->validate([
            'customer' => 'required',
            'room' => 'required',
            'checkin' => 'required',
        ]);

       
        $data = Booking::find($id);

        $data->customer_id = $fields->customer;
        $data->room_id = $fields->room;
        $data->checkin_date = $fields->checkin;
        $data->checkout_date = $fields->checkout;
        $data->total_adult = $fields->total_adult;
        $data->total_children = $fields->total_children;
        $data->save();

        return redirect("/booking/show")->with("success", "Room Booked Successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::where('id',$id)->delete();
        return redirect("booking")->with("deleted", "Booking Deleted");
    }


    public function available_rooms(Request $request, $checkin_date){

        // check availability of room from checkin date
        
        $arooms = DB::SELECT("SELECT * FROM rooms WHERE id NOT IN 
        (SELECT room_id FROM bookings WHERE '$checkin_date' BETWEEN checkin_date AND checkout_date)");
        return response()->json(['data'=>$arooms]);

        // TODO also check overlaping booking on same room
    }

    // calculate days before next reservation from checkin date

    public function front_booking(){
        $customer = session()->get('customerData');
        return view("booking.form", ['customer'=>$customer]);
    }

    // customers list of bookings
    public function front_bookings(){
        $customer = session()->get('customerData');
        $bookings = Booking::where('customer_id', $customer->id)->get();
        return view("booking.list", ['customer'=>$customer, 'bookings'=>$bookings]);
    }
}
