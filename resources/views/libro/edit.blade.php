@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Administracion de Libros</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('libro.index')}}">Administracion de Libros</a></li>
                    <li class="breadcrumb-item active">Nuevo Libro</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header">
    <h3 class="card-title">EDITAR LIBRO: <small>{{$libro->nombre}}</small></h3>
        <a href="{{route('libro.index')}}" class="btn btn-sm btn-warning" style="position:absolute; right: 20px;">Regresar</a><br>

    </div>


    <!-- /.card-header -->
    <form role="form" action="{{route('libro.update',$libro->id)}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}        
        <input type="hidden" value="PATCH" name="_method">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-5">
                        <label for="nombre">Nombre</label>
                    <input value="{{$libro->nombre}}" type="text"  class="form-control" id="nombre" name="nombre" maxlength="100" minlength="3" required >
                        @if($errors->has('nombre'))
                        <div class="text-danger font-italic">{{ $errors->first('nombre') }}</div>
                        @endif
                    </div>
                    
                    <div class="col-sm-6 col-md-3">
                        <label for="">ISBN</label>
                        <input  value="{{$libro->isbn}}" type="text"  class="form-control" id="isbn" name="isbn" onKeyPress="return soloNumeros(event)"  onKeyPress="return soloNumeros(event)" maxlength="13" minlength="13" required>
                        @if($errors->has('isbn'))
                        <div class="text-danger font-italic">{{ $errors->first('isbn') }}</div>
                        @endif
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <label for="fecha_publicacion">Fecha Publicacion.</label>
                        <input type="date"  value="{{$libro->fecha_publicacion}}"  class="form-control" id="fecha_publicacion" name="fecha_publicacion" required>
                        @if($errors->has('fecha_publicacion'))
                        <div class="text-danger font-italic">{{ $errors->first('fecha_nacimiento') }}</div>
                        @endif
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <label >Estatus</label><br>
                        @if ($libro->estatus)
                            <input class="" type="radio" id="status" checked value="1" name="estatus"> Activo
                            <input class="ml-2" type="radio" id="status1" value="0" name="estatus"> Desactivado
                        @else
                            <input class="" type="radio" id="status"  value="1" name="estatus"> Activo
                            <input class="ml-2" type="radio" id="status1" checked value="0" name="estatus"> Desactivado
                         @endif
                    </div>
                   
                    <div class="col-sm-6 col-md-4 ">
                        <label>Autor</label>
                        <select name="autor_id" id="autor_id" class="custom-select select2" required>
                        <option  value="{{$libro->autor->id}}">{{$libro->autor->nombre}}</option>
                            @foreach($autores as $autor)
                            <option value="{{$autor->id}}">{{$autor->nombre}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('autor_id'))
                        <div class="text-danger font-italic">{{ $errors->first('autor_id') }}</div>
                        @endif
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label>Genero</label>
                        <select name="genero_id" id="genero_id" class="custom-select select2" required>
                            <option  value="{{$libro->genero->id}}">{{$libro->genero->descripcion}}</option>
                            @foreach($generos as $genero)
                            <option value="{{$genero->id}}">{{$genero->descripcion}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('genero_id'))
                        <div class="text-danger font-italic">{{ $errors->first('genero_id') }}</div>
                        @endif
                    </div>
                    <div class="col-sm-6 col-md-4 ">
                        <label>Editorial</label>
                        <select name="editorial_id" id="editorial_id" class="custom-select select2" required>
                            <option  value="{{$libro->editorial->id}}">{{$libro->editorial->nombre}}</option>
                            @foreach($editoriales as $editorial)
                            <option value="{{$editorial->id}}">{{$editorial->nombre}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('editorial_id'))
                        <div class="text-danger font-italic">{{ $errors->first('editorial_id') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <label for="sinopsis"> </label>
                        <textarea name="sinopsis" class="form-control" id="sinopsis" maxlength="100">{{$libro->sinopsis}}</textarea>
                        @if($errors->has('sinopsis'))
                        <div class="text-danger font-italic">{{ $errors->first('sinopsis') }}</div>
                        @endif
                    </div>
                    <div class="col-sm-6 col-md-12">
                        <label for="foto">Foto</label><br>
                        <input type="file" class="" id="foto" name="portada" accept="image/*" onchange=" validarImagen(this)">
                        @if($errors->has('portada'))
                        <div class="text-danger font-italic">{{ $errors->first('portada') }}</div>
                    @endif
                    </div>
                    @if($libro->portada!="")
                    <div class="col-md-3 text-center"><br>                            
                        <img class="img-fluid" id="oldImage" src="{{asset($libro->portada)}}" style="width: 300px; height:200px;" alt="imagen usuario">
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
