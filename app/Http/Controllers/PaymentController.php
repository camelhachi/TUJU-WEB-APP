<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Location;
use App\Models\SpecialRoom;

class PaymentController extends Controller
{
    public function confirmPayment(Request $request)
    {
        $customerID = Session::get ('customerID');
        $reservationID = Session::get('reservationID');
        $cartItems = Session::get('scart', []); // Assuming this is where the cart items are stored; 
        $status = "complete"; 
        $paymentTypeID = 1; 
        $totalPaid = $request->input('totalPaid');

        // Call the stored procedure with the correct number of arguments
        DB::select('CALL UpdateReservationAndInsertPayment(?, ?, ?, ?)', [
            $status, $paymentTypeID, $reservationID, $totalPaid
        ]);

        // Update the status in the HotelRoom or SpecialRoom based on the cart items
        foreach ($cartItems as $item) {
            if ($item['roomType'] == 'hotelRooms') {
                // Update the HotelRoom status
               Room::where('hotelRoomID', $item['hotelRoomID'])
                         ->update(['roomStatus' => 1]);
            } elseif ($item['roomType'] == 'multipurposeRooms') {
                // Update the SpecialRoom status
                SpecialRoom::where('specialRoomID', $item['hotelRoomID'])
                           ->update(['roomStatus' => 1]);
            }
        }

        $outlets = Location::pluck('outletName');
        return view('index', compact('outlets','customerID'));
    }
}
