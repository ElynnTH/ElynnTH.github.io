<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(){

        //if(!Gate::allows('admin')){
        //    abort(403);
        //}
        $users = User::latest()->paginate(4);
        return view('admin.users.index', compact('users'));
    }
}
