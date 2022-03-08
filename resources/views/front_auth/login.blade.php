@extends("layouts.front_auth")

@section("content")

<div class="container my-5 mb-2">
    <h3>Login</h3>
    <div class="row justify-center mt-5">
        <div class="col-sm-12 col-lg-8">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif
        
        @if (Session::has("error"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session("error") }} 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <form action="{{ url("/cust/login") }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                    <input type="text" required autocomplete="off" class="form-control" id="phone" name="phone" placeholder="080xxxxx">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" required autocomplete="off" class="form-control" id="password" name="password" placeholder="password">
                </div>
                
                <button type="submit" class="btn btn-lg btn-primary">Login</button>
            </form>
        </div>
    </div>
    
</div>
    
@endsection