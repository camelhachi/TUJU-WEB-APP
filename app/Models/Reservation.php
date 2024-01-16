<?php

// app/Models/Reservation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $timestamps = false;
    protected $table = 'reservation';
    protected $fillable = [
        'customerID',
        'totalPrice',
        'reservationDateTime',
        'reservationStatus',
        // Add other fillable attributes as needed
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID');
    }

   
}
