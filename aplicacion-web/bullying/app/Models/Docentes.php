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
                    'Matricula'=>rtrim(ltrim($row[0]))
                ],[
                    'Nombre'=>rtrim(ltrim($row[1])),
                    'Apaterno'=>rtrim(ltrim($row[2])),
                    'Amaterno'=>rtrim(ltrim($row[3])),
                    'Contrasenia'=>rtrim(ltrim($row[4])),
                    'email'=>rtrim(ltrim($row[5])),
                    'clave'=>rtrim(ltrim($row[6]))
                ]
                );
            }
            unlink($file);
        }
    }
}
