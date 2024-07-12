<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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
    
        if (Gate::denies('delete-comment', $comment)) {
            return $this->redirectAfterComment($request);
        }
        $comment->delete();
    
        return $this->redirectAfterComment($request);
    }
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        if (Gate::denies('update-comment', $comment)) {
            return redirect()->route('post.show', $comment->post_id)->withErrors('You are not authorized to edit this comment.');
        }
        
        return view('app.comment.editComment', compact('comment'));
    }
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        if (Gate::denies('update-comment', $comment)) {
            return redirect()->route('post.show', $comment->post_id)->withErrors('You are not authorized to update this comment.');
        }
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