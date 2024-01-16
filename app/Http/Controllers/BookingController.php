<?php

namespace App\Http\Controllers;

use App\Models\HotelRoomBooking;
use App\Models\SpecialRoomBooking;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Price;

class BookingController extends Controller
{
    public function showBookingForm(Request $request)
    {

        // Retrieve data from the query 
        $hotelRoomID = $request->input('hotelRoomID');
        $roomType = $request->input('roomType');
        $outletName = $request->input('outletName');
        $roomCount = $request->input('roomCount');
        $checkinDate = $request->input('checkinDate');
        $checkoutDate = $request->input('checkoutDate');

        // Duplicate logic from CartController
        $checkinDate = $request->input('checkinDate');
        $checkoutDate = $request->input('checkoutDate');
        $roomData = [
            'roomType' => $request->input('roomType'),
            'outletName' => $request->input('outletName'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('roomPrice'),
            'hotelRoomID' => $request->input('hotelRoomID'),
            'checkinDate' => $checkinDate, 
            'checkoutDate' => $checkoutDate, 
            
        ];
       
      
        // Fetch special room price if it's a multipurpose room
       

        // Get existing cart items from the session
        $cartItems = Session::get('scart', []);

        // Append the new item to the existing cart
        $cartItems[] = $roomData;

        // Update the session variable with the new cart
        Session::put('scart', $cartItems);

        // Get customer ID from the session
        $customerID = Session::get('customerID');
        $totalPrice = array_sum(array_column($cartItems, 'price'));

        // Create a new reservation using Eloquent
        $reservation = Reservation::create([
            'customerID' => $customerID,
            'totalPrice' => $totalPrice,
            'reservationDateTime' => now()->toDateTimeString(),
            'reservationStatus' => 'cart',
            // Add other reservation data as needed
        ]);

        $reservationID = DB::getPdo()->lastInsertId();

        // Set reservation ID in the session
        Session::put('reservationID', $reservationID);

        if ($roomData['roomType'] == 'hotelRooms') {
            // Add to HotelRoomBooking table
            $hotelRoomBooking = HotelRoomBooking::create([
                'reservationID' => $reservationID,
                'hotelRoomID' => $roomData['hotelRoomID'],
                'checkInDate' => $roomData['checkinDate'],
                'checkOutDate' => $roomData['checkoutDate'],
                'guestName' => 'placeholder', 
                'phoneNumber' => 'placeholder', 
            ]);

            // Set hotel room ID in the session
            Session::put('hotelRoomID', $hotelRoomBooking->hotelRoomID);
        } elseif ($roomData['roomType'] == 'multipurposeRooms') {
            // Add to SpecialRoom table
            $specialRoomBooking = SpecialRoomBooking::create([
                'reservationID' => $reservationID,
                'specialRoomID' => $roomData['hotelRoomID'], 
                'dateBooked' => now()->toDateString(),
                'guestName' => 'placeholder', 
                'phoneNumber' => 'placeholder', 
               
            ]);
                
                Session::put('specialRoomID', $specialRoomBooking->specialRoomID);
        }

       
        return view('form', compact('hotelRoomID', 'roomType', 'outletName', 'roomCount', 'checkinDate', 'checkoutDate'));
    }
}
