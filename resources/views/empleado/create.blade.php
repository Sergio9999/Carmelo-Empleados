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
         
      <form method="POST" action="{{url('empleado')}}">
        @csrf <!--esto es para que nadie de otra pagina me pueda rellenar el form con codigo malicioso-->
        @method('POST')
        <div class="form-group d-flex flex-column mx-auto">
          <label for="name">Nombre del empleado</label>
          <input type="text" value="{{old('nombre')}}" name="nombre" id="name" class="form-control">
        </div>
        <div class="form-group d-flex flex-column mx-auto">
          <label for="apellido">Apellido del empleado</label>
          <input type="text" value="{{old('apellido')}}" name="apellido" id="apellido" class="form-control">
        </div>
        
        <div class="form-group d-flex flex-column mx-auto">
          <label for="email">Email del empleado</label>
          <input type="email" value="{{old('email')}}" name="email" id="email" class="form-control">
        </div>
        
         <div class="form-group d-flex flex-column mx-auto">
          <label for="telefono">Telefono del empleado</label>
          <input type="text" value="{{old('telefono')}}" name="telefono" id="telefono" class="form-control">
        </div>
        
         <div class="form-group d-flex flex-column mx-auto">
          <label for="fecha_contrato">Fecha de contrato</label>
          <input type="date" value="{{old('fecha_contrato')}}" name="fecha_contrato" id="fecha_contrato" class="form-control">
        </div>
        
        
        <div class="mb-3 ">
     <label class="form-label">Asignar un Departamento</label>
     <select name="id_departamento" class="form-select" aria-label="Default select example" required>
             <option value="" selected>Asignar</option>

           @foreach($departamentos as $departamento)
               <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
           @endforeach


     </select>
  </div>
        
        <div class="mb-3 ">
     <label class="form-label">Asignar un Puesto de Trabajo</label>
     <select name="id_puesto" class="form-select" aria-label="Default select example" required>
               <option value="" selected>Asignar</option>
            @foreach($puestos as $puesto)
               <option value="{{$puesto->id}}">{{$puesto->nombre}}</option>
            @endforeach
     </select>
  </div>
        
       
        
        
        
    
        

        <div class="from-group">
         <input class="btn btn-primary" type="submit" value="Enviar datos">

        </div>
        
      </form>
    </div>

  </div>
   <a href="{{url('empleado')}}" type="button" class="btn btn-dark">Volver</a>

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