<?php

namespace Domain\Posts\Actions;

use App\Models\Reaction;
use Lorisleiva\Actions\Concerns\AsAction;
class ToggleLikeAction
{
    use AsAction;

    public function  __construct()
    {
        // …
    }

    public function handle($request, $post_id)
    {
        $user_id = $request->user()->id;
        $get_record = Reaction::where('user_id', $user_id)->where('post_id', $post_id)->first();
        if ($get_record === null) {
            $reaction = new Reaction();
            $reaction->user_id = $user_id;
            $reaction->post_id = $post_id;
            $response = $reaction->save();
            return $response ? true : false;
        } else {
            $response = Reaction::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->delete();
            return $response ? true : false;
        }
    }
}
