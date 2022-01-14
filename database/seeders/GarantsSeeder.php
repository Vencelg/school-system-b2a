<?php

namespace Database\Seeders;

use App\Models\Garant;
use Illuminate\Database\Seeder;

class GarantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Garant::factory()->times(4)->create();

    }
}
