<?php

namespace App\Http\Controllers;

use App\Models\post;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index', [
            'posts' => post::orderby('created_at', 'desc')->paginate(6)
        ]);
    }

    public function create()
    {
        return view('post.create');
    }


    public function store()
    {
        $data = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'subject' => ['required', 'min:3', 'max:255', 'unique:posts,subject'],
            'content' => ['required', 'min:3'],
            'image' => ['required', 'image']
        ]);

        $image =  $data['image'];
        unset($data['image']);

        $imageNewFileName = date('YmdHis') . "-" . Auth::user()->id . "." . $image->extension();

        Storage::disk('public')->put($imageNewFileName, $image->get());

        $data['user_id'] = Auth::user()->id;

        $post =  post::create($data);

        $post->attachments()->create([
            'user_id' => Auth::user()->id,
            'path' => 'storage/',
            'filename' => $imageNewFileName
        ]);

        return redirect()->route('post');
    }

    public function show(post $post)
    {
        return view('post.show', [
            'post' => $post
        ]);
    }

    public function edit(post $post)
    {
        return view('post.edit', [
            'post' => $post
        ]);
    }

    public function update(post $post)
    {
        $data = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'subject' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3'],
        ]);

        $post->update($data);

        return redirect()->route('showPost', [$post->id]);
    }

    public function delete(post $post)
    {
        if (!isEmpty($post->comments)) $post->comments->delete();
        if (!isEmpty($post->attachments)) $post->attachments->delete();
        $post->delete();

        return redirect()->route('post');
    }


    public function like(post $post)
    {
        $post->like += 1;
        $post->update();
        return redirect()->route('showPost', $post);
    }

    public function dislike(post $post)
    {
        $post->dislike += 1;
        $post->update();
        return redirect()->route('showPost', $post);
    }
}
