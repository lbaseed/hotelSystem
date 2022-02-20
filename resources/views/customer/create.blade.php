@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Register Customer</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Register Customer
                <a href="{{ url("/customer") }}" class="float-right btn btn-success btn-lg">View All</a>
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
                <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session("success") }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-sm-12 col-lg-8">
                <form action="{{ url("/customer") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name *</label>
                        <input type="text" autocomplete="off" class="form-control" id="fullName" name="fullname" placeholder="full name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" autocomplete="off" class="form-control" name="email" id="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number *</label>
                        <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="phone">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Picture</label>
                        <input type="file" autocomplete="off" class="form-control" id="photo" name="photo">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection