{{-- types of rooms in the hotel are added here --}}


@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Room Type</h1>
 
    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $data->title }}
            <a href="{{ url("/roomtype/create") }}" class="float-right btn btn-success btn-md mr-2">Add Room Type</a> 
            <a href="{{ url("/roomtype") }}" class="float-right btn btn-success btn-md mr-2 ml-6">View All</a>
        </h6>
        </div>
        <div class="card-body">
            @if (Session::has("success"))
                <p class="text-success">{{ session("success") }}</p>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                   
                    <tbody>
                        @if ($data)
                           
                            <tr>
                               
                                <th style="min-width: 200px">Room Type</th>
                                <th>{{ $data->title }}</th>
                            </tr>
                            <tr>
                                <th>Room Type Detail</th>
                                <td>{{ $data->detail }}</td>
                            </tr>
                            <tr>
                                <th>Price NGN</th>
                                <td>{{ number_format($data->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Gallery Images</th>
                                <td>
                                    <table>
                                        <tr>
                                            @foreach ($data->roomtypeimages as $img)
                                                <td>
                                                    <img src="{{ asset('storage/'.$img->img_src) }}" width="100" height="100" />
                                                </td>
                                            @endforeach
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                        @endif
                        
                    </tbody>
                </table>
                <a href="{{ url('roomtype/'.$data->id.'/edit') }}" class="btn btn-primary btn-lg mb-2 mr-2"><i class="fa fa-edit"></i></a>
                <a href="{{ url('roomtype/'.$data->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this items?')" class="btn btn-danger btn-lg mb-2 mr-2"><i class="fa fa-trash"></i></a>
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
            <form action="{{ url('roomtype/'.$data->id) }}" method="post">
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