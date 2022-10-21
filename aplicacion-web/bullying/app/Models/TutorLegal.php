<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorLegal extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tutores_legales';
    protected $fillable = ['nombre', 'aPaterno','aMaterno'];
}
