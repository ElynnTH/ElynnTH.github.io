<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(){

        if(!Gate::allows('admin')){
            abort(403);
        }

        $totalUsers = User::count();
        $totalTickets = Ticket::count();
        $totalComments = Comment::count();
        $totalActive = Ticket::where('status','active')->count();
        $totalProcess = Ticket::where('status','in-process')->count();
        $totalSolve = Ticket::where('status','solved')->count();

        return view('admin.dashboard', 
        compact('totalUsers','totalTickets','totalActive','totalActive','totalComments','totalProcess','totalSolve'));
    }
}
