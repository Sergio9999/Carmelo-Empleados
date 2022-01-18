@extends('base')
@if (!$nulos)


@section('contenido')
@if(Session::has('mensaje'))
                    <div class="alert alert-{{ session()->get('tipo') }}" id="alerta" role="alert">
                        {{ session()->get('mensaje') }}
                    </div>
            @endif
<h1>Empleados</h1>            
<a href="{{url('empleado/create')}}" type="button" class="btn btn-dark">Crear nuevo</a>
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
        <th scope="col">mostrar</th>
        <th scope="col">editar</th>
         <th scope="col">eliminar</th>
    </tr>
  </thead>
  <tbody>
      @foreach($empleados as $empleado)
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
     
      <td><a href="{{url('empleado/'.$empleado->id)}}" type="button" class="btn btn-dark">Visualizar</a></td>
      <td><a href="{{url('empleado/'.$empleado->id.'/edit')}}" type="button" class="btn btn-dark">Editar</a></td>
      <td>
        <form method="Post" action="{{url('empleado/'.$empleado->id)}}">
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


@else
@section('contenido')
<h1>Aun no se puede crear empleado hasta que se cree un puesto y un departamento</h1>
@endsection
@endif



