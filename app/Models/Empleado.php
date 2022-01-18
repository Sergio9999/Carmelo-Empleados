<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
   use HasFactory;

    protected $table = 'empleado'; /*siempre sin s y como se llama la tabla*/

    protected $fillable = ['nombre', 'apellido', 'email', 'telefono','fecha_contrato','id_departamento','id_puesto']; // ,'idpuesto','iddepartamento',

    public $timestamps = true;
    //protected $attributes = ['fecha_contrato'=>'date:Y-m-d'];

    public function puesto(){
       return $this->belongsTo ('App\Models\Puesto', 'id_puesto');
   }

     public function departamento(){
       return $this->belongsTo ('App\Models\Departamento', 'id_departamento');
   }
}
