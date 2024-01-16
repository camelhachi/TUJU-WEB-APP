<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/scart.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <title>Shopping</title>
</head>

<body>
    <div class="container">
        <!-- Navigation Bar -->
        <div class="navbar">
            <img src="{{ asset('elements/tujulogo.png') }}" class="logo">
            <nav>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Locations</a></li>
                    <li><a href="">About Tuju</a></li>
                    <li><a href="">FAQ</a></li>
                </ul>
            </nav>
            <a href="/signup">
                <button class="signup">Sign Up</button>
            </a>
            <a href="{{ route('scart', ['cartItems' => session('scart')]) }}" id="cartLink">
                <img src="{{ asset('elements/shoppingcart.png') }}" class="cart-icon">
            </a>
            <img src="{{ asset('elements/profile.png') }}" class="profile-icon">
        </div>
    </div>

    <div class="top">
        <h1>My Shopping Cart</h1>
    </div>

    <!-- Cart content -->
    <div class="cart-content">
    
        @if(session('scart') && count(session('scart')) > 0)
        <!-- Content for each item in the cart -->
        @foreach(session('scart') as $index => $item)
        <div class="col1">
            <div class="contents">
                <form action="{{ route('deleteCartItem') }}" method="post">
                    @csrf
                    <input type="hidden" name="index" value="{{ $index }}">
                    <!-- The content of each item in the cart -->
                    <div class="overlap-3">
                        <div class="rectangle-3"></div>
                        <div class="rectangle-4"></div>

                        <div class="text-wrapper-8">Rp. {{ number_format($item['price'], 2) }}</div>
                        <img class="img" src="{{ asset('elements/room.png') }}" />
                        <cinput type="checkbox" id="checkbox" class="rectangle-5" />
                        <div class="text-wrapper-9">Check-In:
                            <div class="text-wrapper-91"> {{ $item['checkinDate'] }}</div>
                        </div>
                        <div class="text-wrapper-10">Check-Out:
                            <div class="text-wrapper-101">{{ $item['checkoutDate'] }}</div>
                        </div>


                        <div class="text-wrapper-11">ID : {{ $item['hotelRoomID'] }} | {{ $item['roomType'] }} #{{ $reservationID }}</div>
                        <div class="text-wrapper-12"> {{ $item['quantity'] }} x {{ $item['roomType'] }}</div>
                        <div class="text-wrapper-13">{{ $item['outletName'] }}</div>
                    </div>
                    <button type="submit" class="del"><i class='bx bxs-trash-alt'></i>Delete Item</button>
                </form>
            </div>
        </div>
        @endforeach

        <!-- The summary section -->
        <div class="col2">
            <div class="summary">
                <div class="summary-box">
                    <div class="sumboxtext">
                        <div class="sumtext">Subtotal :</div>
                        <!-- Use a variable to calculate the subtotal -->
                        @php
                        $subtotal = 0;
                        foreach(session('scart') as $item) {
                        $subtotal += $item['price'] * $item['quantity'];
                        }
                        @endphp
                        <div class="subtot">Rp. {{ number_format($subtotal, 2) }}</div>
                    </div>
                    <button class="payment" onclick="window.location='/form'">Proceed to Checkout</button>
                </div>
            </div>
        </div>
        @else
        <!-- Message when the cart is empty -->
        <p>Your cart is empty.</p>
        @endif
    </div>

</body>

</html>