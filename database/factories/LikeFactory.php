<?php

namespace Database\Factories;

use App\Models\Tweet;
use App\Models\TweetComments;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $likeable = collect([
            Tweet::inRandomOrder()->first(),
            TweetComments::inRandomOrder()->first()
        ]);

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'likeable_id' => $likeable->random()->id,
            'likeable_type' => $likeable->random()->getMorphClass()
           
        ];
    }
}
