@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Room Type</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Room Type
                <a href="{{ url("/roomtype") }}" class="float-right btn btn-success btn-lg">View All</a>
        </h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }} 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            @if (Session::has("success"))
                <p class="text-success">{{ session("success") }}</p>
            @endif
            <div class="table-responsive">
                <form action="{{ url("/roomtype") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                    
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <td><input type="text" autocomplete="off"  class="form-control" name="title" /></td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td><input type="text" autocomplete="off" class="form-control" name="price" /></td>
                            </tr>
                            <tr>
                                <th>Details</th>
                                <td><textarea class="form-control" name="detail"></textarea></td>
                            </tr>
                            <tr>
                                <th>Gallery</th>
                                <td><input type="file" multiple name="imgs[]" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" class="btn btn-primary" name="submit" value="Add" /></td>
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