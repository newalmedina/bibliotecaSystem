
@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">VISUALIZANDO MIEMBRO: {{$cliente->id}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('cliente.index')}}">Administracion de Miembros</a></li>
                   
                    <li class="breadcrumb-item active">Visualizacion de miembro</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header ">
        <h4 class=" text-center">{{$cliente->nombre}} {{$cliente->apellidos}}</h4>

    </div>
    <!-- /.card-header --> 
    <div class="card-body d-flex justify-content-center">



        <div class="row border rounded" style="width:600px">
           <div class=" col-md-6" style=""> 
            <div class="row ">
                @foreach ($cliente->documentacionFotos  as $documento )
                <div class="col-md-12 pt-2 d-flex align-items-center justify-content-center">
                    <img class="mb-2  img-thumbnail"  src="{{asset($documento->foto)}}" style="width: 400px; height:200px;" >          
                </div>                
                @endforeach
            </div>
        
            
            </div>
            <div class="text-left col-md-6" style="padding-top: 50px;">
                <p class="card-text"><b>Identificacion: </b><i>{{$cliente->identificacion}}</i></p>
                <p class="card-text"><b>Fecha de Nacimiento: </b><i>{{$cliente->fecha_nacimiento}}</i></p>
                <p class="card-text"><b>Correo: </b><i>{{$cliente->correo}}</i></p>
                 <p class="card-text">
                    <b>Estatus: </b>
                    @if($cliente->estatus==1)
                    <i class="text-success">Activo</i>
                    @else
                    <i class="text-danger">Desactivado</i>
                    @endif
                </p>
                 <p class="card-text"><b>Telefono: </b><i>{{$cliente->telefono}}</i></p>
                 <p class="card-text"><b>Direccion: </b><br><i>{{$cliente->direccion}}</i></p>
                <center><a href="{{route('cliente.index')}}" class="btn btn-sm btn-warning mb-2" style="margin: auto;">Regresar</a></center> 
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection