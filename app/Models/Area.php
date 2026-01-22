<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $table = 'areas';

    public $fillable = [
        'id',
        'county_id',
        'name'
    ];

    protected $casts = [

    ];

    public static array $rules = [

    ];

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function airbnbs()
    {
        return $this->hasMany(Airbnb::class);
    }
}
