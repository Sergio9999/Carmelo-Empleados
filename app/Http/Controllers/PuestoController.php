<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['puestos']=Puesto::all(); /*cogemos el contenido de puestos que exista en la base de datos y se lo enviamos a la vista*/
        return view('puesto.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('puesto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     /*en el store, update y destroy, es donde va toda la lógica*/
     /*dd($request->all());*/
     
     
     
     $rules=
            [

                "nombre"=> "required|min:2|max:250|string|alpha",
                "minimo"=> "required|gte:0.01|lte:999999.99|numeric",
                "maximo"=> "required|gte:0.01|lte:999999.99|numeric",

            ];

            $message=[


                'nombre.required' =>'El nombre es requerido',
                'nombre.alpha'=>'El nombre tiene números',
                'nombre.min' =>'El nombre debe de tener más de dos caracteres',
                'nombre.max' =>'Este nombre es muy largo',
                'nombre.string' =>'El nombre debe de ser un string',

                'minimo.required' =>'El sueldo minimo es requerido',
                'minimo.gte' =>'El sueldo minimo debe de ser numerico ejemplo: 999999.99',
                'minimo.lte' =>'El suedo minimo debe de ser numerico ejemplo: 999999.99',
                'minimo.numeric' =>'El tipo de dato para sueldo minimo debe de ser numerico',

                'maximo.required' =>'El sueldo minimo es requerido',
                'maximo.gte' =>'El sueldo minimo debe de ser numerico ejemplo:999999.99',
                'maximo.lte' =>'El suedo minimo debe de ser numerico ejemplo: 999999.99',
                'maximo.numeric' =>'El tipo de dato para sueldo minimo debe de ser numerico',


                ];

                $validator =Validator::make($request->all(), $rules, $message);

                if($validator->messages()->messages()){
                    return back()
                        ->withInput()
                        ->withErrors($validator->messages());
                }
     
     
     
     
     
     $data = [];
     $nombre= $request->all('nombre');
     $minimo= $request->all('minimo');
     $maximo= $request->all('maximo');
    
    
    try{
        $puesto= new Puesto($nombre,$minimo,$maximo);
       
        $puesto->save(); /*el save me lo mete en la base de datos*/
        $data['mensaje']='Se ha guardado correctamente';
        $data['tipo']='success';
    } catch(Exception $e){
        $data['mensaje']='No se ha guardado';
        $data['tipo']='danger';
        return back()->with($data)->withInput();
    }
    return redirect('puesto')->with($data);
     
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function show(Puesto $puesto)
    {
        $data['puesto']=$puesto;
        return view('puesto.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Puesto $puesto)
    {
        $data['puesto']=$puesto;
        return view('puesto.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puesto $puesto)
    {
        
        $rules=
            [

                "nombre"=> "required|min:2|max:250|string|alpha",
                "minimo"=> "required|gte:0.01|lte:999999999.99|numeric",
                "maximo"=> "required|gte:0.01|lte:999999999.99|numeric",

            ];

            $message=[


                'nombre.required' =>'El nombre es requerido',
                'nombre.min' =>'El nombre debe de tener más de dos caracteres',
                'nombre.max' =>'Este nombre es muy largo',
                'nombre.string' =>'El nombre debe de ser un string',
                'nombre.alpha'=>'El nombre tiene números',

                'minimo.required' =>'El sueldo minimo es requerido',
                'minimo.gte' =>'El sueldo minimo debe de ser numerico ejemplo: 999999999.99',
                'minimo.lte' =>'El suedo minimo debe de ser numerico ejemplo: 999999999.99',
                'minimo.numeric' =>'El tipo de dato para sueldo minimo debe de ser numerico',

                'maximo.required' =>'El sueldo minimo es requerido',
                'maximo.gte' =>'El sueldo minimo debe de ser numerico ejemplo: 999999999.99',
                'maximo.lte' =>'El suedo minimo debe de ser numerico ejemplo: 999999999.99',
                'maximo.numeric' =>'El tipo de dato para sueldo minimo debe de ser numerico',


                ];

                $validator =Validator::make($request->all(), $rules, $message);

                if($validator->messages()->messages()){
                    return back()
                        ->withInput()
                        ->withErrors($validator->messages());
                }
        
        
        
        
        
       $peticion=$request->all();
       
       
       try {
           $puesto->update($peticion);
            $data['mensaje']='Se ha actualizado correctamente';
            $data['tipo']='success';
       } catch (Exception $e ) {
            $data['mensaje']='No se ha actualizado';
        $data['tipo']='danger';
        return back()->withInput()->with($data);}
    return redirect('puesto')->with($data);
       
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puesto $puesto)
    {
       try {
           $puesto->delete();
           $data['mensaje']='Se ha eliminado correctamente';
           $data['tipo']='success';
       } catch (Exception $e ) {
            $data['mensaje']='No se ha eliminado';
            $data['tipo']='danger';
            return back()->withInput()->with($data);}
    return redirect('puesto')->with($data);
        
    }
}
