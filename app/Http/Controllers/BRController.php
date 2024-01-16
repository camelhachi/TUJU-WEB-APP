<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\HotelRoomBooking;
use App\Models\SpecialRoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BRController extends Controller
{
    public function processPayment(Request $request)
    {
        try {
            $reservationID = Session::get('reservationID');
            $cartItems = Session::get('scart', []);

            if (!$reservationID || empty($cartItems)) {
                throw new \Exception('Reservation ID or cart items are not set.');
            }

            $guestName = $request->input('guestName', []);
            $phoneNumber = $request->input('phoneNumber', []);

            if (!is_array($guestName) || !is_array($phoneNumber)) {
                throw new \Exception('GuestName or phoneNumber is not an array.');
            }

            DB::beginTransaction();

            DB::statement('CALL update_reservation_status_to_pending2(?)', [$reservationID]);

            foreach ($cartItems as $index => $item) {
                if (array_key_exists($index, $guestName) && array_key_exists($index, $phoneNumber)) {
                    if ($item['roomType'] == 'hotelRooms') {
                        HotelRoomBooking::updateOrCreate(
                            [
                                'reservationID' => $reservationID,
                                'hotelRoomID' => $item['hotelRoomID'],
                                'checkInDate' => $item['checkinDate'],
                                'checkOutDate' => $item['checkoutDate'],
                            ],
                            [
                                'guestName' => $guestName[$index],
                                'phoneNumber' => $phoneNumber[$index],
                            ]
                        );
                    } elseif ($item['roomType'] == 'multipurposeRooms') {
                        SpecialRoomBooking::updateOrCreate(
                            [
                                'reservationID' => $reservationID,
                                'specialRoomID' => $item['hotelRoomID'],
                            ],
                            [
                                'guestName' => $guestName[$index],
                                'phoneNumber' => $phoneNumber[$index],
                            ]
                        );
                    } else {
                        throw new \Exception("Invalid room type: {$item['roomType']}");
                    }
                } else {
                    throw new \Exception("GuestName or phoneNumber missing for index $index.");
                }
            }

            DB::commit();

            return redirect()->intended('/midtrans')->with('status', 'you may proceed to payment.');
       
        // Log the exception for debugging purposes
        }catch (\Exception $e) {
            DB::rollback();
            
            // Log the entire exception object for detailed error information
            Log::error('Error in processPayment', [
                'exception' => $e,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        
            return redirect()->back()->with('error', 'Error processing payment: ' . $e->getMessage());
        }
        
}
    


public function midtrans()
{
    // This method can remain unchanged
    return view('midtrans')->with('message', 'Payment processed successfully. Redirect to Midtrans payment page.');
}

}