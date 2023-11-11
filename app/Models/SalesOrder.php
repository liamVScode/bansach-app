<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $table = "SalesOrder";

    protected $primaryKey = 'OrderID';

    public $timestamps = false;

    protected $fillable = [
        'OrderDate',
        'UserID',
        'OrderStatus',
        'ShippingDate',
        'ShippingFee',
        'OrderNote',
        'Discount',
        'TotalPrice',
    ];
}
