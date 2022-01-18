<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
  use HasFactory;

    protected $table = 'puesto'; /*siempre sin s y como se llama la tabla*/

    protected $fillable = ['nombre','minimo','maximo']; // ,'idpuesto','iddepartamento',

    public $timestamps = true;
    //protected $attributes = ['fecha_contrato'=>'date:Y-m-d'];
    
    protected $attributes = ['minimo'=>1100];
    public function empleado(){
        return $this->hasMany ('App\Models\Empleado', 'id_puesto');
    }

   
}
