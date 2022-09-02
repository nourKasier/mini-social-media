<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionSeeder extends Seeder
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
            $numOfReactionsForThisUser = $faker->numberBetween(0, 5);
            for ($i=0; $i < $numOfReactionsForThisUser ; $i++) {
                $reaction = new Reaction();
                $reaction->user_id = $user->id;
                $reaction->post_id = Post::all()->random()->id;
                $reaction->save();
            }
        }
    }
}
