<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class UserController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //$tickets = $user->tickets()->paginate(5);
        $tickets = auth()->user()->tickets()->paginate(5);
        return view('users.show', compact('user', 'tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        $editing = true;
        $tickets = $user->tickets()->paginate(5);
        return view('users.edit', compact('user', 'editing', 'tickets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $this->authorize('update',$user);

        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:40',
                'bio' => 'nullable|min:1|max:240',
                'image' => 'image'
            ]
        );

        if(request()->has('image')){
            $imagePath = request()->file('image')->store('profile','public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image);
        }

        $user->update($validated);

        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }
}
