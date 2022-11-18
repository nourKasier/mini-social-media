<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use Application\Posts\Controllers\PostController;
use Illuminate\Http\UploadedFile;

//--views--
it('can render the posts page', function() {
    $this
        ->get('/posts')
        ->assertSee('Logo');
    $post1 = Post::factory()->create();
    $post2 = Post::factory()->create();
    $posts = [$post1 , $post2];
    $view = $this->view('user.home', ['posts' => $posts]);
    $view->assertSee($post1->title);
});

it('can render the create post page', function() {
    $this
        ->get('/createPostPage')
        ->assertRedirect('login');

    $user = User::factory()->create();
    $this
        ->actingAs($user);

    $this
        ->get('/createPostPage')
        ->assertSee('Post title:');
});

it('can render the comment page', function() {
    $user = User::factory()->create();
    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['post_id' => $post->id, 'content' => 'test comment content']);
    $this
        ->get('/posts/'.$post->id.'/comments')
        ->assertRedirect('login');

    $this
        ->actingAs($user);

    $this
        ->get('/posts/'.$post->id.'/comments')
        ->assertSee('Leave a comment')
        ->assertSee($comment->content);
});

it('can render the reply page', function() {
    $user = User::factory()->create();
    $post = Post::factory()->create();
    //$comment = Comment::factory()->create(['post_id' => $post->id]);
    $comment1 = Comment::factory()->create(['post_id' => $post->id, 'content' => 'test comment content']);
    $comment2 = Comment::factory()->create(['user_id' => $user->id, 'post_id' => null, 'reply_to' => $comment1->id, 'content' => 'test reply comment content']);
    $this
        ->get('/posts/'.$post->id.'/comments/'.$comment1->id)
        ->assertRedirect('login');

    $this
        ->actingAs($user);

    $this
        ->get('/posts/'.$post->id.'/comments/'.$comment1->id)
        ->assertSee('Leave a reply')
        ->assertSee($comment2->content);
});

it('can render the edit post page', function() {
    $post = Post::factory()->create();
    $this
        ->get('/posts/'.$post->id.'/edit')
        ->assertRedirect('login');

    $user = User::factory()->create();
    $this
        ->actingAs($user);
    $this
        ->get('/posts/'.$post->id.'/edit')
        ->assertSee('Post title:')
        ->assertSee($post->title);
});


//--posts--
it('can create new post', function() {
    $user = User::factory()->create();
    $this->actingAs($user);
    $file = UploadedFile::fake()->image('test.jpeg');

    $this
        ->post(action([PostController::class,'store']), [
            'user_id'=>$user->id,
            'title'=>'my title',
            'content'=>'my content',
            'picture'=>$file,
            ])->assertSessionHasNoErrors();
});

it('can edit post', function() {
    //Given we have a signed in user
    $user = User::factory()->create();
    $this->actingAs($user);
    //And a post which is created by the user
    $post = Post::factory()->create(['user_id' => $user->id]);
    $post->title = "Updated Title";
    //When the user hit's the endpoint to update the post
    $this->put('/posts/'.$post->id, $post->toArray());
    //The post should be updated in the database.
    $this->assertDatabaseHas('posts',['id'=> $post->id , 'title' => 'Updated Title']);
});

it('can not edit post because user is not authorized to update this post', function() {
    //Given we have a signed in user
    $user = User::factory()->create();
    $this->actingAs($user);
    //And a post which is not created by the user
    $post = Post::factory()->create();
    $post->title = "Updated Title";
    //When the user hit's the endpoint to update the post
    $response = $this->put('/posts/'.$post->id, $post->toArray());
    //We should expect a 403 error
    $response->assertStatus(403);
});

it('can delete a post', function() {
    //Given we have a signed in user
    $user = User::factory()->create();
    $this->actingAs($user);
    //And a post which is created by the user
    $post = Post::factory()->create(['user_id' => $user->id]);
    //When the user hit's the endpoint to delete the post
    $this->delete('/posts/'.$post->id);
    //The post should be deleted from the database.
    $this->assertDatabaseMissing('posts',['id'=> $post->id]);
});

it('can not delete a post if user not authorized', function() {
    //Given we have a signed in user
    $user = User::factory()->create();
    $this->actingAs($user);
    //And a post which is created by the user
    $post = Post::factory()->create();
    //When the user hit's the endpoint to delete the post
    $this->delete('/posts/'.$post->id);
    //The post should be deleted from the database.
    $this->assertDatabaseHas('posts',['id'=> $post->id]);
});

//--comments--
it('can create new comment', function() {
    $user = User::factory()->create();
    $this->actingAs($user);
    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['user_id' => $user->id, 'post_id' => $post->id, 'content' => 'test comment content']);
    $this->post('/posts/'.$post->id.'/comments');
    $this->assertDatabaseHas('comments',['id'=> $comment->id, 'user_id'=> $user->id, 'post_id' => $post->id, 'content' => 'test comment content']);
});

it('can create new reply to a comment', function() {
    $user = User::factory()->create();
    $this->actingAs($user);
    $post = Post::factory()->create();
    $comment1 = Comment::factory()->create(['user_id' => $user->id, 'post_id' => $post->id, 'content' => 'test comment content']);
    $comment2 = Comment::factory()->create(['user_id' => $user->id, 'post_id' => null, 'reply_to' => $comment1->id, 'content' => 'test reply comment content']);
    $this->post('/posts/'.$post->id.'/comments/'.$comment1->id);
    $this->assertDatabaseHas('comments',['id'=> $comment2->id, 'user_id'=> $user->id, 'reply_to' => $comment1->id, 'content' => 'test reply comment content']);
});

//--reactions--
it('can toggle the like on a post', function() {
    $user = User::factory()->create();
    $post = Post::factory()->create();
    $reaction = Reaction::factory()->create(['user_id'=>$user->id, 'post_id'=>$post->id]);
    $this->actingAs($user);
    $this->post('/posts/'.$post->id)->assertSessionHasNoErrors();
    //$this->assertDatabaseHas('reactions',['id'=> $reaction->id,'user_id'=>$user->id,'post_id'=>$post->id]);
});
