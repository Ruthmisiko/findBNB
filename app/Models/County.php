<?php

namespace App\Models;

use App\Models\Area;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    public $table = 'counties';

    public $fillable = [
        'id',
        'name',
        'description'
    ];

    protected $casts = [

    ];

    public static array $rules = [

    ];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
