@extends("layouts.front_auth")

@section("content")

    {{-- slider section start --}}
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/banna/banna_1.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/banna/banna_2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/banna/banna_3.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/banna/banna_4.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/banna/banna_5.jpg') }}" class="d-block w-100" alt="...">
            </div>
            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
    {{-- slider section send --}}

    {{-- Booking Section start --}}

    {{-- <div class="container my-4" id="services">
        <h1 class="text-center border-bottom">Booking</h1>
        <div class="row my-4">
            <div class="col-md-4">
                <img src="{{ asset('img/photos/booking_800x800.jpg') }}" class="img-thumbnail" alt="" />
            </div>
            <div class="col-md-6">
                <h3>Service Heading</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>
                    <a href="#" class="btn btn-sm btn-primary">Read More</a>
                </p>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-4">
                <img src="{{ asset('img/photos/booking_800x800.jpg') }}" class="img-thumbnail" alt="" />
            </div>
            <div class="col-md-6">
                <h3>Service Heading</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>
                    <a href="#" class="btn btn-sm btn-primary">Read More</a>
                </p>
            </div>
        </div>
    </div> --}}

    {{-- Booking section end --}}
    
    {{-- service Section start --}}

    <div class="container my-4" id="services">
        <h1 class="text-center border-bottom">Services</h1>
        <div class="row my-4">
            <div class="col-md-4">
                <img src="{{ asset('img/photos/booking_800x800.jpg') }}" class="img-thumbnail" alt="" />
            </div>
            <div class="col-md-6">
                <h3>Hotel Room Booking</h3>
                <p>
                    You can reserve a hotel accomodation with us online here and pay for the reservation
                    via card or bank transfer. It is very easy and convinient.
                </p>
                <p>
                    <a href="#" class="btn btn-primary">Reserve Now</a>
                </p>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-4">
                <img src="{{ asset('img/photos/booking_800x800.jpg') }}" class="img-thumbnail" alt="" />
            </div>
            <div class="col-md-6">
                <h3>Airport Pickup</h3>
                <p>We provide Airport/Park pickup services in some selected states.
                    You can book a pickup at any of the Airports/Parks where our services are available
                     and our drivers will be available to pick you up from the airport to either you destination in town
                     or you hotel accomodation. Airport/Park pickup is free if you book hotel accomodation with us.
                </p>
                <p>
                    <a href="#" class="btn btn-primary">Book Now</a>
                </p>
            </div>
        </div>
    </div>

    {{-- service section end --}}

    {{-- gallery section start --}}
    <div class="container my-4" id="gallery">
        <h1 class="text-center border-bottom">Gallery</h1>
        <div class="row my-4">
            @foreach($roomtypes as $key => $rtype)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ $rtype->title }}</div>
                    <div class="card-body">
                        @foreach ($rtype->roomtypeimages as $img)
                        
                        <a href="{{ asset('storage/'.$img->img_src) }}" data-lightbox="roomtypegallery{{ $rtype->id }}" data-title="{{ $rtype->title }}">
                            <img class="img-fluid {{ $loop->index != 0 ? 'hide': ''}}" src="{{ asset('storage/'.$img->img_src) }}" class="card-img-top" alt="{{ $rtype->title }}" style="height: 300px; width:100%" />
                        </a>
                        @endforeach  
                        <p>
                            <div class="card-title"> {{ $rtype->detail }}</div>
                            <div class="card-title"> NGN {{ number_format($rtype->price, 2) }}</div>
                            <div class="d-grid"> <a href="{{ Session::has("customerLogin") ? 'cust/booking' : 'cust/register' }}" class="btn btn-success">Book a Room</a></div>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
           
           
        </div>
    </div>

    {{-- gallery section end --}}

    <style type="text/css">
        .hide{
            display: none;
        }
    </style>

@endsection