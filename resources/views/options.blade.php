<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/options.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <title>Options</title>
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
    <!-- Cover -->
    <div class="cover">
        <img src="{{ asset('elements/optionbg.png') }}" alt="" class="bgcover">
    </div>
    <!-- filter -->
    <div class="filter">
        <div class="filter-box">
            <!-- room type -->

            <!-- location -->
            <div class="room-type-box">
                <div class="room-type">
                    <form action="{{ route('findRooms') }}" method="get">
                        @csrf <!-- Add CSRF token for form submission -->
                        <select class="textwrapmark4" name="roomType">
                            <option value="option1">Room Type..</option>
                            <option value="hotelRooms" {{ request()->input('roomType') == 'hotelRooms' ? 'selected' : '' }}>
                                Hotel Room
                            </option>
                            <option value="multipurposeRooms" {{ request()->input('roomType') == 'multipurposeRooms' ? 'selected' : '' }}>
                                Multipurpose Room
                            </option>
                        </select>
                        <select class="textwrapmark4" name="outlet">
                            <option value="option1">Search Locations..</option>
                            @foreach($outlets as $singleOutlet)
                            <option value="{{ $singleOutlet }}" {{ request()->input('selectedOutlet') == $singleOutlet ? 'selected' : '' }}>
                                {{ $singleOutlet }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" class="search1">
                            <img src="{{ asset('elements/search.png') }}" class="search">
                        </button>
                        <input type="hidden" name="checkinDate" value="{{ request()->input('checkinDate') }}">
                        <input type="hidden" name="checkoutDate" value="{{ request()->input('checkoutDate') }}">
                    </form>
                </div>
            </div>
            <!-- checkin -->
            <form action="{{ route('addToCart') }}" method="post" id="addToCartForm">
                @csrf
                <div class="framemark">
                    <div class="container">
                        <label for="checkinDate">Check in: &nbsp;</label>
                        <input type="date" id="checkinDate" name="checkinDate" value="{{ request()->input('checkinDate') }}">
                    </div>

                    <div class="container">
                        <label for="checkoutDate">Check Out: &nbsp;</label>
                        <input type="date" id="checkoutDate" name="checkoutDate" value="{{ request()->input('checkoutDate') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="main">
        <div class="row">
            @if($rooms->isEmpty())
            <p>No rooms available.</p>
            @else
            @foreach($rooms as $index => $room)
            <div class="room-card">
                @if($selectedRoomType == 'hotelRooms')
                <img src="{{ asset('elements/room.png') }}" alt="Hotel Room Image">
                @elseif($selectedRoomType == 'multipurposeRooms')
                <img src="{{ asset('elements/special.png') }}" alt="Special Room Image">
                @endif
                <div class="details">
                    <div class="details-name">
                        <input type="hidden" name="roomType" value="{{ $selectedRoomType == 'hotelRooms' ? 'hotelRooms' : 'multipurposeRooms' }}">
                        <input type="hidden" name="outletName" value="{{ $room->outletName }}">
                        <input type="hidden" name="roomPrice" value="{{ $room->roomPrice }}">
                        <input type="hidden" name="quantity" value="{{ $room->quantity }}">
                        <input type="hidden" name="hotelRoomID" value="{{ $selectedRoomType == 'hotelRooms' ? $room->hotelRoomID : $room->specialRoomID }}">
                        <input type="hidden" name="checkinDate" value="{{ request()->input('checkinDate') }}">
                        <input type="hidden" name="checkoutDate" value="{{ request()->input('checkoutDate') }}">

                        <div class="pname">
                            @if($selectedRoomType == 'hotelRooms')
                            {{ $room->roomType . ' - ID: ' . $room->hotelRoomID }}
                            @elseif($selectedRoomType == 'multipurposeRooms')
                            {{ $room->roomType . ' - ID: ' . $room->specialRoomID }}
                            @endif
                        </div>

                        <div class="outlet">
                            {{ $selectedRoomType == 'hotelRooms' ?  $room->outletName : $room->outletName }}
                        </div>
                    </div>

                    <div class="avl"> Room Availability: 1</div>
                    <div class="fac">
                        <div class="fac1">
                            <i class='bx bx-baguette'></i>
                            <span class="wifi">
                                {{ $selectedRoomType == 'hotelRooms' ? 'Breakfast Included' : '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="details2">
                    <div class="details2">
                      
                        <div class="price">Rp {{ $room->roomPrice }}</div>
                    
                    </div>
                    <form action="{{ route('addToCart') }}" method="post" class="addToCartForm">
                        @csrf
                        <input type="hidden" name="roomPrice" value="{{ $selectedRoomType == 'hotelRooms' ? $room->roomPrice : $room->roomPrice }}">
                        <input type="hidden" name="roomType" value="{{ $selectedRoomType == 'hotelRooms' ? 'hotelRooms' : 'multipurposeRooms' }}">
                        <input type="hidden" name="outletName" value="{{ $room->outletName }}">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="hotelRoomID" value="{{ $selectedRoomType == 'hotelRooms' ? $room->hotelRoomID : $room->specialRoomID }}">
                        <input type="hidden" name="checkinDate" value="{{ request()->input('checkinDate') }}">
                        <input type="hidden" name="checkoutDate" value="{{ request()->input('checkoutDate') }}">
                        <input type="hidden" name="quantity" id="quantityInput{{ $index }}" value="0">
                        <button type="submit" class="addcart">Add to Cart</button>
                    </form>
                    <form action="{{ route('bookingForm') }}" method="get" class="booking-form">
                        @csrf
                        <input type="hidden" name="hotelRoomID" value="{{ $room->hotelRoomID }}">
                        <input type="hidden" name="quantity" id="quantityInput{{ $index }}" value="0">
                        <input type="hidden" name="roomType" value="{{ $selectedRoomType }}">
                        <input type="hidden" name="outletName" value="{{ $room->outletName }}">
                        <input type="hidden" name="checkinDate" value="{{ request()->input('checkinDate') }}">
                        <input type="hidden" name="checkoutDate" value="{{ request()->input('checkoutDate') }}">
                        <button type="submit" class="book">Book</button>
                    </form>

                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

    <script src="{{ asset('js/plus-minus.js') }}"></script>
</body>

</html>