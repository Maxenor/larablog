<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(1)->create();
        //Category::factory(3)->create();
        $user = User::factory()->create([
            'name' => 'Maxime',
        ]);
        Post::factory(2)->create([
            'user_id' => $user->id,
        ]);
        Post::factory(20)->create();
    }
}
