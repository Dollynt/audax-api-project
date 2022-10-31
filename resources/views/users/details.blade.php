@extends('adminlte::page')

@section('title', 'Users List')

@section('content_header')
    <h1 class="m-0 text-dark">
        Users List
    </h1>
@stop

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>  
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td class="w-30">
                                    <a class="btn btn-info" title="user_edit" href ="">Edit User</a>
                                </td>
                                <td class="w-30">
                                    <a class="btn btn-info" title="user_details" href="{{ route('user.details', $data->uuid) }}">User Details</a>
                                </td>
                            @empty
                            @endforelse
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@stop