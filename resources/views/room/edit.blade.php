@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Room</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update {{ $data->title }}
                <a href="{{ url("/rooms/create") }}" class="float-right btn btn-success btn-md mr-5">Add Room</a> 
                <a href="{{ url("/rooms") }}" class="float-right btn btn-success btn-md mr-5">View All</a>
            </h6>
        </div>
        <div class="card-body">
            @if (Session::has("success"))
                <p class="text-success">{{ session("success") }}</p>
            @endif
            <div class="table-responsive">
                <form action="{{ url("/rooms/".$data->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <table class="table table-bordered">
                    
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <td><input type="text" autocomplete="off" value="{{ $data->title }}" class="form-control" name="title" /></td>
                            </tr>
                            <tr>
                                <th>Select Room Type</th>
                                <td>
                                    <select class="form-control" name="roomtype">
                                        <option value="0">-- Select --</option>
                                        @foreach ($roomtypes as $type)
                                            <option {{ $data->room_type_id == $type->id ? 'selected' : ''}} value="{{ $type->id }}"> {{ $type->title }}</option>
                                        @endforeach
                                    </select>
                                </td>
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