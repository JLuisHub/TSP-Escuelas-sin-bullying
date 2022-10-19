@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Area administrativa de directivos') }}
                </div>
                <div class="card-body card-header">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    <div class="form-group mb-3 row">
                        <a href="{{url('docentes')}}" class="btn btn-outline-primary w-100" style="background-color:#001640; border-radius: 15px; font-size:20px; width: 180px; color:white ">Docentes</a>
                    </div>
                    <div class="form-group mb-3 row">   
                        <a href="{{url('estudiantes')}}" class="btn btn-outline-primary w-100" style="background-color:#001640; border-radius: 15px; font-size:20px; width: 180px; color:white ">Estudiantes</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
