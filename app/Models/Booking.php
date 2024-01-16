<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Booking.php

class Booking extends Model
{
    protected $fillable = ['checkinDate', 'checkoutDate'];
}
