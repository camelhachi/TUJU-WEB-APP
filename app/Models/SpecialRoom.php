<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialRoom extends Model
{
    use HasFactory;

    // Assuming your table name is 'special_rooms'
    protected $table = 'specialroom';
    public $timestamps = false;
    protected $fillable = [
        'specialRoomID',
        'roomNumber',
        'outletName',
        'maxOccupancy',
        'roomType',
        'roomPrice',
        'fnbIncluded',
        'roomStatus',
        'image'
    ];

    // Add any relationships, accessors, or additional methods below
}
