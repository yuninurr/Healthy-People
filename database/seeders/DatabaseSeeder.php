<?php

namespace Database\Seeders;

use App\Models\Frontpage;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        User::create([
            'email' => 'peoplehealthy69@gmail.com',
            'name' => 'Admin Healthi People',
            'password' => bcrypt('1234567890'),
            'role' => 'admin',
        ]);
        Frontpage::create([
            'syarat_vaksin' => '-',

        ]);
    }
}
