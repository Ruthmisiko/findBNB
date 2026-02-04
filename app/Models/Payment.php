<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'host_id',
        'checkout_request_id',
        'amount',
        'phone_number',
        'status',
        'response',
    ];

    public function host()
    {
        return $this->belongsTo(HostDetail::class, 'host_id');
    }
}