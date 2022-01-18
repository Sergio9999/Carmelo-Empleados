@extends('base')
@section('contenido')

@if(Session::has('mensaje'))
                    <div class="alert alert-{{ session()->get('tipo') }}" id="alerta" role="alert">
                        {{ session()->get('mensaje') }}
                    </div>
            @endif
<h1>Puestos</h1>            
<a href="{{url('puesto/create')}}" type="button" class="btn btn-dark">Crear nuevo</a>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">nombre</th>
      <th scope="col">minimo</th>
      <th scope="col">maximo</th>
      <th scope="col">show</th>
      <th scope="col">edit</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
      @foreach($puestos as $puesto)
    <tr>
      <th scope="row">{{$puesto->id}}</th>
      <td>{{$puesto->nombre}}</td>
      <td>{{$puesto->minimo}}</td>
      <td>{{$puesto->maximo}}</td>
      <td><a href="{{url('puesto/'.$puesto->id)}}" type="button" class="btn btn-dark">Visualizar</a></td>
      <td><a href="{{url('puesto/'.$puesto->id.'/edit')}}" type="button" class="btn btn-dark">Editar</a></td>
      <td>
        <form method="Post" action="{{url('puesto/'.$puesto->id)}}">
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