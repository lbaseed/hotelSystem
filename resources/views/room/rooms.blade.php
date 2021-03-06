{{-- types of rooms in the hotel are added here --}}


@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Rooms</h1>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Rooms
            <a href="{{ url("/rooms/create") }}" class="float-right btn btn-success btn-lg">Add Room</a>
        </h6>
        </div>
        <div class="card-body">
            @if (Session::has("success"))
                <p class="text-danger">{{ session("success") }}</p>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Room Type</th>
                            <th>Room Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Room Type</th>
                            <th>Room Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($data)
                        
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->roomtype->title }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <a href="{{ url('rooms/'.$item->id) }}" class="btn btn-info btn-sm mb-2 mr-2"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('rooms/'.$item->id.'/edit') }}" class="btn btn-primary btn-sm mb-2 mr-2"><i class="fa fa-edit"></i></a>
                                    <a href="{{ url('rooms/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this items?')" class="btn btn-danger btn-sm mb-2 mr-2"><i class="fa fa-trash"></i></a>
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

{{-- <!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">??</span>
            </button>
        </div>
        <div class="modal-body">Are sure you want to delete this item?.</div>
        <div class="modal-footer">
            <form action="{{ url('room/'.$item->id) }}" method="post">
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