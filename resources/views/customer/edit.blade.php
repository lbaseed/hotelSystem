@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Customer</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Customer
                <a href="{{ url("/customer/create") }}" class="float-right btn btn-success btn-md mr-5">Add Room</a> 
                <a href="{{ url("/customer") }}" class="float-right btn btn-success btn-md mr-5">View All</a>
            </h6>
        </div>
        <div class="card-body">
            @if (Session::has("success"))
                <p class="text-success">{{ session("success") }}</p>
            @endif
            <div class="col-sm-12 col-lg-8">
                <form action="{{ url("/customer/".$data->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name *</label>
                        <input type="text" autocomplete="off" class="form-control" value="{{ $data->fullname }}" id="fullName" name="fullname" placeholder="full name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" autocomplete="off" class="form-control" value="{{ $data->email }}" name="email" id="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number *</label>
                        <input type="text" autocomplete="off" class="form-control" value="{{ $data->phone }}" id="phone" name="phone" placeholder="phone">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3">{{ $data->address }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection