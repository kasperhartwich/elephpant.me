<?php

namespace Database\Seeders;

use App\Models\Elephpant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'twitter' => 'john',
            'country_code' => 'USA',
            'password' => Hash::make('secret'),
            'mastodon' => '@john@elephpant.me',
        ]);

        User::factory()->count(50)->create();

        Artisan::call('elephpants:read');

        $me = User::find(1);
        $elephpants = Elephpant::inRandomOrder()->limit(15)->get();
        foreach ($elephpants as $elephpant) {
            $me->elephpants()->attach($elephpant->id, ['quantity' => rand(2, 4)]);
        }

        $users = User::inRandomOrder()->where('id', '<>', 1)->limit(rand(10, 15))->get();

        foreach ($users as $user) {
            $elephpants = Elephpant::inRandomOrder()->limit(rand(5, 10))->get();
            foreach ($elephpants as $elephpant) {
                $user->elephpants()->attach($elephpant->id, ['quantity' => rand(1, 3)]);
            }
        }
    }
}
