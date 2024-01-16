<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use App\Models\Reservation;
use App\Models\HotelRoomBooking;

class addToCartTest extends TestCase
{
    use DatabaseTransactions;

    public function testAddToCart()

    {
        // Mock the Reservation model
        $reservationMock = $this->mock(Reservation::class);
        $this->app->instance(Reservation::class, $reservationMock);

        // Mock the HotelRoomBooking model
        $hotelRoomBookingMock = $this->mock(HotelRoomBooking::class);
        $this->app->instance(HotelRoomBooking::class, $hotelRoomBookingMock);

        // Set the session driver to 'array' for in-memory sessions
        config(['session.driver' => 'array']);

        // Fake the session
        Session::start();
        session(['customerID' => 1]);

        // Mock the request data
        $requestData = [
            'roomType' => 'hotelRooms',
            'outletName' => 'Wijaya Kusuma Homes Syariah',
            'quantity' => 1,
            'roomPrice' => 157500,
            'hotelRoomID' => 1,
            'checkinDate' => '2024-01-01',
            'checkoutDate' => '2024-01-03',
        ];

        // Mock the Reservation model
        $reservationMock->shouldReceive('create')->andReturnUsing(function ($reservationData) {
            $this->assertEquals(1, $reservationData['customerID']);
            $this->assertEquals('cart', $reservationData['reservationStatus']);
            return (object)['reservationID' => 1];
        });

        // Mock the HotelRoomBooking model
        $hotelRoomBookingMock->shouldReceive('create')->andReturnUsing(function ($bookingData) {
            $this->assertEquals(1, $bookingData['reservationID']);
            $this->assertEquals(1, $bookingData['hotelRoomID']);
            $this->assertEquals('2024-01-01', $bookingData['checkInDate']);
            $this->assertEquals('2024-01-03', $bookingData['checkOutDate']);
            return (object)['hotelRoomID' => 1];
        });

        // Enable debugging
        dump(session()->all());

        // Call the method using Laravel's testing helpers
        $response = $this->post('/add-to-cart', $requestData);

        // Disable debugging
        dump(session()->all());

        // Assert the response
        $response->assertRedirect()->assertSessionHas('success', 'Added to cart successfully');
    }
}