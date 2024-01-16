<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" />
    <title>Form</title>
</head>

<body>
    <!-- Logo -->
    <div class="tujulogo">
        <img class="logo" src="elements/tujulogo.png" />
    </div>
    <div class="formcontent">
        <!-- kiri -->
        <div class="column1">
            <!-- Contact details -->
            <div class="contactdetails">
                <div class="details">
                    <div class="text-wrapper">Contact details</div>
                    <div class="row1">
                        <label for="name" class="text-wrapper-2">Name</label><br>
                        <!-- Pre-fill the 'Name' input field with customer data -->
                        <input type="text" id="name" class="rectangle" value="{{ Session::get('customerName') }}" />
                    </div>
                    <div class="row2">
                        <div class="col1">
                            <label for="phone" class="text-wrapper-3">Phone Number</label><br>
                            <!-- Pre-fill the 'Phone Number' input field with customer data -->
                            <input type="tel" id="phone" class="rectangle-2" value="{{ Session::get('customerPhoneNumber') }}" />
                        </div>
                        <div class="col2">
                            <label for="email" class="text-wrapper-4">Email</label><br>
                            <!-- Pre-fill the 'Email' input field with customer data -->
                            <input type="email" id="email" class="rectangle-3" value="{{ Session::get('customerEmail') }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="title">
                Guest Information
            </div>
            <form action="{{ route('processPayment') }}" method="post">
                @csrf
                @php
                // Calculate the subtotal
                $subtotal = 0;
                foreach(session('scart') as $item) {
                $subtotal += $item['price'];
                }

                // Set session data for total price and reservation ID
                session(['total_price' => $subtotal, 'reservation_id' => Session::get('reservationID')]);
                @endphp
                <input type="hidden" name="hotelRoomID" value="{{ $item['hotelRoomID'] }}">
                <input type="hidden" name="total_price" value="{{ $subtotal }}">
                <input type="hidden" name="reservation_id" value="{{ Session::get('reservationID') }}">
                <!-- Guest info -->
                @foreach(session('scart') as $index => $item)
                @for ($i = 0; $i < $item['quantity']; $i++)
                <div class="guest">
                    <div class="guestbox">
                        <div class="guestcontent">

                            <!-- Generate HTML structure based on cart item -->
                            <div class="col3">
                                <div class="num">{{ $index + 1 }}</div>
                            </div>
                            <div class="col1">
                                <div class="rname">{{ $item['roomType'] }}{{ $item['hotelRoomID'] }}</div>
                                <div class="outlet">{{ $item['outletName'] }}</div>
                                <img class="img" src="{{ asset('elements/tuju.jpg') }}" />
                            </div>
                            <div class="col4">
                                <div class="text-wrapper-9">Check-In:
                                    <div class="text-wrapper-91">{{ $item['checkinDate'] }}</div>
                                </div>
                                <div class="text-wrapper-10">Check-Out:
                                    <div class="text-wrapper-101">{{ $item['checkoutDate'] }}</div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="text-wrapper-6">Guest Information "{{ Session::get('reservationID') }}" </div>
                                <label for="guestName[]" class="text-wrapper-7">Name</label>
                                <input type="text" name="guestName[]" class="rectangle-4" required />
                                <label for="phoneNumber[]" class="text-wrapper-8">Phone Number</label>
                                <input type="text" name="phoneNumber[]" class="rectangle-5" required />
                            </div>
                            <!-- Close the form tag for each guest -->

                        </div>
                    </div>
                </div>
                @endfor
                @endforeach
        </div>
    </div>

    <!-- Kanan -->
    <div class="column2">
        <div class="col-2">
            <div class="summary">
                <div class="summary-box">
                    <div class="sumboxtext">
                        <div class="sumtext">Reservation Summary :</div>
                        <!-- Calculate the subtotal dynamically -->
                        @php
                        $subtotal = 0;
                        foreach(session('scart') as $item) {
                        $subtotal += $item['price'] * $item['quantity'];
                        }
                        @endphp
                        <div class="subtot">Rp.{{ number_format($subtotal, 2) }}</div>
                    </div>
                    <button class="payment">Proceed to Payment</button>
                </div>
            </div>
        </div>
    </div>
    </form>

</body>

</html>