@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add Payment</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Staff Payment [ {{ $data->fullname }}]
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
                <form action="{{ url('staff/payment/'.$staff_id) }}" method="POST" >
                    @csrf
                   
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control" id="amount" name="amount" placeholder="full name">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" autocomplete="off" class="form-control" name="date" id="date">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add Payment</button>
                </form>
            </div>
        </div>
    </div>

    {{-- payments list card --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Payments for [ {{ $data->fullname }}]
        </h6>
        </div>
        <div class="card-body">
            @if (Session::has("deleted"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session("deleted") }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($payments as $payment)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <th>{{ $payment->amount }}</th>
                            <th>{{ $payment->payment_date }}</th>
                            <th>
                                <a href="{{ url('staff/payment/'.$payment->id.'/'.$data->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
                        </tr>
                        @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- end of container fluid --}}
</div>
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