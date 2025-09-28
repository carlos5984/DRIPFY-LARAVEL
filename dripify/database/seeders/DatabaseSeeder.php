<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Nonstandard\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([

            'id' =>Uuid::uuid4()->toString(),
            'name' => 'jorge',
            'email' => 'jorge@email.com',
            'password' => 'password',
        ]);
    }
}
