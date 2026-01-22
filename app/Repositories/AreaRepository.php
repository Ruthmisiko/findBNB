<?php

namespace App\Repositories;

use App\Models\Area;
use App\Repositories\BaseRepository;

class AreaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Area::class;
    }
}
