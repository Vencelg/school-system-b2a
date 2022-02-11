<?php

namespace Database\Seeders;

use Faker\Provider\es_PE\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $data = [
                'group_id' => $i,
                'student_id' => $i
            ];

            DB::table('group_student')->insert($data);
        }
    }
}
