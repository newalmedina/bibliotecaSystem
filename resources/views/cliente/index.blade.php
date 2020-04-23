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
                    <li class="breadcrumb-item active">Administracion de Miembros</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">LISTADO DE MIEMBROS</h3>
        <a href="{{route('cliente.create')}}" class="btn btn-sm btn-info" style="position:absolute; right: 20px;">Nuevo Miembro</a><br>
    </div>
    <!-- /.card-header -->  <div class="card-body table-responsive">

        <table id="dataTable" class="table  table-bordered table-striped">
            <thead>
                <tr>

                    <th width="15">VER </th>
                    <th width="15">ID</th>          
                    <th>NOMBRE</th>                 
                    <th>IDENTIFICACION</th>
                    <th>TELEFONO</th>
                    <th>CORREO</th>
                    <th>ESTATUS</th>
                    <th width="">ACCIONES</th>
                </tr>
            </thead>
            <tbody id="resultado">
                @if($clientes->count())
                @foreach($clientes as $cliente)
                <tr>
                    <td>  <a  class='btn btn-info mr-1 'href="{{action('ClienteController@show',$cliente->id)}}"><i class='fas fa-eye'></i></a>
                    </td>
                    <td>{{$cliente->id}}</td>
                    <td>{{$cliente->nombre}} {{$cliente->apellidos}}</td>
                    <td>{{$cliente->identificacion}}</td>
                    <td>{{$cliente->telefono}}</td>
                    <td>{{$cliente->correo}}</td>
                    @if($cliente->estatus == 1)
                    <td class='bg-success text-center '>Activo</td>
                    @else
                    <td class='bg-warning text-center'>Desactivado</td>
                    @endif
                    <td>                      
                        <a  class='btn btn-primary mr-1 'href="{{action('ClienteController@edit',$cliente->id)}}"><i class='fas fa-pencil-alt'></i></a>

                        <button  name="btnBorrar" class="btn btn-danger "onclick="eliminar({{$cliente->id    }}, 'cliente')" ><i class="fas fa-trash-alt"></i></button>

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
