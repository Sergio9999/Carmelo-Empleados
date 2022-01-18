@extends('base')
@section('contenido')
@if(Session::has('mensaje'))
                    <div class="alert alert-{{ session()->get('tipo') }}" id="alerta" role="alert">
                        {{ session()->get('mensaje') }}
                    </div>
            @endif
<h1>Departamentos</h1>            
<a href="{{url('departamento/create')}}" type="button" class="btn btn-dark">Crear nuevo</a>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">nombre del departamento</th>
      <th scope="col">localizacion</th>
      <th scope="col">jefe</th>
      <th scope="col">show</th>
      <th scope="col">edit</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
      @foreach($departamentos as $departamento)
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
      <td><a href="{{url('departamento/'.$departamento->id)}}" type="button" class="btn btn-dark">Visualizar</a></td>
      <td><a href="{{url('departamento/'.$departamento->id.'/edit')}}" type="button" class="btn btn-dark">Editar</a></td>
      <td>
        <form method="Post" action="{{url('departamento/'.$departamento->id)}}">
        @csrf <!--esto es para que nadie de otra pagina me pueda rellenar el form con codigo malicioso-->
        @method('Delete')
        
        
      
        
        <input type="submit" value="eliminar" class="btn btn-dark"></input>
        </form>
        
      </td>
    </tr>

    @endforeach
  </tbody>
</table>
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



