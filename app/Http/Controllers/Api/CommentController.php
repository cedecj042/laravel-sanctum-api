<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
        ]);
        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);
        return response()->json($comment, 201);
    }
    public function update(Request $request, Comment $comment)
    {
        if (Gate::denies('update-comment', $comment)) {
            return redirect()->route('post.show', $comment->post_id)->withErrors('You are not authorized to update this comment.');
        }
        $request->validate([
            'body' => 'sometimes|string',
        ]);
        $comment->update($request->only('body'));
        return response()->json($comment);
    }
    public function destroy(Comment $comment)
    {
        if (Gate::denies('delete-comment', $comment)) {
            return redirect()->route('post.show', $comment->post_id)->withErrors('You are not authorized to update this comment.');
        }
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        if (Gate::denies('update-comment', $comment)) {
            return redirect()->route('post.show', $comment->post_id)->withErrors('You are not authorized to edit this comment.');
        }

        return view('app.comment.editComment', compact('comment'));
    }
}