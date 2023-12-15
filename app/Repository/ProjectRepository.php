<?php

namespace App\Repository;

use App\Models\Project;
use App\Repository\BaseRepository;

class ProjectRepository extends BaseRepository {

    public function __construct(Project $model){
        $this->model = $model;
    }

    protected $fieldsProject = [
        'name', 'description', 'start_date', 'end_date'
    ];

    public function getFieldData(): array{
        return $this->fieldsProject;
    }

    public function model(): string{
        return Project::class;
    }
}


