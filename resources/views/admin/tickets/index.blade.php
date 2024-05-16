@extends('layout.layout')
@section('title','Tickets | AdminDashboard')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('admin.left-sidebar')
            </div>
            <div class="col-9">
                <h1>Users</h1>
                <table class="table table-striped mt-3">
                    <thead class="table-success">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Title</th>
                            <th>Urgent</th>
                            <th>Status</th>
                            <th>Create At</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr>
                            <th style="color:crimson">{{ $ticket->id}}</th>
                            <th><a href="{{ route('users.show', $ticket->user)}}">{{ $ticket->user->name}}</a></th>
                            <th style="color:crimson">{{ $ticket->title}}</th>
                            <th style="color:crimson">{{ $ticket->urgent}}</th>
                            <th style="text-transform: uppercase; color:crimson;">{{ $ticket->status}}</th>
                            <th style="color:crimson">{{ $ticket->created_at->toDateString()}}</th>
                            <th>
                                <a href="{{ route('tickets.show',$ticket)}}">View</a>
                                <a href="{{ route('tickets.edit',$ticket)}}">Edit</a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $tickets->links() }}
                </div>
            </div>
            
        </div>
    </div>
@endsection
