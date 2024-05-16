<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){

        $tickets = Ticket::latest()->paginate(4);
        return view('admin.tickets.index', compact('tickets'));
    }
}
