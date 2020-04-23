
@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">VISUALIZANDO LIBRO: {{$libro->id}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('libro.index')}}">Administracion de Libros</a></li>
                   
                    <li class="breadcrumb-item active">Visualizacion de libros</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header ">
        <h4 class=" text-center">{{$libro->nombre}}</h4>

    </div>
    <!-- /.card-header --> 
    <div class="card-body d-flex justify-content-center">



        <div class="card" style="width:400px">
            <div class="border-bottom d-flex justify-content-center" style="background-image:url({{asset('img/degradado.jpg')}});background-repeat: no-repeat; background-size: cover; ">
                @if($libro->portada !="")
                <img style="width:250px; height:230px; position:relative; top: 70px; margin-top:-50px" class=" align-self-center rounded-circle "  src="{{asset($libro->portada)}}" style="width: 40px; height:40px;" alt="">
                @else 
                <img style="width:250; height:230px; position:relative; top: 70px; margin-top:-50px" class=" align-self-center rounded-circle " src="{{asset('img/nobook.png')}}" style="width: 40px; height:40px;" alt="">
                @endif
            </div>  
            <div class="card-body text-center" style="padding-top: 70px;">
                <p class="card-text"><b>ISBN: </b><i>{{$libro->isbn}}</i></p>
                <p class="card-text"><b>Fecha Publicacion: </b><i>{{$libro->fecha_publicacion}}</i></p>
               <p class="card-text">
                    <b>Estatus: </b>
                    @if($libro->estatus==1)
                    <i class="text-success">Activo</i>
                    @else
                    <i class="text-danger">Desactivado</i>
                    @endif
                </p>
                 <p class="card-text"><b>Autor: </b><i>{{$libro->autor->nombre}}</i></p>
                 <p class="card-text"><b>Genero: </b><i>{{$libro->genero->descripcion}}</i></p>
                 <p class="card-text"><b>Editorial: </b><i>{{$libro->editorial->nombre}}</i></p>
                <center><a href="{{route('libro.index')}}" class="btn btn-sm btn-warning" style="margin: auto;">Regresar</a></center> 
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection