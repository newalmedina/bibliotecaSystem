@extends("layout.plantilla")
@section("contenido")

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Administracion de Editoriales</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Administracion de Editoriales</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">LISTADO DE EDITORIALES</h3>
        <a href="{{route('editorial.create')}}" class="btn btn-sm btn-info" style="position:absolute; right: 20px;">Nueva editorial</a><br>
    </div>
    <!-- /.card-header -->  <div class="card-body table-responsive">

        <table id="dataTable" class="table  table-bordered table-striped">
            <thead>
                <tr>

                    <th width="15">VER </th>
                    <th width="20">ID</th>          
                    <th>NOMBRE</th>                    
                    <th width="200">ACCIONES</th>
                </tr>
            </thead>
            <tbody id="resultado">
                @if($editoriales->count())
                @foreach($editoriales as $editorial)
                <tr>
                    <td>  <a  class='btn btn-info mr-1 'href="{{action('EditorialController@show',$editorial->id)}}"><i class='fas fa-eye'></i></a>
                    </td>
                    <td>{{$editorial->id}}</td>
                    <td>{{$editorial->nombre}} </td>
                    <td>                      
                        <a  class='btn btn-primary mr-1 'href="{{action('EditorialController@edit',$editorial->id)}}"><i class='fas fa-pencil-alt'></i></a>

                        <button  name="btnBorrar" class="btn btn-danger "onclick="eliminar({{$editorial->id}}, 'editorial')" ><i class="fas fa-trash-alt"></i></button>

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
