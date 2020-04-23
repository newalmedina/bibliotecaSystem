@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Administracion de Usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('usuario.index')}}">Administracion de Usarios</a></li>
                    <li class="breadcrumb-item active">Nuevo Usuario</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header">
    <h3 class="card-title">EDITAR USUARIO USUARIO: <small>{{$usuario->nombre}} {{$usuario->apellidos}}</small></h3>
        <a href="{{route('usuario.index')}}" class="btn btn-sm btn-warning" style="position:absolute; right: 20px;">Regresar</a><br>

    </div>


    <!-- /.card-header -->
    <form role="form" action="{{route('usuario.update',$usuario->id)}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}        
        <input type="hidden" value="PATCH" name="_method">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre">Nombre</label>
                        <input value="{{$usuario->nombre}}" type="text"  class="form-control" id="nombre" name="nombre" maxlength="50" minlength="3" required >
                        @if($errors->has('nombre'))
                             <div class="text-danger font-italic">{{ $errors->first('nombre') }}</div>
                         @endif
                    </div>
                    <div class="col-md-6">
                        <label for="apellidos">Apellidos</label>
                        <input  value="{{$usuario->apellidos}}" type="text"  class="form-control" id="apellidos" name="apellidos" maxlength="100" minlength="3" required>
                        @if($errors->has('apellidos'))
                        <div class="text-danger font-italic">{{ $errors->first('apellidos') }}</div>
                    @endif
                    </div>

                    <div class="col-sm-6 col-md-2">
                        <label for="identificacion">Num. Ident.</label>
                        <input type="text"  value="{{$usuario->identificacion}}" class="form-control" id="identificacion" name="identificacion" maxlength="9" minlength="9" required>
                        @if($errors->has('identificacion'))
                        <div class="text-danger font-italic">{{ $errors->first('identificacion') }}</div>
                    @endif
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <label for="fecha_nacimiento">Fecha Nac.</label>
                        <input type="date"  value="{{$usuario->fecha_nacimiento}}"  class="form-control" id="fechanacimiento" name="fecha_nacimiento" required>
                        @if($errors->has('fecha_nacimiento'))
                        <div class="text-danger font-italic">{{ $errors->first('fecha_nacimiento') }}</div>
                    @endif
                    </div>
                    <div class="col-md-6">
                        <label for="correo">Correo</label>
                        <input type="email"  value="{{$usuario->correo}}"  class="form-control" onchange="" id="correo" name="correo" maxlength="100" required>
                        @if($errors->has('correo'))
                        <div class="text-danger font-italic">{{ $errors->first('correo') }}</div>
                    @endif
                    </div>
                    <div class="col-sm-6 col-md-2 ">
                        <label>Privilegios</label>
                        <select name="privilegio_id" id="Privilegios" class="custom-select select2" required>
                            <option  value="{{$usuario->privilegio->id}}">{{$usuario->privilegio->descripcion}}</option>
                            @foreach($privilegios as $privilegio)
                            <option value="{{$privilegio->id}}">{{$privilegio->descripcion}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('privilegio_id'))
                        <div class="text-danger font-italic">{{ $errors->first('privilegio_id') }}</div>
                    @endif
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <label>Sexo</label><br>
                        @if ($usuario->sexo=="M")
                            <input class="" type="radio" id="sexo" value="M" checked name="sexo"> Hombre
                            <input class="ml-2" type="radio" id="sexo1" value="F" name="sexo"> Mujer
                        @else
                            <input class="" type="radio" id="sexo" value="M"  name="sexo"> Hombre
                            <input class="ml-2" type="radio" id="sexo1" checked value="F" name="sexo"> Mujer                  
                        @endif
                          </div>
                    <div class="col-sm-6 col-md-2">
                        <label >Estatus</label><br>
                        @if ($usuario->estatus)
                            <input class="" type="radio" id="status" checked value="1" name="estatus"> Activo
                            <input class="ml-2" type="radio" id="status1" value="0" name="estatus"> Desactivado
                        @else
                            <input class="" type="radio" id="status"  value="1" name="estatus"> Activo
                            <input class="ml-2" type="radio" id="status1" checked value="0" name="estatus"> Desactivado
                         @endif
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <label for="">Telefono</label>
                        <input  value="{{$usuario->telefono}}" type="tel"  class="form-control" id="telefono" name="telefono" onKeyPress="return soloNumeros(event)"  onKeyPress="return soloNumeros(event)" maxlength="9" minlength="9" required>
                        @if($errors->has('telefono'))
                        <div class="text-danger font-italic">{{ $errors->first('telefono') }}</div>
                    @endif
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <label for="">Password</label>
                        <input type="password"  class="form-control" id="password" name="password" maxlength="18" minlength="6" placeholder="Solo rellenar en caso de querer modificarla">
                        
                        @if($errors->has('password'))
                        <div class="text-danger font-italic">{{ $errors->first('password') }}</div>
                    @endif
                    </div>
                    <div class="col-md-12">
                        <label for="direccion">Direccion</label>
                        <textarea name="direccion" class="form-control" id="direccion" maxlength="100">{{$usuario->direccion}}</textarea>
                        @if($errors->has('direccion'))
                        <div class="text-danger font-italic">{{ $errors->first('direccion') }}</div>
                    @endif
                    </div>
                    <div class="col-sm-6 col-md-12">
                        <label for="foto">Foto</label><br>
                        <input type="file" class="" id="foto" name="foto" accept="image/*" onchange=" validarImagen(this)">
                        @if($errors->has('foto'))
                        <div class="text-danger font-italic">{{ $errors->first('foto') }}</div>
                    @endif
                    </div>
                    @if($usuario->foto!="")
                    <div class="col-md-3 text-center"><br>                            
                        <img class="img-fluid" id="oldImage" src="{{asset($usuario->foto)}}" style="width: 300px; height:200px;" alt="imagen usuario">
                        <label for="">Imagen Actual</label>
                    </div>
                    @endif
                    <div class="col-md-3 text-center"><br>                        
                        <img class="img-fluid" id="mostrarFoto" src="" style="width: 300px; height:200px;" alt="">
                        
                        <label id="textoNuevaImg" class="text-secondary" for=""></label>
                    </div>
                </div>
            </div>

            <div class="form-group">

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
