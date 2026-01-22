<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airbnb extends Model
{
    public $table = 'airbnbs';

    public $fillable = [
        'name',
        'description',
        'area_id',
        'host_id',
        'room_type_id',
        'price'
    ];

    protected $casts = [

    ];

    public static array $rules = [

    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function host()
    {
        return $this->belongsTo(HostDetail::class, 'host_id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

}
