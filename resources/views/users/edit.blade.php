@extends('adminlte::page')

@section('title', 'User {{ $user->username }}')

@section('content_header')
    <h1 class="m-0 text-dark">
        User Data
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
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->uuid }}</td>
                            <td>{{ $user->registeredAt }}</td>
                            <td class="w-30"> 
                                <a class="btn btn-danger" title="edit" href="">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<h4>User Update</h4>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <form action="{{ route('user.store') }}" method="post">
                    @csrf

                    {{-- UserName field --}}
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Username" autofocus>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    
                    {{-- Password field --}}
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="{{ __('adminlte::adminlte.password') }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    

                    {{-- Register button --}}
                    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                        <span class="fas fa-arrows-rotate"></span>
                        Update
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

@stop