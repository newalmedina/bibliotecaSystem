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
                    <li class="breadcrumb-item active">Administracion de Usuarios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">LISTADO DE USUARIOS</h3>
        <a href="{{route('usuario.create')}}" class="btn btn-sm btn-info" style="position:absolute; right: 20px;">Nuevo usuario</a><br>
    </div>
    <!-- /.card-header -->  <div class="card-body table-responsive">

        <table id="dataTable" class="table  table-bordered table-striped">
            <thead>
                <tr>

                    <th width="15">VER </th>
                    <th width="15">ID</th>          
                    <th>NOMBRE</th>
                    <th>PRIVILEGIOS</th>
                    <th>IDENTIFICACION</th>
                    <th>CORREO</th>
                    <th>ESTATUS</th>
                    <th width="40">FOTO</th>
                    <th width="">ACCIONES</th>
                </tr>
            </thead>
            <tbody id="resultado">
                @if($usuarios->count())
                @foreach($usuarios as $usuario)
                <tr>
                    <td>  <a  class='btn btn-info mr-1 'href="{{action('UsuarioController@show',$usuario->id)}}"><i class='fas fa-eye'></i></a>
                    </td>
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->nombre}} {{$usuario->apellidos}}</td>
                    <td>{{$usuario->privilegio->descripcion}}</td>
                    <td>{{$usuario->identificacion}}</td>
                    <td>{{$usuario->correo}}</td>
                    @if($usuario->estatus == 1)
                    <td class='bg-success text-center '>Activo</td>
                    @else
                    <td class='bg-warning text-center'>Desactivado</td>
                    @endif
                    @if($usuario->foto !="")
                    <td><img class="img-fluid rounded-circle"  src="{{asset($usuario->foto)}}" style="width: 40px; height:40px;" alt=""></td>
                    @else 
                    <td><img class="img-fluid rounded-circle"  src="{{asset('img/noimage.jpg')}}" style="width: 40px; height:40px;" alt=""></td>
                    @endif

                    <td>                      
                        <a  class='btn btn-primary mr-1 'href="{{action('UsuarioController@edit',$usuario->id)}}"><i class='fas fa-pencil-alt'></i></a>

                        <button  name="btnBorrar" class="btn btn-danger "onclick="eliminar({{$usuario->id    }}, 'usuario')" ><i class="fas fa-trash-alt"></i></button>

                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9" class="text-center"> No hay registros disponibles</td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->


@endsection
