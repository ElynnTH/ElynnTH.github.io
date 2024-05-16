<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Ticket $ticket){
        $comment = new Comment();
        $comment->ticket_id = $ticket->id;
        $comment->user_id = auth()->id();
        $comment->content = request()->get('content');
        $comment->save();

        return redirect()->route('tickets.show',$ticket->id)->with('success',"Comment posted succesfully");

    }
}
