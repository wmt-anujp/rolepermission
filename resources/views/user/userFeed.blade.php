@extends('layouts.master2')
@section('title')
    Feed
@endsection
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container px-5 mt-5">
    <div class="row mt-5 justify-content-start">
        @role('editor')
            Editor {{ __('Dashboard')}}
        @endrole
        <h1>Welcome to user Dashboard</h1>
    </div>
    <a href="{{route('logout')}}" class="btn btn-sm btn-danger">Logout</a>
</div>
@endsection