<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    public $table = 'room_types';

    public $fillable = [
        'id',
        'name',
        'description'
    ];

    protected $casts = [

    ];

    public static array $rules = [

    ];


}
