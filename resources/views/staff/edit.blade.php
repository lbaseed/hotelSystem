@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Staff</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update {{ $data->fullname }}
                <a href="{{ url("/staff/create") }}" class="float-right btn btn-success btn-md mr-5">Add Staff</a> 
                <a href="{{ url("/staff") }}" class="float-right btn btn-success btn-md mr-5">View All</a>
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
                <form action="{{ url("staff/".$data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label for="Department" class="form-label">Department <span class="danger">*</span></label>
                        <select class="form-control" name="department">
                            <option value="">-- Select Department --</option>
                            @if ($data)
                                @foreach ($departments as $department)
                                    <option {{ $data->department_id == $department->id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->title }}</option>
                                @endforeach
                            @endif
                        </select>

                    </div>
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
                    <div class="row">
                        <div class="mb-3">
                            <div class="col-sm-12 col-lg-6 align-items-center">
                            <label for="photo" class="form-label">Picture</label>
                            <input type="file" autocomplete="off" class="form-control" id="photo" name="photo">
                            <input type="hidden" name="prev_photo" value="{{ $data->photo }}" />
                            </div>

                            <div class="float-right">
                            <img src="{{ asset('storage/'.$data->photo) }}" width="100" height="100" class="rounded-circle" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="salary_type" class="form-label">Salary Type <span class="danger">*</span></label>
                       

                        <div class="form-check">
                            <input type="radio" {{ $data->salary_type =='Daily'? 'checked':'' }} name="salary_type" class="form-check-input" value="Daily" /> Daily
                        </div>
                        <div class="form-check">
                            <input type="radio" name="salary_type" {{ $data->salary_type =='Monthly'? 'checked':'' }} class="form-check-input" value="Monthly" /> Monthly
                        </div>  
                    </div>
                    <div class="mb-3">
                        <label for="salary_amt" class="form-label">Salary Amount <span class="danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control" id="salary_amt" name="salary_amt" value="{{ $data->salary_amt }}">
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Staff bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="3">{{ $data->bio }}</textarea>
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