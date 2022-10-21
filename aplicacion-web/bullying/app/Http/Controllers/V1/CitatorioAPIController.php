<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reporte;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Citatorio;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;


class CitatorioAPIController extends Controller
{
    public function store(Request $request){

        //  Filtramos la solicitud y solo tomamos los datos que nos interesan.
        $datos_de_peticion = $request->only('id_docente','id_estudiante','descripcion','fecha');

        //  Realizamos validaciones sobre los datos de la petición
        $validator = Validator::make($datos_de_peticion, [
            'id_docente' => 'required|numeric',
            'id_estudiante' => 'required|numeric',
            'descripcion'  => 'required',
            'fecha' => 'required',
        ]);

        //  Devolvemos un error si fallan las validaciones
        if($validator->fails()){
            return response()->json(['error' => "Algun campo esta incompleto o no tiene el valor apropiado"], 400);
        }

        //  Valido que el estudiante citado y el profesor esten registrados dentro de la misma escuela
        //  Busco en la base de datos si existe el Id de docente
        $profesor_encontrado = DB::table('docentes')->where('id', $request->id_docente)->get();

        if( empty($profesor_encontrado[0]) ){ // Id de profesor invalido
            return response()->json( ['error' => 'id de profesor invalido.' ], 400);
        }

        //  Busco en la base de datos si existe el Id del estudiante
        $estudiante_encontrado = DB::table('estudiantes')->where('id', $request->id_estudiante)->get();
        if( empty($estudiante_encontrado[0]) ){ // Id de estudiante invalido
            return response()->json( ['error' => 'id de estudiante invalido.' ], 400);
        }

        //  Valido que tanto el profesor como el estudiante citado esten registrados en la misma escuela.
        if( $profesor_encontrado[0]->clave != $estudiante_encontrado[0]->clave ){
            return response()->json( ['error' => 'El alumno y el profesor no pertenecen a la misma escuela' ], 400);
        }

        //  Valida que estudiante tenga algun tutor vinculado.
        $tutores_legales_encontrados = DB::table('estudiantes_tutores_legales')->where('id_estudiante', $request->id_estudiante)->get();
        if(  empty($tutores_legales_encontrados[0]) ){ // alumno sin tutores legales asociados
            return response()->json( ['error' => 'El estudiante seleccionado no tiene ningun tutor legal asignado.' ], 400);
        }

        //return response()->json( [ 'error' => $tutores_legales_encontrados ], 400);

        foreach( $tutores_legales_encontrados as $tutor_legal ){

            // Creamos un registro 
            $citatorio_nuevo = new Citatorio();
            $citatorio_nuevo->id_docente = $request->id_docente;
            $citatorio_nuevo->id_estudiante = $request->id_estudiante;
            $citatorio_nuevo->id_tutor_legal = $tutor_legal->id_tutor_legal;
            $citatorio_nuevo->descripcion = $request->descripcion;
            $citatorio_nuevo->fecha = $request->fecha;

            // Intentamos guardar el nuevo registro en la base de datos.
            try{
                $citatorio_nuevo->save();
            } catch(exception $e) {
                return response()->json([
                    'error' => 'ocurrio un error',
                ], 400);
            }

        }  
        
        return response()->json([
            'message' => 'El citatorio se ha creado exitosamente.',
        ], Response::HTTP_OK);

    }
}
