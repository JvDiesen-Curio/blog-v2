<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(post $post)
    {

        $data = request()->validate([
            'content' => ['required', 'min:3', 'max:255']
        ]);

        $data['user_id'] = Auth::user()->id;

        $post->comments()->create($data);

        return redirect()->route('showPost', [$post->id]);
    }

    public function like(comment $comment)
    {
        $comment->like += 1;
        $comment->update();
        return redirect()->route('showPost', $comment->post);
    }

    public function dislike(comment $comment)
    {
        $comment->dislike += 1;
        $comment->update();
        return redirect()->route('showPost', $comment->post);
    }
}
