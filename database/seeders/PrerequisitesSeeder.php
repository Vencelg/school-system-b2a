<?php

namespace Database\Seeders;

use App\Models\Prerequisite;
use Illuminate\Database\Seeder;

class PrerequisitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prerequisite::factory()->times(5)->create();

    }
}
