<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $primaryKey = 'event_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'event_category',
        'event_title',
        'event_description',
        'event_date',
        'event_image',
        'event_city',
        'event_address',
        'event_status',
        'event_created_on'
    ];
}
