<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderConfirm extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_confirm';
    
    public function orderAddress(){
        return $this->hasOne('App\OrderAddress','order_confirm_id');
    }
    
    public function orderDetails(){
        return $this->hasMany('App\OrderDetails','order_confirm_id');
    }
    
}