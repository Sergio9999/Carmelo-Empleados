@extends('base')
@section('contenido')
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">nombre</th>
      <th scope="col">localizacion</th>
      <th scope="col">id_empleado_jefe</th>
    </tr>
  </thead>
  <tbody>
    
    <tr>
      <th scope="row">{{$departamento->id}}</th>
      <td>{{$departamento->nombre}}</td>
      <td>{{$departamento->localizacion}}</td>
      <td>@isset($departamento->id_empleado_jefe)
                              
                              @foreach($empleados as $empleado)
          
          @if($empleado->id == $departamento->id_empleado_jefe)
          
          {{$empleado->nombre}}
          
          @endif
          
          
          @endforeach
                              
         
                              
                    @endisset

                    @empty($departamento->id_empleado_jefe)
                             No Asignado
                    @endempty
      </td>
      
    </tr>

 
  </tbody>
</table>
<a href="{{url('departamento')}}" type="button" class="btn btn-dark">Volver</a>
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