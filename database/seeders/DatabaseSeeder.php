<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupsSeeder::class);
        $this->call(StudentsSeeder::class);
        $this->call(TeachersSeeder::class);
        $this->call(SubjectsSeeder::class);
        $this->call(ExercisesSeeder::class);
        $this->call(LecturesSeeder::class);
        $this->call(PrerequisitesSeeder::class);
        $this->call(GroupStudentSeeder::class);
    }
}
