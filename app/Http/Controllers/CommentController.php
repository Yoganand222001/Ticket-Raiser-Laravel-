<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create($id){
        return view('comments.create', compact('id'));
    }
    public function store(CommentRequest $request, $id){

        Comment::create([
            'title'  => $request->validated('title'),
            'user_id'  => auth()->id(),
            'ticket_id' => $id,
            'comments' => $request->validated('description')
        ]);

        return redirect()->route('ticket.show', $id);
    }
}
