<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Start using Faker
        $faker = Faker\Factory::create('ja_JP');

        // Create admin user
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('1234'),
            'email_verified_at' => $faker->dateTime(),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ]);
    }
}
