<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'reply_to',
        'content',
    ];

    public function commments() {
        return $this->hasMany(Comment::class);
    } // Getting comments of comment

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function comment() {
        return $this->belongsTo(Comment::class);
    }

}
