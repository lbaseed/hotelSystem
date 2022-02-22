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
            <h6 class="m-0 font-weight-bold text-primary">Profile: [ {{ $data->fullname }} ]
            <a href="{{ url("/staff/create") }}" class="float-right btn btn-success btn-md mr-5">Add Staff</a> 
            <a href="{{ url("/staff") }}" class="float-right btn btn-success btn-md mr-5">View All</a>
        </h6>
        </div>
        <div class="card-body">
            @if (Session::has("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session("success") }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-sm-12 col-lg-8">
                <table class="table table-borderless">
                   
                    <tbody>
                        @if ($data)
                            <tr>
                                <th>Department</th>
                                <td>{{ $data->department->title }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td>{{ $data->fullname }}</td>
                                <td rowspan="8">
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
                                <th>Bio</th>
                                <td>{{ $data->bio }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Salary Type</th>
                                <td>{{ $data->salary_type }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Salary Amount</th>
                                <td>{{ $data->salary_amt }}</td>
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
                <a href="{{ url('staff/'.$data->id.'/edit') }}" class="btn btn-primary btn-lg"><i class="fa fa-edit"></i></a>
                <a href="{{ url('staff/'.$data->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger btn-lg"><i class="fa fa-trash"></i></a>
            </div>
        </div>
    </div>
    <!-- /.DataTales Example -->

</div>

{{-- <!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Are sure you want to delete this item?.</div>
        <div class="modal-footer">
            <form action="{{ url('room/'.$data->id) }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" >Delete</button>
            </form>
            
        </div>
    </div>
</div>
</div> --}}
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