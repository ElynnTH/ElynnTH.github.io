@extends('layout.layout')
@section('title','Terms')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('created.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Terms</h1>
            <div>
                no Terms yet
            </div>
        </div>
        <div class="col-3">
            @include('created.search-bar')
            <!--@include('created.follow-bar')-->

        </div>
    </div>
    @endsection
