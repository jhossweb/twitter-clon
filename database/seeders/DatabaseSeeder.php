<?php

namespace Database\Seeders;

use App\Models\Followers;
use App\Models\Image;
use App\Models\Like;
use App\Models\Tweet;
use App\Models\TweetComments;
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
        $count = 0;
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            ]);
            
        
        // ========== Usuarios e images ==========
        User::factory(5)->create()->each(function ($user) {
            Image::factory()->create([
               
                'imageable_id' => $user->id,
                'imageable_type' => User::class 
            ]);
        });


        // ========== Seguidores ==========
        while ($count < 10) {
            $data = Followers::factory()->make()->toArray();

            // Evita duplicados y autoseguimiento
            if ($data['follower_id'] !== $data['followin_id'] &&
                !Followers::where($data)->exists()) {
                Followers::create($data);
                $count++;
            }
        }


        // ========== Tweets e images ==========
        Tweet::factory(200)->create()->each( function ($tweet) {
            Image::factory(5)->create([
                'imageable_id' => $tweet->id,
                'imageable_type' => Tweet::class
            ]);

        } );



        // ========== Comentarios ==========
        $comments = TweetComments::factory(20)->create();


        // ========== Comentarios e images ==========
        foreach($comments->take(15) as $parentCmment) {
            TweetComments::factory()->create([
                'tweet_id' => $parentCmment->tweet_id,
                'user_id' => User::inRandomOrder()->first()->id,
                'parent_id' => $parentCmment->id,
                
            ])->each( function ($comment) {
                Image::factory()->create([
                    'imageable_id' => $comment->id,
                    'imageable_type' => TweetComments::class
                ]);
            } );
        }


        // ========== Likes ==========
        Like::factory(15)->create();

    }
}
