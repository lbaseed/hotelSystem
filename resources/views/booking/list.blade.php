{{-- types of rooms in the hotel are added here --}}


@extends('layouts.front')

@section('content')

<!-- container-fluid -->
<div class="container my-5">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Bookings</h1>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Bookings
            <a href="{{ url("cust/booking") }}" class="float-right btn btn-success btn-sm">Add Booking</a>
        </h6>
        </div>
        <div class="card-body">
            @if (Session::has("deleted"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session("deleted") }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Room</th>
                            <th>Adult / Children</th>
                            <th>Checkin Date</th>
                            <th>Checkout Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Room</th>
                            <th>Adult / Children</th>
                            <th>Checkin Date</th>
                            <th>Checkout Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($bookings)
                        
                            @foreach ($bookings as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->customer->fullname }}</td>
                                <td>{{ $item->room->title }}</td>

                                <td>{{ $item->total_adult }} / {{ $item->total_children }}</td>

                                <td>{{ $item->checkin_date }}</td>
                                <td>{{ $item->checkout_date }}</td>

                                <td>
                                    <a href="{{ url('cust/booking/'.$item->id) }}" class="btn btn-success btn-sm mb-2 mr-2"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('cust/booking/'.$item->id.'/edit') }}" class="btn btn-primary btn-sm mb-2 mr-2"><i class="fa fa-edit"></i></a>
                                    <a href="{{ url('cust/booking/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this booking?')" class="btn btn-danger btn-sm mb-2 mr-2"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        
                    </tbody>
                </table>
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