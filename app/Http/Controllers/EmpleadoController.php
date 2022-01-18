<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamento;
use App\Models\Puesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['empleados']=Empleado::all(); /*cogemos el contenido de departamentos que exista en la base de datos y se lo enviamos a la vista*/
         $data['puestos']=Puesto::all();
         $data['departamentos']=Departamento::all();
         $nulos=false;
         
         //true
         $departamento=empty(Departamento::all()->modelKeys());
         //true
         $puesto=empty(Puesto::all()->modelKeys());
            if($departamento || $puesto){
                $nulos = true;
            }
            $data['nulos']=$nulos;
          
        return view('empleado.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
        
        
        
        
        
        
        
        
        
          $data['departamentos']=Departamento::all();
           $data['puestos']=Puesto::all();
        return view('empleado.create',$data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=
            [
                "nombre" => "required|min:2|max:250|string|alpha",
                "apellido" => "required|min:3|max:250|string|alpha",
                "email"=> "required|email:rfc|unique:empleado,email",
                "telefono"=> "required|size:9|unique:empleado,telefono",
                "fecha_contrato"=> "required|date_format:Y-m-d|before:tomorrow",
                "id_puesto"=> "required|exists:puesto,id",
                "id_departamento"=> "required|exists:departamento,id",
            ];
        
        $message=[
                'nombre.required' =>'El nombre es requerido',
                'nombre.min' =>'El nombre debe de tener más de dos caracteres',
                'nombre.max' =>'Este nombre es muy largo',
                'nombre.string' =>'El nombre debe de ser un string',
                'nombre.alpha' =>'El nombre no puede contener números',
                

                'apellido.required' =>'Los Apellidos son requerido',
                'apellido.min' =>'Los Apellidos deben de tener más de 3 caracteres',
                'apellido.max' =>'Los Apellidos son muy largo',
                'apellido.string' =>'Los Apellidos deben de ser un string',
                'apellido.alpha' =>'El apellido no puede contener números',

                'email.required' =>'El Email es requerida',
                'email.email' =>'El Email es incorrecto',
                'email.unique' =>'Este Email ya esta ocupado',

                'telefono.required' =>'El telefono es requerida',
                'telefono.size' =>'El telefono debe de tener 6 caracteres',
                'telefono.unique' =>'Este Telefono ya esta ocupado',

                'fecha_contrato.required'=>'La fecha de contrato es requerida',
                'fecha_contrato.date_format' =>'Inserte una fecha de contrato valida',
                'fecha_contrato.before'=>'Seleccione una fecha de contrato correcta',

                'id_puesto.exists'=>'Este Puesto no existe en la base de datos',
                'id_puesto.required' =>'Debe de seleccionar un Puesto',

                'id_departamento.exists'=>'Este Departamento no existe en la base de datos',
                'id_departamento.required' =>'Debe de seleccionar un Departamento',

            ];
        
        
        
        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->messages()->messages()){
                    return back()
                        ->withInput()
                        ->withErrors($validator->messages());

        }
        
        
        
        
      $data = [];
    
     
    try{
        $empleado= new Empleado($request->all());
        $empleado->save();
      
        $data['mensaje']='Se ha guardado correctamente';
        $data['tipo']='success';
    } catch(Exception $e){
        $data['mensaje']='No se ha guardado';
        $data['tipo']='danger';
        return back()->with($data)->withInput();
    }
    return redirect('empleado')->with($data);
     
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        
         $data['puestos']=Puesto::all();
         $data['departamentos']=Departamento::all();
       $data['empleado']=$empleado;
        return view('empleado.show',$data);
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
      
      
      
      
      
      
      
      
         $data['empleado']=$empleado;
          $data['departamentos']=Departamento::all();
           $data['puestos']=Puesto::all();
        return view('empleado.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        
        
        
        
        
        $rules=
            [
                "nombre" => "required|min:2|max:250|string|alpha",
                "apellido" => "required|min:3|max:250|string|alpha",
                "email"=> "required|email:rfc",
                "telefono"=> "required|size:9",
                "fecha_contrato"=> "required|date_format:Y-m-d|before:tomorrow",
                "id_puesto"=> "required|exists:puesto,id",
                "id_departamento"=> "required|exists:departamento,id",
            ];
      
      
      
      
        $message=[

                'nombre.required' =>'El nombre es requerido',
                'nombre.min' =>'El nombre debe de tener más de dos caracteres',
                'nombre.max' =>'Este nombre es muy largo',
                'nombre.string' =>'El nombre debe de ser un string',
                'nombre.alpha' =>'El nombre no puede contener números',

                'apellido.required' =>'Los Apellidos son requerido',
                'apellido.min' =>'Los Apellidos deben de tener más de 3 caracteres',
                'apellido.max' =>'Los Apellidos son muy largo',
                'apellido.string' =>'Los Apellidos deben de ser un string',
                'apellido.alpha' =>'El apellido no puede contener números',

                'email.required' =>'El Email es requerida',
                'email.email' =>'El Email es incorrecto',

                'telefono.required' =>'El telefono es requerida',
                'telefono.size' =>'El telefono debe de tener 9 caracteres',

                'fecha_contrato.required'=>'La fecha de contrato es requerida',
                'fecha_contrato.date_format' =>'Inserte una fecha de contrato valida',
                'fecha_contrato.before'=>'Seleccione una fecha de contrato correcta',

                'id_puesto.exists'=>'Este Puesto no existe en la base de datos',
                'id_puesto.required' =>'Debe de seleccionar un Puesto',

                'id_departamento.exists'=>'Este Departamento no existe en la base de datos',
                'id_departamento.required' =>'Debe de seleccionar un Departamento',

            ];
      
      
      
      $validator = Validator::make($request->all(), $rules, $message);

        if($validator->messages()->messages()){
                    return back()
                        ->withInput()
                        ->withErrors($validator->messages());

        }
      
      
        
        
        
        
        
        
        
        
        
        
        try {
           $empleado->update($request->all());
            $data['mensaje']='Se ha actualizado correctamente';
            $data['tipo']='success';
       } catch (Exception $e ) {
            $data['mensaje']='No se ha actualizado';
        $data['tipo']='danger';
        return back()->withInput()->with($data);}
    return redirect('empleado')->with($data);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        try {
           $empleado->delete();
           $data['mensaje']='Se ha eliminado correctamente';
           $data['tipo']='success';
       } catch (Exception $e ) {
            $data['mensaje']='No se ha eliminado';
            $data['tipo']='danger';
            return back()->withInput()->with($data);}
    return redirect('empleado')->with($data);
        
    }
    
}
