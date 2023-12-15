<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project; 

class ProjectTableSeeder extends Seeder
{
    public function run()
    {
        Project::create([
            'name' => 'CNMH',
            'description' => 'Create app management for CNMH',
            'start_date' => '2023-11-22',
            'end_date' => '2023-11-27',
        ]);

        Project::create([
            'name' => 'Navilux',
            'description' => 'Create app management for Navilux company',
            'start_date' => '2023-11-22',
            'end_date' => '2023-11-27',
        ]);

        Project::create([
            'name' => 'Netflix',
            'description' => 'Create app management for Netflix company',
            'start_date' => '2023-11-28',
            'end_date' => '2023-12-03',
        ]);

        Project::create([
            'name' => 'Script Whatsapp',
            'description' => 'Create app management for Ntx company',
            'start_date' => '2023-11-28',
            'end_date' => '2023-12-03',
        ]);

        Project::create([
            'name' => 'Ai tasks',
            'description' => 'Create application management for web-ai company',
            'start_date' => '2023-12-04',
            'end_date' => '2023-12-10',
        ]);

        Project::create([
            'name' => 'Movies platform',
            'description' => 'Create application management for web-tech company',
            'start_date' => '2023-12-04',
            'end_date' => '2023-12-10',
        ]);
    }
}
