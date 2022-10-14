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

        //  Validamos que el archivo contenga 7 columnas 
        $contiene_7_cols = true;
        //  Validamos que la clave del archivo CSV sea congruente con la clave del director que sube el CSV
        //  es decir, que la clave de la escuela del director sea igual que la clave de los docentes registrados por CSV
        $es_la_clave_congruente = true;

        $numero_renglon = 2;
        $clave_erronea = "";

        foreach( $data as $renglon_actual ){

            // Divido el renglón acutal por ,
            // Esto para obtener las columnas de la fila del archivo CSV.
            $renglon_dividido = explode(",",$renglon_actual);

            foreach( $renglon_dividido as $parte_del_renglon ){
                if( empty(trim($parte_del_renglon)) ){
                    $contiene_7_cols = false;
                    break;
                }
            }

            if( $contiene_7_cols == false ){
                break;
            }

            if(  trim($renglon_dividido[6]) != strval(Auth::user()->clave)  ){ 
                $es_la_clave_congruente = false;
                $clave_erronea = $renglon_dividido[6];
                break;
            }

            $numero_renglon = $numero_renglon + 1;
        }

        if( $contiene_7_cols == false ){
            return back()->withErrors([
                'error'=>
                'En la fila ' . $numero_renglon . ' del archivo CSV falta 1 o más columnas.'
            ]);
        }

        if( $es_la_clave_congruente == false ){
            if( empty(trim($clave_erronea)) ){
                $clave_erronea = "Columna vacía";
            }
            return back()->withErrors([
                'error'=>
                'En la fila ' . $numero_renglon . ' del archivo CSV la clave de institución 
                no es congruente con la clave de tu institución. Tu clave es :' . Auth::user()->clave . ' la clave en el archivo CSV es '
                . $clave_erronea
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