<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        $users = User::all();

        foreach ($users as $user) {
            $numOfCommentsForThisUser = $faker->numberBetween(0, 20);
            for ($i=0; $i < $numOfCommentsForThisUser ; $i++) {
                $comment = new Comment();
                $comment->user_id = $user->id;
                $comment->post_id = Post::all()->random()->id;
                $comment->content = $faker->sentence($faker->numberBetween(5, 20));
                $comment->save();
            }
        }

        foreach ($users as $user) {
            $numOfReplyCommentsForThisUser = $faker->numberBetween(0, 20);
            for ($i=0; $i < $numOfReplyCommentsForThisUser ; $i++) {
                $replyComment = new Comment();
                $replyComment->user_id = $user->id;
                $replyComment->reply_to = Comment::all()->random()->id;
                $replyComment->content = $faker->sentence($faker->numberBetween(5, 20));
                $replyComment->save();
            }
        }
    }
}
