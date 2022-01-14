<?php

namespace Database\Seeders;

use App\Models\Group;
use Database\Factories\GroupFactory;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::factory()->times(3)->create();
    }
}
