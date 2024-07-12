<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id();
        $comment->body = $request->body;
        $comment->save();

        return $this->redirectAfterComment($request);
    }

    public function destroy(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
    
        // Check if the authenticated user is either the comment owner or the post owner
        if ($comment->user_id != auth()->id() && $comment->post->user_id != auth()->id()) {
            return redirect()->route('post.show', $$request->post_id)->with('error', 'Unauthorized action.');
        }
    
        $comment->delete();
    
        return $this->redirectAfterComment($request);
    }
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('app.comment.editComment', compact('comment'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->body = $request->body;
        $comment->save();

        return $this->redirectAfterComment($request);
    }
    protected function redirectAfterComment(Request $request)
    {
        if ($request->redirect_to == 'home') {
            return redirect()->route('home')->with('success', 'Comment operation successful!');
        }

        return redirect()->route('post.show', $request->input('post_id'))->with('success', 'Comment operation successful!');
    }

}