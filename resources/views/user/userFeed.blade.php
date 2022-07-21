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
        <p>Welcome to user Dashboard</p>
    </div>
</div>
@endsection