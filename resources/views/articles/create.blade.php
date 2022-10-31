@extends('adminlte::page')

@section('title', 'Article Create')

@section('content_header')
    <h1 class="m-0 text-dark">
        Create Article
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

            <form action="{{ route('article.store') }}" method="post">
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

                    {{-- Title field --}}
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-border" name="title" id="title" placeholder="Title">
                        </div>
                    </div>

                    {{-- Resume field --}}
                    <div class="form-group row">
                        <label for="resume" class="col-sm-2 col-form-label">Resume</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-border" name="resume" id="resume"  placeholder="Resume">
                        </div>
                    </div>

                    {{-- Text field --}}
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Text</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-border" name="text" id="text" placeholder="Text">
                        </div>
                    </div>



                    {{-- Create button --}}
                    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                        <span class="fas fa-arrows-rotate"></span>
                        Create
                    </button>
                    
                    
                    
                    
                    
                </form>
                
            </div>
        </div>
    </div>
</div>

@stop