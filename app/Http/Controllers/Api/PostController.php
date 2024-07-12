<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        return Post::with('user', 'comments')->get();
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return response()->json($post, 201);
    }
    public function show($id)
    {
        $post = Post::with(['comments', 'user'])->findOrFail($id);
        return view('app.post.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (Gate::denies('update-post', $post)) {
            return redirect()->route('post.show', $id)->withErrors('You are not authorized to edit this post.');
        }

        return view('app.post.editPost', compact('post'));
    }
    public function update(Request $request, Post $post)
    {
        if (Gate::denies('update-post', $post)) {
            return redirect()->route('post.show', $post->id)->withErrors('You are not authorized to update this post.');
        }
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
        ]);
        $post->update($request->only('title', 'body'));
        return response()->json($post);
    }
    public function destroy(Post $post)
    {
        if (Gate::denies('delete-post', $post)) {
            return redirect()->route('post.show', $post->id)->withErrors('You are not authorized to delete this post.');
        }

        $post->delete();
        return response()->json(null, 204);
    }
}