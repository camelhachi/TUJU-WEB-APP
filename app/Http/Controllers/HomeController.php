<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Price;
use App\Models\SpecialRoom;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $outlets = Location::pluck('outletName');
        return view('index', compact('outlets'));
    }

    public function findRooms(Request $request)
    {
        $selectedOutlet = $request->input('outlet');
        $selectedRoomType = $request->input('roomType');

        // Check if the form is submitted
        if ($request->isMethod('get')) {
            // Store the selected outlet in the session
            if ($request->has('outlet')) {
                session(['selectedOutlet' => $request->input('outlet')]);
            }

            // Store the selected check-in date in the session
            if ($request->has('checkinDate')) {
                session(['selectedCheckinDate' => $request->input('checkinDate')]);
            }

            // Store the selected check-out date in the session
            if ($request->has('checkoutDate')) {
                session(['selectedCheckoutDate' => $request->input('checkoutDate')]);
            }
        }

        // Initialize $rooms as an empty array
        $rooms = [];
        $hotelRoomIDs = [];
        $specialRoomIDs = [];

        if ($selectedRoomType == 'hotelRooms') {
            // For hotel rooms
            $rooms = Room::where('outletName', $selectedOutlet)
                ->where('roomStatus', 0)
                ->select('hotelRoomID', 'breakfastIncluded', 'roomPrice', 'roomType', 'outletName')
                ->distinct('hotelRoomID')
                ->get();

            // Store hotel room IDs in the array
            $hotelRoomIDs = $rooms->pluck('hotelRoomID')->toArray();

           
            // Filter only one room per room type
            $rooms = $rooms->unique('hotelRoomID');
        } elseif ($selectedRoomType == 'multipurposeRooms') {
            // For multipurpose rooms
            $rooms = SpecialRoom::where('outletName', $selectedOutlet)
            ->where('roomStatus', 0)
            ->select('specialRoomID', 'fnbIncluded', 'roomPrice', 'roomType', 'outletName')
            ->distinct('specialRoomID')
            ->get();

            // Store special room IDs in the array
            $specialRoomIDs = $rooms->pluck('specialRoomID')->toArray();
        }

        $outlets = Location::pluck('outletName');
        // Pass $rooms, $outlets, $roomCount, $selectedRoomType, $hotelRoomIDs, $specialRoomIDs, and $specialRoomPrices to your view
        return view('options', compact('rooms', 'outlets', 'selectedRoomType', 'hotelRoomIDs', 'specialRoomIDs'));

    }


    public function showForm()
    {
        return view('booking.form');
    }

    public function processForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'checkinDate' => 'required|date',
            'checkoutDate' => 'required|date',
        ]);

        // Create a new Booking model and store the data
        $booking = Booking::create([
            'checkinDate' => $request->input('checkinDate'),
            'checkoutDate' => $request->input('checkoutDate'),
        ]);

        // Redirect to another page with the form data as parameters
        return redirect()->route('options', [
            'checkin' => $booking->checkinDate,
            'checkout' => $booking->checkoutDate,
        ]);
    }
}
