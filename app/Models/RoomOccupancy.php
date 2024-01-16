<?php
// app/Models/RoomOccupancy.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomOccupancy extends Model
{
    protected $table = 'hotelroomoccupied';
    public $timestamps = false;

    protected $fillable = [
        'hotelRoomID',
        'dateOccupied',
        // Add other fields as needed
    ];

    // Add relationships or other methods as needed
}
