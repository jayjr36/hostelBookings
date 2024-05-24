@extends('layout')

@section('content')
    <div class="container">
        @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
        <h1 class="text-center">Bookings</h1>
        <div class="row">
            @foreach ($bookings as $booking)
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $booking->hostel_name }}</h5>
                        <p class="card-text">Duration: {{ $booking->duration }}</p>
                        <p class="card-text">Price: {{ $booking->price }}</p>
                        <p class="card-text">Room Number: {{ $booking->room_number }}</p>
                        <p class="card-text">Payment status: {{ $booking->payment_status }}</p>
                        @if ($booking->payment_status == 'paid')
                            <a href="{{ route('download.receipt', ['id' => $booking->id]) }}" class="btn btn-success">
                                Download Receipt
                            </a>
                        @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#paymentModal{{ $booking->id }}">
                                Make Payment
                            </button>
                        @endif
                    </div>
                </div>
            </div>

                <!-- Payment Modal -->
                <div class="modal fade" id="paymentModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel{{ $booking->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentModalLabel{{ $booking->id }}">Make Payment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                
                                <div class="text-center mb-4">
                                    <img src="https://th.bing.com/th/id/R.fbfa47fb095341872b9d5ed14a1c144f?rik=5bDGBDJF9dwSQw&riu=http%3a%2f%2fclipart-library.com%2fimages_k%2fcredit-card-transparent-background%2fcredit-card-transparent-background-21.png&ehk=yHAlMxG5Gm34D3QUDC18bDk53JvCnSFbFR0hNayTmKA%3d&risl=&pid=ImgRaw&r=0" alt="Credit Card" class="img-fluid" style="max-width: 200px;">
                                </div>
                
                                <form id="paymentForm{{ $booking->id }}" action="{{ route('make.payment', ['id' => $booking->id]) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="cardHolderName{{ $booking->id }}" class="form-label">Cardholder Name</label>
                                        <input type="text" class="form-control" id="cardHolderName{{ $booking->id }}" name="cardholder_name" placeholder="Enter cardholder name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cardNumber{{ $booking->id }}" class="form-label">Card Number</label>
                                        <input type="text" class="form-control" id="cardNumber{{ $booking->id }}" name="card_number" placeholder="Enter card number" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cardExpiry{{ $booking->id }}" class="form-label">Expiration Date</label>
                                            <input type="text" class="form-control" id="cardExpiry{{ $booking->id }}" name="card_expiry" placeholder="MM/YY" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cardCVV{{ $booking->id }}" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cardCVV{{ $booking->id }}" name="card_cvv" placeholder="Enter CVV" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="paymentAmount{{ $booking->id }}" class="form-label">Payment Amount</label>
                                        <input type="number" class="form-control" id="paymentAmount{{ $booking->id }}" name="payment_amount" placeholder="Enter payment amount" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>
@endsection