@extends("layouts.front")

@section("content")

    <div class="container">

        <h1 class="h3 mb-4 text-gray-800">Booking</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Room Booking
                <a href="{{ url('cust/bookings') }}" class="float-right btn btn-sm btn-success ms-auto">View All</a>
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
                <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session("success") }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-sm-12 col-lg-8">
                <form action="{{ url("/booking") }}" method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label for="customer" class="form-label">Customer <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control" id="customer" disabled value="{{ $customer->fullname }}">
                        <input type="hidden" autocomplete="off" class="form-control" id="customer" name="customer" value="{{ $customer->id }}">
                           
                    </div>
                    <div class="mb-3">
                        <label for="checkin" class="form-label">CheckIn Date <span class="text-danger">*</span></label>
                        <input type="date" autocomplete="off" class="form-control checkin-date" name="checkin" id="checkin" placeholder="yyyy-mm-dd">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Available Rooms Types <span class="text-danger">*</span></label>
                        <select class="form-control room-list" id="room" name="room">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="checkout" class="form-label">CheckOut Date</label>
                        <input type="date" autocomplete="off" class="form-control" name="checkout" id="checkout" placeholder="yyyy-mm-dd">
                    </div>
                    
                    <div class="mb-3">
                        <label for="total_adult" class="form-label">Total Adult</label>
                        <input type="text" autocomplete="off" class="form-control" id="total_adult" name="total_adult">
                    </div>
                    <div class="mb-3">
                        <label for="total_children" class="form-label">Total Children</label>
                        <input type="text" autocomplete="off" class="form-control" id="total_children" name="total_children">
                    </div>
                    <input type="hidden" name="ref" value="front" />
                    <button type="submit" class="btn btn-primary">Book Room</button>
                </form>
            </div>
        </div>
    </div>
    </div>

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