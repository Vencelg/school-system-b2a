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
        $this->call(SubjectsSeeder::class);
        $this->call(TeachersSeeder::class);
        $this->call(ExercisesSeeder::class);
        $this->call(LecturesSeeder::class);
    }
}
