<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reaction;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'picture',
    ];

    public function reactions() {
        return $this->hasMany(Reaction::class);
    } // Getting reactions of post

    public function comments() {
        return $this->hasMany(Comment::class);
    } // Getting comments of post

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function isAuthUserLikedPost(){
        return $this->reactions()->where('user_id',  auth()->id())->exists();
     }

}
