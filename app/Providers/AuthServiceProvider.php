<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;

use App\Models\Ticket;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('admin', function(User $user) : bool{
            return (bool) $user->is_admin;
        });

        Gate::define('ticket.delete', function(User $user, Ticket $ticket) : bool{
            return ((bool) $user->is_admin || $user->id === $ticket->user_id);
        });

        Gate::define('ticket.edit', function(User $user, Ticket $ticket) : bool{
            return ((bool) $user->is_admin || $user->id === $ticket->user_id);
        });
    }
}
