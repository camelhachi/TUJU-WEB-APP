<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomBooking extends Model
{
    protected $table = 'hotelroombooked'; // Replace with your actual table name

    protected $fillable = [
        'reservationID',
        'hotelRoomID',
        'checkInDate',
        'checkOutDate',
        'guestName',
        'phoneNumber',
        // Add other fillable fields as needed
    ];
    protected $primaryKey = 'hotelRoomBookedID';
    // If you have timestamps (created_at and updated_at) columns
    public $timestamps = true;


    // Additional model logic or relationships can be added here
}
