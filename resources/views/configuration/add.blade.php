@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Configuracion</h1>
            </div><!-- /.col -->
           
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title ">CONFIGURACION</H3>
      

    </div> 

    <!-- /.card-header -->
    <form role="form" action="{{route('configuration.store')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="nombre">Nombre de la biblioteca</label>
                        <input type="text" value="{{ old('nombre_biblioteca') }}" class="form-control" id="nombre" name="nombre_biblioteca" maxlength="100" minlength="5" required>
                        @if($errors->has('nombre_biblioteca'))
                             <div class="text-danger font-italic">{{ $errors->first('nombre_biblioteca') }}</div>
                         @endif 
                    </div>
                    <div class="col-md-3">
                        <label for="libros_maximos">Maximo libros para prestar</label>
                        <input type="number" value="{{ old('libros_maximos') }}"  
                        class="form-control" id="libros_maximos" 
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"                        
                        name="libros_maximos"required maxlength="2">
                        @if($errors->has('libros_maximos'))
                             <div class="text-danger font-italic">{{ $errors->first('libros_maximos') }}</div>
                         @endif 
                    </div>
                    <div class="col-md-3">
                        <label for="num_dias_prestamos">Dias de alquiler maximo</label>
                        <input type="number" value="{{ old('num_dias_prestamos') }}" 
                        class="form-control" id="num_dias_prestamos" name="num_dias_prestamos" 
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        required maxlength="2">        
                        @if($errors->has('num_dias_prestamos'))
                        <div class="text-danger font-italic">{{ $errors->first('num_dias_prestamos') }}</div>
                    @endif 
                    </div>                
                   
                    <div class="col-md-2">
                        <label for="">Telefono</label>
                        <input type="text" value="{{ old('telefono') }}"  class="form-control" id="" name="telefono" onKeyPress="return soloNumeros(event)"  required minlength="9" maxlength="9" onKeyPress="return soloNumeros(event)">
                        @if($errors->has('telefono'))
                             <div class="text-danger font-italic">{{ $errors->first('telefono') }}</div>
                         @endif 
                    </div>
                    <div class="col-md-4">
                        <label for="correo">Correo electronico</label>
                        <input type="email" value="{{ old('correo') }}"  class="form-control" id="correo" name="correo" required  maxlength="100" >
                        @if($errors->has('correo'))
                             <div class="text-danger font-italic">{{ $errors->first('correo') }}</div>
                         @endif 
                    </div>
                    
                    <div class="col-md-12">
                        <label for="direccion">Direccion</label>
                        <textarea name="direccion" class="form-control" id="direccion" required minlength="10" maxlength="255">{{ old('direccion') }}</textarea>
                        @if($errors->has('direccion'))
                        <div class="text-danger font-italic">{{ $errors->first('direccion') }}</div>
                    @endif 
                    </div>
                    <div class="col-sm-6 col-md-12">
                        <label for="foto">Logo de la biblioteca</label><br>
                        <input type="file" class="" id="foto" name="foto" accept="image/*" onchange=" validarImagen(this)">
                        @if($errors->has('foto'))
                        <div class="text-danger font-italic">{{ $errors->first('foto') }}</div>
                    @endif 
                    </div>
                    <div class="col-md-3"><br>
                        <img class="img-fluid" id="mostrarFoto" src="" style="width: 200px; height:200px;" alt="">
                    </div>
                </div>
            </div>


        </div>

</div>
<!-- /.card-body -->

<div class="card-footer text-center">
    <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
</div>
</form>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection