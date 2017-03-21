@extends('layouts.admin')

@section('content')
    <h2>Manage Users</h2>
    <div class="row">
        <div class="col-md-12">
            <table class="table responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>@if($user->is_admin == 1)<i class="entypo-check"></i>@endif</td>
                        <td><a href="{{ url('users/edit/'.$user->id) }}"><i class="entypo-pencil"></i></a></td>
                        <td><a href="{{ url('users/delete/'.$user->id) }}" onclick="return confirm('Are you sure you want to delete this user?')"><i class="entypo-trash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 pull-right">
            <a href="{{ url('users/create') }}" class="btn btn-green btn-icon btn-lg">
                Add User
                <i class="entypo-plus"></i>
            </a>
        </div>
    </div>
@endsection