<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;



class Room extends Model
{ 
    public $timestamps = false;
    protected $table = 'hotelroom'; // Adjust to match your actual table name
    protected $primaryKey = 'hotelRoomID'; 
    protected $fillable = ['hotelRoomID','roomNumber', 'outletName', 'maxOccupancy', 'roomType', 'roomPrice', 'breakfastincluded', 'roomStatus', 'image'];

    public function getRouteKeyName()
    {
        return 'hotelRoomID'; // Adjust to match the attribute you want to use
    }
    
    
}

