@extends('layouts.app')

@section('title') Docentes @endsection

@section('Head')
{{ __('Docentes') }}
@endsection

@section('enlaces')
<a href="{{route('home')}}" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
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
            <div class="card" style="min-width: 280px ">
                <div class="card-header">
                    {{ __('Listado de docentes') }}
                </div>
                <div class="card-body card-header">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docentes as $docente)
                            <tr>
                                <td >
                                    <button type="submit" class="btn btn-primary w-100" style="background-color:#001640; border-radius: 5px; font-size:12px">
                                        {{$docente -> Matricula }}
                                    </button>
                                </td >
                                <td >{{$docente -> Nombre }} {{$docente -> Apaterno }} {{$docente -> Amaterno }}</td >
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <center>
                        <a href="{{url('docentes/create')}}" class="btn btn-primary d-none d-sm-inline-block" style="background-color:#001640; border-radius: 15px; font-size:20px; width: 180px ">
                             + CSV
                        </a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
