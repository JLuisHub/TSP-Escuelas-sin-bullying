<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class EstudiantesController extends Controller
{
    /**
     * Muestra la vista para que el directivo registre alumnos.
     **/
    public function index()
    {
        // Comprueba si el usuario esta logeado
        if(!Auth::check()){
            return view('auth.login');
        }

        //  Ayuda a almacenar los datos importados anteriormente, haciendo llamando a la función en php.
        (new Estudiantes())->importDatos();

        //  Obtiene los alumnos que ya han sido registrados en la escuela.
        $datos['estudiantes']=DB::table('estudiantes')
        ->where('clave', Auth::user()->clave)
        ->get();

        //  Envia la lista de estudiantes a la vista estudiantes.lista
        return view('estudiantes.lista', $datos);
    }

    /**
     * Muestra la vista donde el directivo selecciona el archivo CSV
     * para registrar a los alumnos.
     */
    public function create()
    {
        //// Comprueba si el usuario esta logeado
        if(!Auth::check()){
            return view('auth.login');
        }

         // Hace llamar al template para registrar estudiantes (get)
        return view('estudiantes.reg_estudiantes');
    }


    /**
     * Nos permite la importación de los datos de un archivo
     */
    public function store(Request $request)
    {
        //  Comprueba si el usuario esta logeado
        if(!Auth::check()){
            return view('auth.login');
        }

        //  Valida que el archivo que selecionó el directivo sea un archivo CSV.
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt',
        ]);

        //  Si el archivo selecionado no es CSV se mostrará un mensaje de error.
        if ($validator->fails()) {
            return back()->withErrors([
                'error'=>
                'El archivo seleccionado no es un archivo con extensión CSV. Por favor, seleciona un archivo nuevamente.'
            ]);
        }

        //  Extrae los datos de los formularios (POST)
        $datosEstudiantes=request()->all();
        $file = file($request->file->getRealPath());
        $data = array_slice($file,1); // Nos permite eliminar la primera linea del archivo

        $mensaje_de_error = validar_estructura_del_archivo($data);

        if( !empty($mensaje_de_error) ){ // El archivo CSV tiene algun error en su estructura
            return back()->withErrors([
                'error' => $mensaje_de_error
            ]);
        }

        //Divide el archivo en partes para su importación
        $parts =(array_chunk($data,1000));

        foreach($parts as $index=>$part){
            $fileName = resource_path('doc_est/'.date('y-m-d-H-i-s').$index.'.csv');
            file_put_contents($fileName,$part);
        }
        
        return redirect('estudiantes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiantes $estudiantes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiantes $estudiantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiantes $estudiantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiantes $estudiantes)
    {
        //
    }
}
