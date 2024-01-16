<?php

// app/Models/SpecialRoomBooked.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialRoomBooking extends Model
{
    protected $table = 'specialroombooked';

    protected $primaryKey = 'specialRoomBookedID';

    protected $fillable = [
        'reservationID',
        'specialRoomID',
        'priceID',
        'dateBooked',
        'guestName',
        'phoneNumber',
        // Add other fillable attributes as needed
    ];
    public $timestamps = false;
    // Define relationships or other methods if necessary
}
