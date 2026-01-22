<?php

namespace App\Repositories;

use App\Models\County;
use App\Repositories\BaseRepository;

class CountyRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return County::class;
    }
}
