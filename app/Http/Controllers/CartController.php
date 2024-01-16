<?php

namespace App\Http\Controllers;

use App\Models\HotelRoomBooking;
use App\Models\SpecialRoomBooking;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;


class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        $checkinDate = $request->input('checkinDate');
        $checkoutDate = $request->input('checkoutDate');
        $roomData = [
            'roomType' => $request->input('roomType'),
            'outletName' => $request->input('outletName'),
            'quantity' => 1,
            'price' => $request->input('roomPrice'),
            'hotelRoomID' => $request->input('hotelRoomID'),
            'checkinDate' => $checkinDate, 
            'checkoutDate' => $checkoutDate, 
        ];

        $roomData['cartItemId'] = uniqid('cart_item_');
        // Fetch special room price if it's a multipurpose room
        
        // Get existing cart items from the session
        $cartItems = Session::get('scart', []);
        $roomData['cartItemId'] = uniqid('cart_item_');
        $cartItems[] = $roomData;

        // Append the new item to the existing cart
        $existingIndex = null;
        foreach ($cartItems as $index => $item) {
            if ($item['hotelRoomID'] === $roomData['hotelRoomID']) {
                $existingIndex = $index;
                break;
            }
        }

        if (is_null($existingIndex)) {
            
            $cartItems[] = $roomData;
        } else {
           
        }

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
                'priceID'=> '1',
                'dateBooked' => now()->toDateString(),
                'guestName' => 'placeholder', 
                'phoneNumber' => 'placeholder', 
            ]);
        
            Session::put('specialRoomID', $specialRoomBooking->specialRoomID);
        }
        return redirect()->back()->with('success', 'Added to cart successfully');
    }
   

    public function cart(Request $request)
    {
        // Retrieve cart items from the session directly
        $cartItems = Session::get('scart', []);

        // Retrieve reservation ID from the session
        $reservationID = Session::get('reservationID');
        return view('scart', compact('cartItems', 'reservationID'));
    }



    public function deleteCartItem(Request $request)
{
    $index = $request->input('index');
    $cartItems = session('scart');

    // Check if the index exists in the cart
    if (array_key_exists($index, $cartItems)) {
        $deletedItem = $cartItems[$index];
        unset($cartItems[$index]);
        session(['scart' => array_values($cartItems)]);

        // Check if the deleted item has a reservation ID
        if (isset($deletedItem['reservationID'])) {
            // Fetch the reservation to delete
            $reservationToDelete = Reservation::where('reservationID', $deletedItem['reservationID'])->first();

            if ($reservationToDelete) {
                // Delete associated hotel room or multipurpose room booking
                if ($reservationToDelete->roomType == 'hotelRooms') {
                    HotelRoomBooking::where('reservationID', $deletedItem['reservationID'])->delete();
                } elseif ($reservationToDelete->roomType == 'multipurposeRooms') {
                    SpecialRoomBooking::where('reservationID', $deletedItem['reservationID'])->delete();
                }

                // Delete the reservation itself
                $reservationToDelete->delete();

                return redirect()->back()->with('success', 'Associated reservation and bookings deleted successfully!');
            }
        }

        return redirect()->back()->with('success', 'Cart item deleted successfully, but no associated reservation found.');
    }

    return redirect()->back()->with('error', 'No cart item found to delete.');
}

}
