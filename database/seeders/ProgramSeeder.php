<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $jsonContent = file_get_contents(database_path('/seeders/data/programs.json'));
        $data = json_decode($jsonContent, true);

        foreach ($data['programs'] as $program) {
            $createdProgram = Program::create([
                'name' => $program['name']
            ]);

            if (isset($program['projects']) && is_array($program['projects'])) {
                foreach ($program['projects'] as $project) {
                    Project::create([
                        'name' => $project['name'],
                        'description' => $project['description'],
                        'program_id' => $createdProgram->id,
                    ]);
                }
            }
        }
    }
}
