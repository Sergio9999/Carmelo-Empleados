<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['empleados']=Empleado::all();
        $data['departamentos']=Departamento::all(); /*cogemos el contenido de departamentos que exista en la base de datos y se lo enviamos a la vista*/
        return view('departamento.index',$data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['empleados']=Empleado::all();
        return view('departamento.create',$data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if( $request->id_empleado_jefe == "null" ){
                 //Si enviamos null la foreign
            $request->merge([
                    'id_empleado_jefe' => null,
            ]);
         }
        
        
        
        
        $rules=
            [
              "nombre" => "required|unique:departamento,nombre|min:2|max:250|string",
              "localizacion"=> "required|min:2|max:250|string",
              "id_empleado_jefe"=> "nullable|exists:empleado,id|unique:departamento,id_empleado_jefe|integer",
            ];

        $message=[
                'nombre.required' =>'El nombre es requerido',
                'nombre.unique' =>'Este nombre ya se encuentra en uso',
                'nombre.min' =>'El nombre debe de tener más de dos caracteres',
                'nombre.max' =>'Este nombre es muy largo',
                'nombre.string' =>'El nombre debe de ser un string',

                'localizacion.required' =>'La localización es requerida',
                'localizacion.min' =>'La localización debe de tener más de dos caracteres',
                'localizacion.max' =>'El nombre de localizacion es muy largo',
                'localizacion.string' =>'La localizacion debe de ser tipo STRING',

                'id_empleado_jefe.exists'=>'Este empleado no existe en la base de datos',
                'id_empleado_jefe.unique'=>'Este empleado ya es jefe de un departamento',
                'id_empleado_jefe.integer' =>'Este valos debe ser un ID',
                ];

        $validator = Validator::make($request->all(), $rules, $message);
        
        
        
        
        
       
        
        
        
        
        
     $data = [];
    
     
    try{
        $departamento= new Departamento($request->all());
        $departamento->save();
      
        $data['mensaje']='Se ha guardado correctamente';
        $data['tipo']='success';
    } catch(Exception $e){
        $data['mensaje']='No se ha guardado';
        $data['tipo']='danger';
        return back()->with($data)->withInput();
    }
    return redirect('departamento')->with($data);
     
     
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        $data['empleados']=Empleado::all();
        $data['departamento']=$departamento;
        return view('departamento.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        $data['empleados']=Empleado::all();
         $data['departamento']=$departamento;
        return view('departamento.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
       
        
        if( $request->id_empleado_jefe == "null" ){
                 //Si enviamos null la foreign
            $request->merge([
                    'id_empleado_jefe' => null,
            ]);
         }
       
       $rules=
            [
                "nombre" => "required|min:2|max:250|string",
                "localizacion"=> "required|min:2|max:250|string",
                "id_empleado_jefe"=> "nullable|exists:empleado,id|integer",

            ];

        $message=[

                'nombre.required' =>'El nombre es requerido',
                'nombre.min' =>'El nombre debe de tener más de dos caracteres',
                'nombre.max' =>'Este nombre es muy largo',
                'nombre.string' =>'El nombre debe de ser un string',

                'localizacion.required' =>'La localización es requerida',
                'localizacion.min' =>'La localización debe de tener más de dos caracteres',
                'localizacion.max' =>'El nombre de localizacion es muy largo',
                'localizacion.string' =>'La localizacion debe de ser tipo STRING',

                'id_empleado_jefe.exists'=>'Este empleado no existe en la base de datos',
                'id_empleado_jefe.integer' =>'Este valos debe ser un ID',

            ];


        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->messages()->messages()){
                    return back()
                        ->withInput()
                        ->withErrors($validator->messages());

        }
       
     
       $data = [];

 
       $peticion=$request->all();
       

       
       try {
           $departamento->update($peticion);
            $data['mensaje']='Se ha actualizado correctamente';
            $data['tipo']='success';
       } catch (Exception $e ) {
            $data['mensaje']='No se ha actualizado';
        $data['tipo']='danger';
        return back()->withInput()->with($data);}
    return redirect('departamento')->with($data);
       
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        try {
           $departamento->delete();
           $data['mensaje']='Se ha eliminado correctamente';
           $data['tipo']='success';
       } catch (Exception $e ) {
            $data['mensaje']='No se ha eliminado';
            $data['tipo']='danger';
            return back()->withInput()->with($data);}
    return redirect('departamento')->with($data);
        
    }
    
}









