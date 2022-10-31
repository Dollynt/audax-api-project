@extends('adminlte::page')

@section('title', 'User {{ $user->username }}')

@section('content_header')
    <h1 class="m-0 text-dark">
        User Update
    </h1>
@stop

@section('content')


<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
            @if ($errors->any())
                <ul class="errors">
                    @foreach ($errors->all() as $error)
                        <li class="error">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('user.update', $user->uuid) }}" method="post">
                    @method('PUT')
                    @csrf

                    @if(Session::has('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    {{-- UserName field --}}
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-border" name="username" id="username" value="{{ $user->username }}" placeholder="username">
                        </div>
                    </div>

                    {{-- Password field --}}
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-border" name="password" id="password"  placeholder="password">
                        </div>
                    </div>

                    {{-- Uuid field --}}
                    <div class="form-group row">
                        <label for="uuid" class="col-sm-2 col-form-label">Uuid</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-border" name="uuid" id="uuid" value="{{ $user->uuid }}" placeholder="uuid" disabled>
                        </div>
                    </div>

                    {{-- RegisteredAt field --}}
                    <div class="form-group row">
                        <label for="registeredAt" class="col-sm-2 col-form-label">RegisteredAt</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-border" name="registeredAt" id="registeredAt" value="{{ $user->registeredAt }}" placeholder="registeredAt" disabled>
                        </div>
                    </div>


                    {{-- Register button --}}
                    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                        <span class="fas fa-arrows-rotate"></span>
                        Update
                    </button>
                    
                    
                    
                    
                    
                </form>
                @if($user_article == false)
                <form action="{{ route('user.delete', $user->uuid) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                        <span class="fas fa-arrows-rotate"></span>
                        Delete
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

@stop