@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Booking</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">ss
            <h6 class="m-0 font-weight-bold text-primary">Update Booking
                <a href="{{ url("/booking/create") }}" class="float-right btn btn-success btn-md mr-2">Add Booking</a> 
                <a href="{{ url("/booking") }}" class="float-right btn btn-success btn-md mr-2 ml-6">View All</a>
            </h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }} 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            @if (Session::has("success"))
                <p class="text-success">{{ session("success") }}</p>
            @endif
            <div class="col-sm-12 col-lg-8">
                

                <form action="{{ url("/booking") }}" method="POST" >
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label for="customer" class="form-label">Customer <span class="text-danger">*</span></label>
                        <select autocomplete="off" class="form-control" id="customer" name="customer">
                            <option>--- Select Customer ---</option>
                            @foreach($customers as $customer)
                                <option {{ $customer->id == $data->customer_id ? 'selected':'' }} value="{{ $customer->id }}">{{ $customer->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="checkin" class="form-label">CheckIn Date <span class="text-danger">*</span></label>
                        <input type="date" autocomplete="off" class="form-control checkin-date" name="checkin" id="checkin" value="{{ $data->checkin_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Available Rooms <span class="text-danger">*</span></label>
                        <select class="form-control room-list" id="room" name="room">
                            <option value="{{ $data->room_id }}" selected>{{ $data->room->title }}</option>
                            @foreach($arooms as $room)
                                <option value="{{ $room->id }}">{{ $room->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="checkout" class="form-label">CheckOut Date</label>
                        <input type="date" autocomplete="off" class="form-control" name="checkout" id="checkout" value="{{ $data->checkout_date }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="total_adult" class="form-label">Total Adult</label>
                        <input type="text" autocomplete="off" class="form-control" id="total_adult" value="{{ $data->total_adult }}" name="total_adult">
                    </div>
                    <div class="mb-3">
                        <label for="total_children" class="form-label">Total Children</label>
                        <input type="text" autocomplete="off" class="form-control" id="total_children" value="{{ $data->total_children }}" name="total_children">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Book Room</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

    @section("scripts")
        <script type="text/javascript">
            $(document).ready(function(){
                $(".checkin-date").on("blur", function(){
                    var _checkindate = $(this).val();

                    $.ajax({
                        url : "booking/" + _checkindate + "/available-rooms",
                        date: [],
                        type: "GET",
                        dataType: "json",
                        beforeSend: function(){
                            $('.room-list').html('<option>-- Loading --</option>');
                        },
                        success: function(res){
                            console.log(res);
                            var _html='';
                            $.each(res.data, function(index, row){
                                _html += '<option value="'+row.id+'">'+row.title+'</option>';

                            });
                            $(".room-list").html(_html);
                        }
                    });
                })
            });
        </script>
    @endsection
@endsection