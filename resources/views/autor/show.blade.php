
@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">VISUALIZANDO AUTOR: {{$autor->id}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('autor.index')}}">Administracion de Autor</a></li>
                   
                    <li class="breadcrumb-item active">Visualizacion de Autor</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header ">
        <h4 class=" text-center">{{$autor->nombre}} </h4>
        <a href="{{route('autor.index')}}" class="btn btn-sm btn-warning" style="position:absolute; right: 20px;">Regresar</a><br>


    </div>
    <!-- /.card-header --> 
    <div class="card-body d-flex justify-content-center">
        <table id="dataTable" class="table  table-bordered table-striped">
            <thead>
                <tr>
                    <th width="40">PORTADA</th>
                    <th width="15">ID</th>          
                    <th>NOMBRE</th>
                    <th>ISB</th>
                    <th>GENERO</th>
                    <th>EDITORIAL</th>
                    <th>AñO PUBLICACION</th>                   
                    <th>ESTATUS</th>
                </tr>
            </thead>
            <tbody id="resultado">
                @if($autor->libros->count())
                @foreach($autor->libros as $libro)
                <tr>
                  
                    @if($libro->portada !="")
                    <td class="text-center"><img class="img-fluid rounded-circle text-center"  src="{{asset($libro->portada)}}" style="width: 40px; height:40px;" alt=""></td>
                    @else 
                    <td class="text-center"><img class="img-fluid rounded-circle"  src="{{asset('img/nobook.png')}}" style="width: 40px; height:40px;" alt=""></td>
                    @endif
                    <td>{{$libro->id}}</td>                   
                    <td>{{$libro->nombre}}</td>
                    <td>{{$libro->isbn}}</td>
                    <td>{{$libro->genero->descripcion}}</td>
                    <td>{{$libro->editorial->nombre}}</td>
                    <td>{{date("Y",strtotime($libro->fecha_publicacion))}}</td>
                    @if($libro->estatus == 1)
                    <td class='bg-success text-center '>Activo</td>
                    @else
                    <td class='bg-warning text-center'>Desactivado</td>
                    @endif
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