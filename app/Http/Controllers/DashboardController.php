<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index () {

        $tickets = Ticket::orderBy('created_at','DESC');
        //check searching
        if(request()->has('search')){
            $tickets = $tickets->search(request('search', ''));
        }        

        return view('dashboard',[
            'tickets' => $tickets->paginate(5)
        ]);
    }
}
