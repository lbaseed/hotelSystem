@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Department</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update {{ $data->title }}
                <a href="{{ url("/department/create") }}" class="float-right btn btn-success btn-md mr-5">Add Department</a> 
                <a href="{{ url("/department") }}" class="float-right btn btn-success btn-md mr-5">View All</a>
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
            <div class="col-sm-12 col-lg-8">
                <form action="{{ url("department/".$data->id) }}" method="POST" >
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" autocomplete="off" class="form-control" value="{{ $data->title }}" id="title" name="title" placeholder="Department Title">
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <textarea class="form-control" name="detail" id="detail">{{ $data->detail }}</textarea>

                    </div>
                    

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection