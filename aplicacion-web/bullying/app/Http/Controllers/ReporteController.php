<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reportes = Reporte::all();
        return $reportes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $reporte_temp = new Reporte();
        $reporte_temp->matricula_docente = $request->matricula_docente;
        $reporte_temp->matricula_estudiante = $request->matricula_estudiante;
        $reporte_temp->descripcion = $request->descripcion;
        $reporte_temp->fecha = $request->fecha;
        try{
            $reporte_temp->save();
            return "Guardado con éxito";
        }
        catch(exception $e){
            return "Hubo un problema al guardar los datos, intente más tarde";
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $reporte = Reporte::findOrFail($request->id);
        return $reporte;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Reporte $reporte)
    {
        $reporte = Reporte::destroy($id_reporte=($request->id_reporte));
        if($reporte == 0){
            return "Hubo un error al eliminar el reporte, intente más tarde";
        }else{
            return "Eliminado con éxito";
        }
    }
}
