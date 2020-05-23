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
                    <li class="breadcrumb-item active">Administracion de Libros</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">LISTADO DE LIBROS</h3>
        <a href="{{route('libro.create')}}" class="btn btn-sm btn-info" style="position:absolute; right: 20px;">Nuevo libro</a><br>
    </div>
    <!-- /.card-header -->  <div class="card-body table-responsive">

        <table id="dataTable" class="table  table-bordered table-striped">
            <thead>
                <tr>

                    <th width="15">VER </th>
                    <th width="40">PORTADA</th>
                    <th width="15">ID</th>          
                    <th>NOMBRE</th>
                    <th>ISB</th>
                    <th>FECHA PUBLICACION</th>                   
                    <th width="15">Stock</th>                   
                    <th width="15">Disponible</th>                   
                    <th>ESTATUS</th>
                    <th width="">ACCIONES</th>
                </tr>
            </thead>
            <tbody id="resultado">
                @if($libros->count())
                @foreach($libros as $libro)
                <tr>
                    <td>  <a  class='btn btn-info mr-1 'href="{{action('LibroController@show',$libro->id)}}"><i class='fas fa-eye'></i></a>
                    </td>
                    @if($libro->portada !="")
                    <td class="text-center"><img class="img-fluid rounded-circle text-center"  src="{{asset($libro->portada)}}" style="width: 40px; height:40px;" alt=""></td>
                    @else 
                    <td class="text-center"><img class="img-fluid rounded-circle"  src="{{asset('img/nobook.png')}}" style="width: 40px; height:40px;" alt=""></td>
                    @endif
                    <td>{{$libro->id}}</td>                   
                    <td>{{$libro->nombre}}</td>
                    <td>{{$libro->isbn}}</td>
                    <td>{{$libro->fecha_publicacion}}</td>
                    <td class="text-center">{{$libro->stock}}</td>                    
                    @if($libro->stock - $libro->alquilados > 0)
                      <td class='text-success text-center font-weight-bolder'>{{$libro->stock - $libro->alquilados}}</td>
                    @else
                    <td class='text-danger text-center font-weight-bolder'>{{$libro->stock - $libro->alquilados}}</td>
                    @endif
                    @if($libro->estatus == 1)
                    <td class='bg-success text-center '>Activo</td>
                    @else
                    <td class='bg-warning text-center'>Desactivado</td>
                    @endif
                    
                    <td>                      
                        <a  class='btn btn-primary mr-1 'href="{{action('LibroController@edit',$libro->id)}}"><i class='fas fa-pencil-alt'></i></a>

                        <button  name="btnBorrar" class="btn btn-danger "onclick="eliminar({{$libro->id    }}, 'libro')" ><i class="fas fa-trash-alt"></i></button>

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
