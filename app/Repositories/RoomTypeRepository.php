<?php

namespace App\Repositories;

use App\Models\RoomType;
use App\Repositories\BaseRepository;

class RoomTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return RoomType::class;
    }
}
