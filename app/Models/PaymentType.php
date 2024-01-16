<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table = 'paymenttype';
    
    protected $primaryKey = 'paymentTypeID';

    protected $fillable = [
        'typeName',
    ];
}