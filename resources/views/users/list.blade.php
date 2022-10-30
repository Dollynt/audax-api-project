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
                          <th>Username</th>
                          <th>Uuid</th>
                          <th>Registered_At</th>
                          <th>Actions</th>
                        </tr>  
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->uuid }}</td>
                                <td>{{ $user->registeredAt }}</td>
                                <td class="w-30">
                                    <a class="btn btn-info" title="edit" href="{{ route('user.edit', $user->uuid) }}">edit</a>
                                    
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@stop