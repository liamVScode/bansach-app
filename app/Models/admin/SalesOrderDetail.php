<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SalesOrderDetail
 *
 * @property $OrderID
 * @property $BookID
 * @property $QuantitySold
 * @property $Price
 * @property $SubTotal
 *
 * @property Book $book
 * @property Salesorder $salesorder
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SalesOrderDetail extends Model
{
    protected $table = "SalesOrderDetail";
    protected $primaryKey = ["OrderID", "BookID"];
    static $rules = [
        'OrderID' => 'required',
        'BookID' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['OrderID', 'BookID', 'QuantitySold', 'Price', 'SubTotal'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function book()
    {
        return $this->hasOne('App\Models\admin\Book', 'BookID', 'BookID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function salesorder()
    {
        return $this->hasOne('App\Models\admin\SalesOrder', 'OrderID', 'OrderID');
    }


}