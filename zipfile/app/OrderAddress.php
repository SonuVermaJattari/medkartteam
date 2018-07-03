<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_address';
    
    
    public function orderConfirm()
    {
        return $this->belongsTo('App\OrderConfirm');
    }
}