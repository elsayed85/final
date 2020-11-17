<?php

use App\Models\Cars\Brand;
use App\Models\Cars\Car;
use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment("local")) {
            DB::statement("SET foreign_key_checks=0");
            $databaseName = DB::getDatabaseName();
            $tables = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = '$databaseName'");
            foreach ($tables as $table) {
                $name = $table->TABLE_NAME;
                if ($name == 'migrations') {
                    continue;
                }
                DB::table($name)->truncate();
            }
            DB::statement("SET foreign_key_checks=1");

            $this->call([
                RolesSeeder::class,
                BrandSeeder::class
            ]);

            User::create([
                'name' => "test user",
                'password' => Hash::make("password"),
                'email' =>  "elsayed@gmail.com",
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'phone' => "01092291556",
                'geneder' => "m",
                'birthdate' => now()->subYears(rand(10, 30))
            ])->assignRole("client");

            factory(User::class, 5)->create();
            factory(Car::class, 300)->create();
        }
    }
}
