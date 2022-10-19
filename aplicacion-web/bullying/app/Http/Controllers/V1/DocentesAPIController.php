<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Docentes;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class DocentesAPIController extends Controller
{
    protected $user;
    public function __construct(Request $request)
    {
        $token = $request->header('Authorization');
        if($token != '')
            //En caso de que requiera autentifiación la ruta obtenemos el usuario y lo almacenamos en una variable, nosotros no lo utilizaremos.
            $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        //Listamos todos los docentes
        return Docentes::get();
    }

    public function show($clave){
        $docentes = Docentes::where('clave',$clave)->get();
        return $docentes;
    }
}
