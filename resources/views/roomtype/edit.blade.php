@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Room Type</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Room Type
                <a href="{{ url("/roomtype/create") }}" class="float-right btn btn-success btn-md mr-5">Add Room Type</a> 
            <a href="{{ url("/roomtype") }}" class="float-right btn btn-success btn-md mr-5">View All</a>
        </h6>
        </div>
        <div class="card-body">
            @if (Session::has("success"))
                <p class="text-success">{{ session("success") }}</p>
            @endif
            <div class="table-responsive">
                <form action="{{ url("/roomtype/".$data->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <table class="table table-bordered">
                    
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <td><input type="text" autocomplete="off" value="{{ $data->title }}" class="form-control" name="title" /></td>
                            </tr>
                            <tr>
                                <th>Details</th>
                                <td><textarea class="form-control" name="detail">{{ $data->detail }}</textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" class="btn btn-primary" name="submit" value="update" /></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection