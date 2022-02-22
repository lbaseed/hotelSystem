@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Register Staff</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Register Staff
                <a href="{{ url("/staff") }}" class="float-right btn btn-success btn-lg">View All</a>
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
                <form action="{{ url("/staff") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="Department" class="form-label">Department <span class="text-danger">*</span></label>
                        <select class="form-control" name="department">
                            <option value="">-- Select Department --</option>
                            @if ($data)
                                @foreach ($data as $department)
                                    <option value="{{ $department->id }}">{{ $department->title }}</option>
                                @endforeach
                            @endif
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control" id="fullName" name="fullname" placeholder="full name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" autocomplete="off" class="form-control" name="email" id="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="phone">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Picture</label>
                        <input type="file" autocomplete="off" class="form-control" id="photo" name="photo">
                    </div>
                    <div class="mb-3">
                        <label for="salary_type" class="form-label">Salary Type <span class="text-danger">*</span></label>
                        
                        <div class="form-check">
                            <input type="radio" name="salary_type" class="form-check-input" value="Daily" /> Daily
                        </div>
                        <div class="form-check">
                            <input type="radio" name="salary_type" checked class="form-check-input" value="MOnthly" /> Monthly
                        </div>    
                    </div>
                    <div class="mb-3">
                        <label for="salary_amt" class="form-label">Salary Amount <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control" id="salary_amt" name="salary_amt">
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Staff bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add Staff</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection