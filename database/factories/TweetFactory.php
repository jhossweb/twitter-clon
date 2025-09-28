<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tweet>
 */
class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tweet_content' => fake()->sentence(),
           // 'tweet_likes' => fake()->randomNumber(2, false),
            'tweet_retweets_count' => fake()->randomNumber(2, false),
            //'comments_count' => fake()->randomNumber(2, false),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
