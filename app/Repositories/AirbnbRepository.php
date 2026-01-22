<?php

namespace App\Repositories;

use App\Models\Airbnb;
use App\Repositories\BaseRepository;

class AirbnbRepository extends BaseRepository
{
    protected $fieldSearchable = [

    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Airbnb::class;
    }
}
