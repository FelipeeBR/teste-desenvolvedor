<?php

namespace App\Services;

use App\Models\Curriculum;

class CurriculumService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $data): Curriculum {
        return Curriculum::create($data);
    }
}
