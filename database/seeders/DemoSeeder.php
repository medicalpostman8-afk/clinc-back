<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->create();

        User::factory()
            ->count(10)
            ->unverified()
            ->create();

        Page::factory(5)->create();

        $this->call([
            BannerSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
