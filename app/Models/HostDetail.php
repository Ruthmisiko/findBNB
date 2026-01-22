<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostDetail extends Model
{
    public $table = 'host_details';

    public $fillable = [
        'full_name',
        'phone_number',
        'alt_phone_number',
        'email',
        'id_number'
    ];

    protected $casts = [

    ];

    public static array $rules = [

    ];

    public function airbnbs()
    {
        return $this->hasMany(Airbnb::class, 'host_id');
    }
}
