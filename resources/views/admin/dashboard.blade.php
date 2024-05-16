@extends('layout.layout')
@section('title', 'AdminDashboard')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('admin.left-sidebar')
            </div>
            <div class="col-9">
                <h1>Admin Dashborad</h1>
                <div class="row">
                    <dir class="col-sm-6 col-md-4">
                        @include('created.widget',[
                            'title'=> 'Total Users',
                            'icon'=> 'fas fa-user',
                            'data' => $totalUsers,
                        ])
                    </dir>
                    <dir class="col-sm-6 col-md-4">
                        @include('created.widget',[
                            'title'=> 'Total Tickets',
                            'icon'=> 'fas fa-ticket',
                            'data' => $totalTickets,
                        ])
                    </dir>
                    <dir class="col-sm-6 col-md-4">
                        @include('created.widget',[
                            'title'=> 'Total Reply',
                            'icon'=> 'fas fa-comments',
                            'data' => $totalComments,
                        ])
                    </dir>
                    <dir class="col-sm-6 col-md-4">
                        @include('created.widget',[
                            'title'=> 'Active Tickets',
                            'icon'=> 'fas fa-question',
                            'data' => $totalActive,
                        ])
                    </dir>
                    <dir class="col-sm-6 col-md-4">
                        @include('created.widget',[
                            'title'=> 'In-Process Tickets',
                            'icon'=> 'fas fa-spinner',
                            'data' => $totalProcess,
                        ])
                    </dir>
                    <dir class="col-sm-6 col-md-4">
                        @include('created.widget',[
                            'title'=> 'Solve Tickets',
                            'icon'=> 'fas fa-check',
                            'data' => $totalSolve,
                        ])
                    </dir>
                    
                </div>
            </div>

        </div>
    </div>
@endsection
