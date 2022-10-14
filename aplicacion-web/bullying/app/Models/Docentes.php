<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docentes extends Model
{
    //use HasFactory;
    //Nos permite el almacenamiento de los datos uno por uno que se encuentrar en un archivo cvs
    public $timestamps = false;
    protected $fillable = ['Matricula', 'Nombre','Apaterno','Amaterno','Contrasenia','email','clave']; 
    public function importDatos(){

        $path = resource_path('doc/*.csv');
        $g = glob($path);
        
        foreach(array_slice($g,0,1) as $file){
            $data = array_map('str_getcsv', file($file));

            foreach($data as $row){
                self::updateOrCreate([
                    'Matricula'=>$row[0]
                ],[
                    'Nombre'=>$row[1],
                    'Apaterno'=>$row[2],
                    'Amaterno'=>$row[3],
                    'Contrasenia'=>$row[4],
                    'email'=>$row[5],
                    'clave'=>$row[6]
                ]
                );
            }
            unlink($file);
        }
    }
}
