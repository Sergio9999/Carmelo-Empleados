@extends('base')
@section('contenido')
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">nombre</th>
      <th scope="col">minimo</th>
      <th scope="col">maximo</th>
    </tr>
  </thead>
  <tbody>
    
    <tr>
      <th scope="row">{{$puesto->id}}</th>
      <td>{{$puesto->nombre}}</td>
      <td>{{$puesto->minimo}}</td>
      <td>{{$puesto->maximo}}</td>
      
    </tr>

 
  </tbody>
</table>
<a href="{{url('puesto')}}" type="button" class="btn btn-dark">Volver</a>
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