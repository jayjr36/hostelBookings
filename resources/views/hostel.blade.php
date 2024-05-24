@extends('layout')

@section('content')
<div class="container">
    <h1>Hostels</h1>
    <div class="row">
        @foreach($hostels as $hostel)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ asset('storage/' . $hostel->image) }}" class="card-img-top" alt="Hostel Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $hostel->name }}</h5>
                    <p class="card-text">{{ $hostel->location }}</p>
                    <p class="card-text">{{ $hostel->description }}</p>
                    <button class="btn btn-primary book-hostel" data-hostel-name="{{ $hostel->name }}" data-hostel-id="{{ $hostel->id }}">Book Hostel</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
</div>

<div class="modal" id="bookingModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHostelName"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @elseif(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

                <form id="bookingForm">
                    <div class="mb-3">
                        <label for="homeAddress" class="form-label">Home Address</label>
                        <input type="text" class="form-control" id="homeAddress" name="homeAddress" placeholder="Enter home address">
                    </div>

                    <div class="mb-3">
                        <label for="disability" class="form-label">Disability</label>
                        <input type="text" class="form-control" id="disability" name="disability" placeholder="Disability">
                    </div>
                    
                    <div class="mb-3">
                        <label for="guardianName" class="form-label">Guardian Name</label>
                        <input type="text" class="form-control" id="guardianName" name="guardianName" placeholder="Enter guardian name">
                    </div>
                    
                    <div class="mb-3">
                        <label for="guardianContact" class="form-label">Guardian Contact</label>
                        <input type="tel" class="form-control" id="guardianContact" name="guardianContact" placeholder="Enter guardian contact number">
                    </div>
                    
                    <div class="mb-3">
                        <label for="relationship" class="form-label">Relationship with Guardian</label>
                        <input type="text" class="form-control" id="relationship" name="relationship" placeholder="Enter relationship with the guardian">
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration of Stay</label>
                        <select class="form-select" id="duration" name="duration">
                            <option value="semester">Semester</option>
                            <option value="year">Year</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" readonly>
                    </div>
                    
                    Assigned Room Number: <span id="roomNumber"></span>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmBooking">Confirm Booking</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#duration').change(function() {
        var duration = $(this).val();
        var priceInput = $('#price');
        if (duration === 'semester') {
            priceInput.val('50000');
        } else if (duration === 'year') {
            priceInput.val('100000');
        }
    });
});


    document.addEventListener('DOMContentLoaded', function() {
        const bookButtons = document.querySelectorAll('.book-hostel');
        bookButtons.forEach(button => {
            button.addEventListener('click', function() {
                const hostelId = this.getAttribute('data-hostel-id');
                var hostelName = $(this).data('hostel-name');
            $('#modalHostelName').text(hostelName);
                displayModal(hostelId);
            });
        });

        function displayModal(hostelId) {
            const modal = document.getElementById('bookingModal');
            const roomNumberSpan = document.getElementById('roomNumber');
            const randomRoomNumber = Math.floor(Math.random() * 100) + 1; 
            roomNumberSpan.textContent = randomRoomNumber; 
            $(modal).modal('show'); 
        } 
    });

    $('#confirmBooking').click(function() {
        var formData = {
            _token: '{{ csrf_token() }}',
            hostel_name: $('#modalHostelName').text(),
            homeAddress: $('#homeAddress').val(),
            guardianName: $('#guardianName').val(),
            guardianContact: $('#guardianContact').val(),
            relationship: $('#relationship').val(),
            duration: $('#duration').val(),
            price: $('#price').val(),
            roomNumber: $('#roomNumber').text()
        };

        $.ajax({
            url: '/book', 
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log('Booking successful:', response);
            },
            error: function(xhr, status, error) {
                console.error('Booking failed:', error);
            }
        });
    });
</script>
@endsection
