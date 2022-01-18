@extends('base')
@section('contenido')
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">nombre</th>
      <th scope="col">apellido</th>
      <th scope="col">email</th>
      <th scope="col">telefono</th>
      <th scope="col">fecha contrato</th>
      <th scope="col">id departamento</th>
       <th scope="col">id puesto</th>
    </tr>
  </thead>
  <tbody>
    
    <tr>
      <th scope="row">{{$empleado->id}}</th>
      <td>{{$empleado->nombre}}</td>
      <td>{{$empleado->apellido}}</td>
       <td>{{$empleado->email}}</td>
        <td>{{$empleado->telefono}}</td>
         <td>{{$empleado->fecha_contrato}}</td>
           <td>@foreach($departamentos as $departamento)
          
          @if($empleado->id_departamento == $departamento->id)
          
          {{$departamento->nombre}}
          
          @endif
          
          
          @endforeach</td>
          
          
          
            <td>@foreach($puestos as $puesto)
          
          @if($empleado->id_puesto == $puesto->id)
          
          {{$puesto->nombre}}
          
          @endif
          
          
          @endforeach</td>
           
           
           
           
           
           
           
           
           
           
           
      
    </tr>

 
  </tbody>
</table>
<a href="{{url('empleado')}}" type="button" class="btn btn-dark">Volver</a>
<style>
   tr{
        color:white !important;
    }
    td{
        color:white !important
    }
    thead{
        color:white !important;
    }
    .table thead th {
    color: white;
    font-weight: 600;
    font-size: 16px;
}
</style>

@endsection