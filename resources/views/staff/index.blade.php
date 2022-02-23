{{-- types of rooms in the hotel are added here --}}


@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Staff</h1>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Staff
            <a href="{{ url("/staff/create") }}" class="float-right btn btn-success btn-lg">Add Staff</a>
        </h6>
        </div>
        <div class="card-body">
            @if (Session::has("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session("success") }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Department</th>
                            <th>Phone</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Department</th>
                            <th>Phone</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($data)
                        
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->department->title }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    <img src="{{ asset('storage/'.$item->photo) }}" width="50" height="50" class="rounded-circle" />
                                </td>
                                <td>
                                    <a href="{{ url('staff/'.$item->id) }}" class="btn btn-info btn-sm mr-2 mb-2"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('staff/'.$item->id.'/edit') }}" class="btn btn-primary btn-sm mr-2 mb-2"><i class="fa fa-edit"></i></a>
                                    <a href="{{ url('staff/payment/'.$item->id.'/create') }}" class="btn btn-success btn-sm mr-2 mb-2"><i class="fa fa-credit-card"></i></a>
                                    <a href="{{ url('staff/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this items?')" class="btn btn-danger btn-sm mb-2"><i class="fa fa-trash"></i></a>
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