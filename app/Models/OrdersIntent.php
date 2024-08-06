<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersIntent extends Model
{
    use HasFactory;

    protected $table = 'orders_intents';

    protected $primaryKey = 'order_intent_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;


    protected $fillable = [
        'order_intent_price',
        'order_intent_type',
        'user_email',
        'user_phone',
        'expiration_date',
    ];
}
