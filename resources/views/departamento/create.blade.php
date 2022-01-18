@extends('base')
@section('contenido')
@if(Session::has('mensaje'))
                    <div class="alert alert-{{ session()->get('tipo') }}" id="alerta" role="alert">
                        {{ session()->get('mensaje') }}
                    </div>
            @endif
            
@if ($errors->any())
 <div class="alert alert-danger">
 <ul>
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
@endif            
<div class="container my-2">
  <h1 class="text-center"></h1>

  <div class="wrapper d-flex col-12 justify-content-center  rounded p-4 form">

    <div class="rounded rounded-lg shadow-lg position-absolute card-bg">

    </div>
    <div class="grid-form col-12 col-md-8 col-sm-12 col-lg-8 pb-5 px-5 rounded rounded-lg shadow-lg d-flex flex-column aling-items-center">
         
      <form method="POST" action="{{url('departamento')}}">
        @csrf <!--esto es para que nadie de otra pagina me pueda rellenar el form con codigo malicioso-->
        @method('POST')
        <div class="form-group d-flex flex-column mx-auto">
          <label for="name">Nombre del departamento</label>
          <input type="text" value="{{old('nombre')}}" name="nombre" id="name" class="form-control">
        </div>
        <div class="form-group d-flex flex-column mx-auto"
          <label for="min">localizacion</label>
          <input type="text" name="localizacion"  value="{{old('localizacion')}}" class="form-control">
        </div>

        <div class="form-group d-flex flex-column mx-auto">
          <label for="max">jefe</label>
          
          <select name="id_empleado_jefe" class="form-select" aria-label="Default select example" required>
          <option value="null" selected >No asignar</option>

          @foreach($empleados as $empleado)
                    <option value="{{$empleado->id}}" >{{$empleado->nombre}}</option>
          @endforeach


     </select>
          
          
          
          
        </div>
        <div class="from-group">
         <input class="btn btn-primary" type="submit" value="Enviar datos">

        </div>
        
      </form>
    </div>

  </div>
   <a href="{{url('departamento')}}" type="button" class="btn btn-dark">Volver</a>

<style>
    .card-bg {
  width: 430px;
  height: 440px;
  transform: skew(0deg, 2deg) rotate(-8deg);
  z-index: -2;
  position: absolute;
  background-image: linear-gradient(to left, #F15B00 0, #632500 100%);
}
.grid-form {
  position: relative;
  z-index: 2;
  background: white;
}

</style>
</div>

@endsection