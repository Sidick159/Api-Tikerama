<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    protected $table = 'ticket_types';

    protected $primaryKey = 'ticket_type_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;


    protected $fillable = [
        'ticket_type_event_id',
        'ticket_type_name',
        'ticket_type_price',
        'ticket_type_quantity',
        'ticket_type_real_quantity',
        'ticket_type_total_quantity',
        'ticket_type_description'
    ];
}
