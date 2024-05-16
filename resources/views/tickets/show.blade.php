
@extends('layout.layout') 
@section('title','Tickets')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('created.left-sidebar')

            </div>
            <div class="col-6">
                @include('created.success-message')
                <hr>
                <div class="mt-3">                
                    @include('created.ticket')
                </div>
                <hr>
                
            </div>
            <div class="col-3">
                @include('created.search-bar')
                @include('created.follow-bar')
            </div>
        </div>
    </div>
    @endsection
