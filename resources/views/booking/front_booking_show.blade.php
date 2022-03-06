{{-- Customer Dashbaord --}}
@extends('layouts.front')

@section('content')

<!-- container-fluid -->
<div class="container my-5">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Booking</h1>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booking ID: [ {{ $data->id }} ]
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
                                <th>Customer Name</th>
                                <td>{{ $data->customer->fullname }}</td>
                                
                            </tr>
                            <tr>
                                <th>Customer Contact</th>
                                <td>{{ $data->customer->phone }} / {{ $data->customer->email }}</td>
                                
                            </tr>
                            <tr>
                                <th>Booked Room</th>
                                <td>{{ $data->room->title }} / {{ $roomtype->roomtype->title }} [NGN {{ number_format($roomtype->roomtype->price, 2) }}]</td>
                               
                            </tr>
                            <tr>
                                <th>Checking Date</th>
                                <td>{{ $data->checkin_date }}</td>
                                
                            </tr>
                            <tr>
                                <th>Checout Date</th>
                                <td>{{ $data->checkout_date }}</td>
                                
                            </tr>
                            <tr>
                                <th>Total Adult</th>
                                <td>{{ $data->total_adult }}</td>
                                
                            </tr>
                            <tr>
                                <th>Total Children</th>
                                <td>{{ $data->total_children }}</td>
                                
                            </tr>
                            
                        @endif
                        
                    </tbody>
                </table>
                <a href="{{ url('cust/booking/'.$data->id.'/edit') }}" class="btn btn-primary btn-lg mb-2 mr-2"><i class="fa fa-edit"></i></a>
            </div>
        </div>
    </div>
    <!-- /.DataTales Example -->

</div>

<!-- /.container-fluid -->

        @section("scripts")
            
        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

        @endsection


@endsection