@extends('layout.layout')
@section('title','Users | AdminDashboard')
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Create At</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th style="color:crimson">{{ $user->id}}</th>
                            <th style="color:crimson">{{ $user->name}}</th>
                            <th style="color:crimson">{{ $user->email}}</th>
                            <th style="color:crimson">{{ $user->created_at->toDateString()}}</th>
                            <th>
                                <a href="{{ route('users.show',$user)}}">View</a>
                                <a href="{{ route('users.edit',$user)}}">Edit</a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
            
        </div>
    </div>
@endsection
