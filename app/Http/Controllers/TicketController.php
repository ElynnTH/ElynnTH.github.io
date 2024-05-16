<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    public function show(Ticket $ticket){

        

        return view('tickets.show',compact('ticket'));
    }

    public function edit(Ticket $ticket){

        if(!Gate::allows('ticket.edit', $ticket)){
            abort(403);
        }
        
        $editing = true;
        

        return view('tickets.show',compact('ticket','editing'));
    }

    public function update(Ticket $ticket){

        if(!Gate::allows('ticket.edit', $ticket)){
            abort(403);
        }

        request()->validate([
            'content' => 'required|min:5|max:240',
            'title' => 'nullable|min:5|max:240',
            'status' => 'required',
            
        ]);

        $ticket->content = request()->get('content','');
        $ticket->title = request()->get('title','');
        $ticket->status = request()->get('status');
        $ticket->save();

        return redirect()->route('tickets.show',$ticket->id)->with('success',"Ticket update successfully");
    }



    public function store(Request $request){
        
        
        $validated = $request->validate([
            'content' => ['required', 'min:5', 'max:240', 'regex:/^[a-zA-Z0-9\s\-_.,!"\'@#$%&*()]+$/'],
            'title' => 'nullable|min:5|max:240',
            'urgent' => ['required', Rule::in(['low', 'medium', 'high'])],
            
            
        ]);

        $validated['user_id'] = auth()->id();

        Ticket::create($validated);
        
        return redirect()-> route('dashboard')->with('success','Ticket created successfully!');
    }

    public function destroy(Ticket $ticket){
        //$idticket
        if(!Gate::allows('ticket.delete', $ticket)){
            abort(403);
        }
        /*$ticket = Ticket::findOrFail($idticket);*/
        $ticket->delete();

        return redirect()-> route('dashboard')->with('success','Ticket deleted successfully!');
    }
}
