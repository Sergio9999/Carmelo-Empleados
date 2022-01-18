<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamento'; /*siempre sin s y como se llama la tabla*/

    protected $fillable = ['nombre','localizacion','id_empleado_jefe']; // ,'idpuesto','iddepartamento',

    public $timestamps = true;
    //protected $attributes = ['fecha_contrato'=>'date:Y-m-d'];

    public function empleado(){
        return $this->belongsTo('App\Models\Empleado', 'id_empleado_jefe');
    }
}
