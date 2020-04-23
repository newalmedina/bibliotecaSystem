@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Administracion de Miembros</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('cliente.index')}}">Administracion de Miembros</a></li>
                    <li class="breadcrumb-item active">Editar Miembro</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">EDITAR USUARIO USUARIO: <small>{{$cliente->nombre}} {{$cliente->apellidos}}</small></h3>
        <a href="{{route('cliente.index')}}" class="btn btn-sm btn-warning" style="position:absolute; right: 20px;">Regresar</a><br>

    </div>


    <!-- /.card-header -->
    <form role="form" action="{{route('cliente.update',$cliente->id)}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}        
        <input type="hidden" value="PATCH" name="_method">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nombre">Nombre</label>
                                <input value="{{ $cliente->nombre }}" type="text"  class="form-control" id="nombre" name="nombre" maxlength="50" minlength="3" required >
                                @if($errors->has('nombre'))
                                <div class="text-danger font-italic">{{ $errors->first('nombre') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label for="apellidos">Apellidos</label>
                                <input  value="{{ $cliente->apellidos }}" type="text"  class="form-control" id="apellidos" name="apellidos" maxlength="100" minlength="3" required>
                                @if($errors->has('apellidos'))
                                <div class="text-danger font-italic">{{ $errors->first('apellidos') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label for="correo">Correo</label>
                                <input type="email"  value="{{ $cliente->correo }}"  class="form-control" onchange="" id="correo" name="correo" maxlength="100" required>
                                @if($errors->has('correo'))
                                <div class="text-danger font-italic">{{ $errors->first('correo') }}</div>
                                @endif
                            </div>
                            <div class="col-sm-6 col-md-4 ">
                                <label>Tipo Documentacion</label>
                                <select name="tipo_documentacion" id="tipo_documentacion"  class="custom-select select2" required>
                                    @if (count($cliente->documentacionFotos)>1)
                                        <option  value="dni">DNI/NIE</option>
                                        <option  value="pasaporte">Pasaporte</option>   
                                    @else
                                        <option  value="pasaporte">Pasaporte</option>  
                                        <option  value="dni">DNI/NIE</option>  
                                    @endif                                     
                                </select>
                                @if($errors->has('tipo_documentacion'))
                                <div class="text-danger font-italic">{{ $errors->first('tipo_documentacion') }}</div>
                                @endif
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="identificacion">Num. Ident.</label>
                                <input type="text"  value="{{ $cliente->identificacion }}" class="form-control" id="identificacion" name="identificacion" maxlength="9" minlength="9" required>
                                @if($errors->has('identificacion'))
                                <div class="text-danger font-italic">{{ $errors->first('identificacion') }}</div>
                                @endif
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="fecha_nacimiento">Fecha Nac.</label>
                                <input type="date"  value="{{ $cliente->fecha_nacimiento }}"  class="form-control" id="fechanacimiento" name="fecha_nacimiento" required>
                                @if($errors->has('fecha_nacimiento'))
                                <div class="text-danger font-italic">{{ $errors->first('fecha_nacimiento') }}</div>
                                @endif
                            </div>                          
                           
                            <div class="col-sm-6 col-md-4">
                                <label>Sexo</label><br>
                                @if ($cliente->sexo=="M")
                                    <input class="" type="radio" id="sexo" value="M" checked name="sexo"> Hombre
                                    <input class="ml-2" type="radio" id="sexo1" value="F" name="sexo"> Mujer
                                @else
                                    <input class="" type="radio" id="sexo" value="M"  name="sexo"> Hombre
                                    <input class="ml-2" type="radio" id="sexo1" checked value="F" name="sexo"> Mujer                  
                                @endif
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label>Estatus</label><br>
                                @if ($cliente->estatus)
                                    <input class="" type="radio" id="status" checked value="1" name="estatus"> Activo
                                    <input class="ml-2" type="radio" id="status1" value="0" name="estatus"> Desactivado
                                @else
                                    <input class="" type="radio" id="status"  value="1" name="estatus"> Activo
                                    <input class="ml-2" type="radio" id="status1" checked value="0" name="estatus"> Desactivado
                                @endif
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label for="">Telefono</label>
                                <input  value="{{ $cliente->telefono }}" type="tel"  class="form-control" id="telefono" name="telefono" onKeyPress="return soloNumeros(event)"  onKeyPress="return soloNumeros(event)" maxlength="9" minlength="9" required>
                                @if($errors->has('telefono'))
                                <div class="text-danger font-italic">{{ $errors->first('telefono') }}</div>
                                @endif
                            </div>
                            
                                
                            <div class="col-md-12">
                                <label for="direccion">Direccion</label>
                                <textarea name="direccion" class="form-control" id="direccion" maxlength="100">{{ $cliente->direccion }}</textarea>
                                @if($errors->has('direccion'))
                                <div class="text-danger font-italic">{{ $errors->first('direccion') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Documentacion Actual</label>
                                <div class="row">
                                    @foreach ($cliente->documentacionFotos  as $documento)
                                        <div class="col-md-6">
                                            <img class="img-fluid img-thumbnail" id="oldImage" src="{{asset($documento->foto)}}" style="width: 300px; height:180px;" alt="imagen usuario">
                                        </div>
                                    @endforeach
                                </div>                           
                            </div>
                            <div class="col-sm-12 col-md-6  p-2" id="documentacionImagen">
                                <label for="foto">Anverso Documentacion</label><br>
                                <input type="file" class="" id="imagen" name="imagen" accept="image/*" onchange=" validarImagen(this)">
                                @if($errors->has('imagen'))
                                <div class="text-danger font-italic">{{ $errors->first('imagen') }}</div>
                                @endif
                                <br>
                                <img class="img-fluid  mt-2" id="mostrarFoto" src="" style=" width:300px;height:150px;" alt="">
                           
                            </div>
                            <div class="col-sm-12 col-md-6 p-2" id="documentacionImagen2">
                                <label for="foto">Dorso Documentacion</label><br>
                                <input type="file" class="" id="imagen2" name="imagen2" accept="image/*" onchange=" validarImagen2(this)">
                                @if($errors->has('imagen2'))
                                <div class="text-danger font-italic">{{ $errors->first('imagen2') }}</div>
                                @endif
                                <br>
                                <img class="img-fluid  mt-2" id="mostrarFoto2" src="" style="width:300px;height:150px;" alt="">
                           
                            </div>

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
<script>
    //validar si es un dni o un pasaporte esconder foto
    $('#documentacionImagen').hide();
    $('#documentacionImagen2').hide();
    
    $('#tipo_documentacion').on('change', function() {

        var valor =$('#tipo_documentacion').val();
        $('#documentacionImagen').val("");
        $('#documentacionImagen').hide();
        $('#documentacionImagen2').val("");
        $('#documentacionImagen2').hide();


        switch(valor) {
            case "dni":
                  $('#documentacionImagen').show();
                  $('#documentacionImagen2').show();
                break;
            case "pasaporte":
                 $('#documentacionImagen').show();
                break;
            default:
               
        }
    });

    
</script>
@endsection
