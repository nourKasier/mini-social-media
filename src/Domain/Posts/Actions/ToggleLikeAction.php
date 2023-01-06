<?php

namespace Domain\Posts\Actions;

use App\Models\Reaction;
use Lorisleiva\Actions\Concerns\AsAction;

class ToggleLikeAction
{
    use AsAction;

    protected $reaction;

    public function  __construct(Reaction $reaction)
    {
        $this->reaction = $reaction;
    }

    public function handle($reactionData)
    {
        $user_id = $reactionData['user_id'];
        $post_id = $reactionData['post_id'];
        $get_record = Reaction::where('user_id', $user_id)->where('post_id', $post_id)->first();
        if ($get_record === null) {
            $this->reaction->user_id = $user_id;
            $this->reaction->post_id = $post_id;
            $response = $this->reaction->save();
            return $response ? response()->json(['status' => 'success']) : response()->json(['status' => 'error']);
        } else {
            $response = Reaction::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->delete();
            return $response ? response()->json(['status' => 'success']) : response()->json(['status' => 'error']);
        }
    }
}
