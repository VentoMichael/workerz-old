<?php

namespace Database\Seeders;

use App\Models\PhysicalAdress;
use Illuminate\Database\Seeder;

class PhysicalAdressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PhysicalAdress::factory()->count(100)->create();
    }
}
