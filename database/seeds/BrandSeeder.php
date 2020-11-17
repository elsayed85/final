<?php

use App\Models\Cars\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::insert([
            ['name' => 'Volvo'],
            ['name' => 'Volkswagen'],
            ['name' => 'Tesla'],
            ['name' => 'Toyota'],
            ['name' => 'Suzuki'],
            ['name' => 'Rivian'],
            ['name' => 'Mini'],
            ['name' => 'Mercedes'],
            ['name' => 'Jeep'],
            ['name' => 'BMW'],
        ]);
    }
}
