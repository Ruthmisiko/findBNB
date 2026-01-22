<?php

namespace App\Repositories;

use App\Models\HostDetail;
use App\Repositories\BaseRepository;

class HostDetailRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return HostDetail::class;
    }
}
