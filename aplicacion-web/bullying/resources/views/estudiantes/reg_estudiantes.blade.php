@extends('layouts.app')

@section('title') Estudiantes @endsection

@section('Head')
{{ __('Estudiantes') }}
@endsection

@section('enlaces')
<a href="{{url('estudiantes')}}" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M4 4h6v8h-6z"></path>
        <path d="M4 16h6v4h-6z"></path>
        <path d="M14 12h6v8h-6z"></path>
        <path d="M14 4h6v4h-6z"></path>
    </svg>Volver al tablero          
</a>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div >

            @if ( session('errors') )
                <div class="alert alert-warning " role="alert">
                    <strong>  {{ session('errors')->first('error') }} 
                    </strong>
                </div>
            @endif

            <div class="card" style="min-width: 280px ">
                <div class="card-header">
                    {{ __('Cargar base de datos por archivo CSV') }}
                </div>
                <div class="card-body card-header">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form  action="{{ url('/estudiantes' )}}" method="POST" enctype="multipart/form-data" >
                        {{ csrf_field() }}          
                        <div class="card-body">
                            <center>
                                <div class="col" >
                                    <label class="form-label" style="color:#001640; font-size:25px">Seleccione el archivo</label>
                                    <input class="form-control form-control-rounded mb-2" type="file" name="file" style="width: 280px">
                                </div>
                                <div class="form-footer">
                                    <hr>
                                    <button type="submit" class="btn btn-primary" style="background-color:#001640; border-radius: 30px; font-size:20px; width: 180px">
                                        Guardar cambios
                                    </button>
                                </div>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection