{{-- types of rooms in the hotel are added here --}}


@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Customer</h1>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profile: [ {{ $data->fullname }} ]
            <a href="{{ url("/customer/create") }}" class="float-right btn btn-success btn-md mr-2">Add Customer</a> 
            <a href="{{ url("/customer") }}" class="float-right btn btn-success btn-md mr-2 ml-6">View All</a>
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
                                <td>{{ $data->fullname }}</td>
                                <td rowspan="4">
                                    <img src="{{ asset('storage/'.$data->photo) }}" width="200" height="200" class="rounded-circle" />
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $data->email }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $data->phone }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $data->address }}</td>
                                <td></td>
                            </tr>
                            
                            
                        @endif
                        
                    </tbody>
                </table>
                <a href="{{ url('customer/'.$data->id.'/edit') }}" class="btn btn-primary btn-lg mb-2 mr-2"><i class="fa fa-edit"></i></a>
                <a href="{{ url('customer/'.$data->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger btn-lg mb-2 mr-2"><i class="fa fa-trash"></i></a>
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