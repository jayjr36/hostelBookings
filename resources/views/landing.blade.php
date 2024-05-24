@extends('layout')

@section('content')

<div class="container mt-4" style="height: 90vh;">
    <div class="row">
        <div class="col-md-6 card py-3 px-3">
            <h3>Welcome to Dar es Salaam Institute of Technology Hostel Booking</h3>
            <p class="lead">Find the perfect hostel for your stay!</p>
            <p>Discover convenient and comfortable accommodations near the Dar es Salaam Institute of Technology campus. Whether you're a new student or returning, our platform makes it easy for you to find a place to call home.</p>
            <p>Explore a wide range of options, from single rooms to shared apartments, and choose the one that suits your preferences and budget.</p>
            <p>Book your hostel today and make your time at Dar es Salaam Institute of Technology unforgettable!</p>
        </div>
        <div class="col-md-6">
            <img src="{{asset('images/hostel1.jpg')}}" alt="Hostel Booking Image" class="img-fluid mx-5" style="height: 60vh;">
        </div>
    </div>
</div>

@endsection

