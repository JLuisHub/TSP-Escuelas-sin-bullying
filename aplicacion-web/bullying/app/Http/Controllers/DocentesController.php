<?php

namespace App\Http\Controllers;

use App\Models\Docentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DocentesController extends Controller
{
    /**
     * Muestra la vista para que el directivo registre docentes.
     */
    public function index()
    {
        // Comprueba si el usuario esta logeado
        if(!Auth::check()){
            return view('auth.login');
        }

        //Ayuda a almacenar los datos importados anteriormente, haciendo llamando a la función en php.
        (new Docentes())->importDatos();

        //  Obtiene los docentes que ya han sido registrados en la escuela.
        $datos['docentes'] = DB::table('docentes')
        ->where('clave', Auth::user()->clave)
        ->get();
        
        // Envia la lista de docentes a la vista docentes.lista
        return view('docentes.lista', $datos);
    }

    /**
     * Muestra la vista donde el directivo selecciona el archivo CSV
     * para registrar a los docentes.
     */
    public function create()
    {
        // Comprueba si el usuario esta logeado
        if(!Auth::check()){
            return view('auth.login');
        }

        // Hace llamar al template para registrar docentes
        return view('docentes.reg_docentes');
    }


    /**
     * Nos permite la importación de los datos de un archivo
     **/
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

        $file = file($request->file->getRealPath()); 
        $data = array_slice($file,1); // Nos permite eliminar la primera linea del archivo

        $mensaje_de_error = validar_estructura_del_archivo($data);

        if( !empty($mensaje_de_error) ){ // El archivo CSV tiene algun error en su estructura
            return back()->withErrors([
                'error' => $mensaje_de_error
            ]);
        }

        $parts =(array_chunk($data,1000)); 
        foreach($parts as $index=>$part){
            $fileName = resource_path('doc/'.date('y-m-d-H-i-s').$index.'.csv');
            file_put_contents($fileName,$part);
        }

        return redirect('docentes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function show(Docentes $docentes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function edit(Docentes $docentes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docentes $docentes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docentes $docentes)
    {
        //
    }
}
