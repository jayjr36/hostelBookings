<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    public function userBookings()
    {
        $userId = Auth::id();
        $bookings = Booking::where('user_id', $userId)->get();
        return view('booking', compact('bookings'));
    }
    public function store(Request $request)
    {
        $userId = Auth::id();

        $booking = new Booking();
        $booking->user_id = $userId;
        $booking->hostel_name = $request->hostel_name;
        $booking->home_address = $request->homeAddress;
        $booking->guardian_name = $request->guardianName;
        $booking->guardian_contact = $request->guardianContact;
        $booking->relationship = $request->relationship;
        $booking->duration = $request->duration;
        $booking->price = $request->price;
        $booking->room_number = $request->roomNumber;

        // Save the booking to the database
        $booking->save();
        
        // Optionally, you can return a response indicating success or failure
        return response()->json(['message' => 'Booking confirmed'], 200);
    }

    public function makePayment(Request $request, $id)
{
    $booking = Booking::findOrFail($id);
    $paymentAmount = $request->input('payment_amount');
    $cardholderName = $request->input('cardholder_name');
    $cardNumber = $request->input('card_number');
    $cardExpiry = $request->input('card_expiry');
    $cardCVV = $request->input('card_cvv');
    
    // Retrieve the current user's balance
    $currentUser = auth()->user();
    $userBalance = $currentUser->balance;
    
    if ($paymentAmount <= 0) {
        return redirect()->back()->with('error', 'Payment amount must be greater than 0!');
    }

    // Check if the user's balance is sufficient for the payment
    if ($userBalance < $paymentAmount) {
        return redirect()->back()->with('error', 'Insufficient funds!');
    }

    // Deduct the payment amount from the user's balance
    $newBalance = $userBalance - $paymentAmount;
    $currentUser->balance = $newBalance;
    $currentUser->save();

    // Update the booking's payment status
    if ($booking->price == $paymentAmount) {
        $booking->payment_status = 'paid';
    } else {
        return redirect()->back()->with('error', 'Incomplete transaction');
    }

    Payment::create([
        'user_id' => $currentUser->id,
        'booking_id' => $booking->id,
        'cardholder_name' => $cardholderName,
        'card_number' => $cardNumber,
        'card_expiry' => $cardExpiry,
        'card_cvv' => $cardCVV,
        'payment_amount' => $paymentAmount,
    ]);
    $booking->save();


    return redirect()->back()->with('success', 'Payment submitted successfully!');
}

public function downloadReceipt($id)
{
    $booking = Booking::findOrFail($id);
    $user = Auth::user();

    if ($booking->payment_status !== 'paid') {
        return redirect()->back()->with('error', 'Payment not completed yet!');
    }

    // Retrieve the payment details for the booking
    $payment = Payment::where('booking_id', $id)->where('user_id', $user->id)->first();

    if (!$payment) {
        return redirect()->back()->with('error', 'Payment details not found!');
    }

    $data = [
        'booking' => $booking,
        'user' => $user,
        'payment' => $payment
    ];

    $pdf = PDF::loadView('receipt', $data);
    return $pdf->download('receipt.pdf');
}
   
}