<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => 1,
        ]);

        return redirect()->back();

       /*  $post = Post::find( $request->post_id);
        $post->comment()->create([
            'body' => $request->body,
            'user_id' => $request->user_id,
        ]); */
    } 
}
