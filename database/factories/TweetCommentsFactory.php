<?php

namespace Database\Factories;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TweetComments>
 */
class TweetCommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "comment_content" => fake()->sentence(),
            //"comment_likes" => fake()->randomNumber(2, false),
            "user_id" => User::inRandomOrder()->first()->id,
            "tweet_id" => Tweet::inRandomOrder()->first()->id,
            'parent_id' => null
        ];
    }
}
