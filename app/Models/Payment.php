<?php
// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $primaryKey = 'paymentID';
    public $timestamps = false;
    protected $fillable = [
        'paymentTypeID',
        'reservationID',
        'totalPaid',
    ];

    // Relationships
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'paymentTypeID', 'paymentTypeID');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservationID', 'reservationID');
    }
}
