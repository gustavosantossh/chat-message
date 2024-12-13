<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Contacts;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Contacts::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'test@example.com'
        ]);

        // User::factory()->create(20)->each(function($user){
        //     Contacts::factory(1)->create([
        //         'id_user' => $user->id,
        //         'id_contact' => $user->id,
        //     ]);
        // });
    }
}
