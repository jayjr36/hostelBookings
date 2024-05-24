@extends('layout')
@section('content')
<div class="container-fluid " style="background-color: rgb(25, 7, 102);">
    
        <nav class="navbar navbar-expand-lg">
            
                <a class="navbar-brand text-white" href="{{ route('home') }}">Hostel Booking</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center text-white" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5" href="{{ route('landing.page') }}" target="iframe">Home</a>
                        </li>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5" href="{{ route('hostels.index') }}" target="iframe">Hostels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-5" href="{{ route('user.bookings') }}" target="iframe">Bookings</a>
                        </li>
                        <li class="nav-item">
                            @auth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                
                                <button type="submit" class="nav-link text-danger">Logout</button>
                            </form>
                        @endauth
                        </li>
                        <li class="nav-item">
                            
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                @if (auth()->check())
                                <span class="text-white">WALLET</span>
                                {{-- <span class="text-white">{{ auth()->user()->balance }}Tshs</span> --}}
                            @endif
                            </button>
             
                            </li>
                    </ul>
                   
              </div>
            
        </nav>
   
</div>
        

    </div>
</div>

<div class="col">
    <iframe src="{{route('landing.page')}}" frameborder="0" width="100%" name="iframe" height="800"></iframe>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Balance</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.balance') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="balance">Enter Amount:</label>
                        <input type="number" class="form-control" id="balance" name="balance">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection