@extends('layouts.app')

@section('title') Login - Escuelas sin bullying @endsection

@section('Head')
{{ __('Iniciar sesión') }}
@endsection

@section('content')

<div class="center">
    <h1 style="text-align: center;"> Lista de alumnos </h1>
</div>

<style>

.center_btn{
    display: flex;
    justify-content: center;
}

</style>

<div class="m-4">
 
    <table class="table">
 
        <thead class="table-secundary">
 
            <tr>
 
                <th>Matrícula</th>
 
                <th>Nombre completo</th>

                <th></th>

            </tr>
 
        </thead>
 
        <tbody>
 
            <tr>
 
                <td>39203880</td>
 
                <td>Juan Fransico Navarro Ambriz</td>

                <td class="center_btn " > <button class="btn btn-warning"> report </button> </td>
 
            </tr>
 
            <tr>
 
                <td>2</td>
 
                <td>February</td>

                <td class="center_btn " > <button class="btn btn-warning"> report </button> </td>

 
            </tr>
 
            <tr>
 
                <td>3</td>
 
                <td>March</td>

                <td class="center_btn "> <button class="btn btn-warning"> report </button> </td>
 
            </tr>
 
            
        </tbody>
 
    </table>
 
</div>

@endsection
