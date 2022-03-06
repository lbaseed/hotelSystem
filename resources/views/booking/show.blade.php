{{-- types of rooms in the hotel are added here --}}


@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Booking</h1>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            <a href="{{ url("/booking/create") }}" class="float-right btn btn-success btn-md mr-2">Add Booking</a> 
            <a href="{{ url("/booking") }}" class="float-right btn btn-success btn-md mr-2 ml-6">View All</a>
        </h6>
        </div>
        <div class="card-body">
            @if (Session::has("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session("success") }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive col-sm-12 col-lg-8">
                <table class="table table-borderless">
                   
                    <tbody>
                        @if ($data)
                           
                            <tr>
                                <th>Full Name</th>
                                <td>{{ $data->customer->fullname }}</td>
                                
                            </tr>
                            <tr>
                                <th>Checkin Date</th>
                                <td>{{ $data->checkin_date }}</td>
                                
                            </tr>
                            <tr>
                                <th>Checkout Date</th>
                                <td>{{ $data->checkout_date }}</td>
                               
                            </tr>
                            <tr>
                                <th>Adult / Children</th>
                                <td>{{ $data->total_adult }} / {{ $data->total_children }}</td>
                               
                            </tr>
                            <tr>
                                <th>Booked Room</th>
                                <td>{{ $data->room->title }}</td>
                                
                            </tr>
                            
                            
                        @endif
                        
                    </tbody>
                </table>
                <a href="{{ url('booking/'.$data->id.'/edit') }}" class="btn btn-primary btn-lg mb-2 mr-2"><i class="fa fa-edit"></i></a>
            </div>
        </div>
    </div>
    <!-- /.DataTales Example -->

</div>

<!-- /.container-fluid -->

       


@endsection