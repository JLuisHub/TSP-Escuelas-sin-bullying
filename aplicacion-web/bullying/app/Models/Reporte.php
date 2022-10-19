<?php

namespace App\Models;

#use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    #use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_reporte','id_docente', 'id_estudiante','clave_institucion', 'descripcion', 'fecha'];
}