<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Followers>
 */
class FollowersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $follower = User::inRandomOrder()->first();
        $followin = User::where('id', '<>', $follower->id)->inRandomOrder()->first();
        

        return [
            'follower_id' => $follower->id,
            'followin_id' => $followin->id,
        ];
    }
}
