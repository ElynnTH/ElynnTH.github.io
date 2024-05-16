@extends('layout.layout')
@section('title','UserEdit')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('created.left-sidebar')

            </div>
            <div class="col-6">
                @include('created.success-message')
                
                <div class="mt-3">
                    @include('created.user-edit-card')
                    <hr>
                    @forelse($tickets as $ticket)
                        <div class="mt-3">
                            @include('created.ticket')
                        </div>
                    @empty
                        <p class="text-center mt-4">No Result Record.</p>
                    @endforelse
                    <div class="mt-3">
                        {{ $tickets->withQueryString()->links() }}
                    </div>
                </div>

            </div>
            <div class="col-3">
                @include('created.search-bar')
                @include('created.follow-bar')
            </div>
        </div>
    </div>
@endsection
