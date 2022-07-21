@extends('layouts.master2')
@section('title')
   Admin Dashboard
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mt-4">
                <h3 style="color: green">Users List</h3>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-md-12 mt-2 table-responsive justify-content-center">
                <table class="table border border-2 border-dark" id="usertable">
                    <thead>
                    <tr class="text-center">
                        <th>id</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    {{-- <tbody class="text-center"> --}}
                        {{-- @foreach ($users as $user)
                            <tr class="border">
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <input data-user="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $user->active_status ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @endforeach --}}
                    {{-- </tbody> --}}
                </table>
            </div>
        </div>
    </div>
@endsection