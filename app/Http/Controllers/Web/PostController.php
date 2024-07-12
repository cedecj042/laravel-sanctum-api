<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    //
    public function loadAllPost()
    {

        $posts = Post::with("comments", 'user')->orderBy('created_at', 'desc')->get();
        return view('app.home', compact('posts'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }
    public function show($id)
    {
        $post = Post::with(['comments', 'user'])->findOrFail($id);

        return view('app.post.show', compact('post'));
    }
    // Display the form for editing the post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (Gate::denies('update-post', $post)) {
            return redirect()->route('post.show', $post->id)->withErrors('You are not authorized to edit this post.');
        }

        return view('app.post.editPost', compact('post'));
    }

    // Handle the update request
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if (Gate::denies('update-post', $post)) {
            return redirect()->route('post.show', $post->id)->withErrors('You are not authorized to update this post.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('post.show', $post->id)->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        if (Gate::denies('delete-post', $post)) {
            return redirect()->route('post.show', $post->id)->withErrors('You are not authorized to delete this post.');
        }
        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully!');
    }

}
