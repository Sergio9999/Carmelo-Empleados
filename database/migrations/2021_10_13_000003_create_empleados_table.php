<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('empleado', function (Blueprint $table) {
            
            $table->id()->unsigned();/*esto es para no asignarle numeros negativos*/
            $table->unsignedBigInteger('id_puesto');
            $table->string('nombre', 100); /*no olvidar poner el tipo de dato y el 100 es el valor maximo que puede tener de caracteres*/
            $table->string('apellido' , 200);
            $table->string('email', 150)->unique();
            $table->string('telefono', 15)->unique()->default('999999999');/*se asigna un valor por defecto con el default*/
            $table->date('fecha_contrato')->useCurrent();/*el date se mira en laravel.com para saber que tipo de dato es*/
            $table->timestamps();
            $table->foreign('id_puesto')->references('id')->on('puesto')->onDelete('cascade');/*mi id puesto lo toma de referencia el id que esté en la tabla puesto*/
            
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
