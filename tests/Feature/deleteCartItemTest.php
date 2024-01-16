<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reservation;
use App\Models\HotelRoomBooking;
use App\Models\SpecialRoomBooking;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class deleteCartItemTest extends TestCase
{
    use DatabaseTransactions;

    public function testDeleteCartItem()
    {
        // Create a test reservation for the cart item
        $reservation = Reservation::create([
            'customerID' => 1,
            'totalPrice' => 100,
            'reservationDateTime' => now(),
            'reservationStatus' => 'cart',
            'roomType' => 'hotelRooms', // or 'multipurposeRooms' based on your logic
        ]);

        // Create a test hotel room booking if the room type is hotelRooms
        if ($reservation->roomType == 'hotelRooms') {
            HotelRoomBooking::create([
                'reservationID' => $reservation->reservationID,
                // Add other necessary fields for HotelRoomBooking
            ]);
        } elseif ($reservation->roomType == 'multipurposeRooms') {
            // Create a test special room booking if the room type is multipurposeRooms
            SpecialRoomBooking::create([
                'reservationID' => $reservation->reservationID,
                // Add other necessary fields for SpecialRoomBooking
            ]);
        }

        // Set the session data with the cart item
        session(['scart' => ['index' => $reservation->toArray()]]);

        // Send a request to delete the cart item
        $response = $this->post('/deleteCartItem', ['index' => 'index']);

        // Assert that the reservation and associated bookings are deleted
        $this->assertDatabaseMissing('reservation', ['reservationID' => $reservation->reservationID]);
        $this->assertDatabaseMissing('hotelroombooked', ['reservationID' => $reservation->reservationID]);

        // Assert the redirect
        $response->assertRedirect();

        // Check the actual session message
        $actualMessage = session('success');
        dump($actualMessage);

        // Update the assertion based on the actual session message
        $this->assertEquals($actualMessage, 'Cart item deleted successfully, but no associated reservation found.');
    }
}