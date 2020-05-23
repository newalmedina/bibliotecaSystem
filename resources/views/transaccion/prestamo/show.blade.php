
@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">VISUALIZANDO PRESTAMO: <i>{{$prestamo->codigo}}</i></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('prestamo.index')}}">Historial de prestamos</a></li>
                   
                    <li class="breadcrumb-item active">Visualizacion de prestamo</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header ">        
        <a href="{{route('prestamo.index')}}" class="btn btn-sm btn-warning" style="position:absolute; right: 20px;">Regresar</a><br>
        <ul class="ml-5">
            <li>Nombre y documentacion del miembro: <i><b>{{$prestamo->cliente->nombre}} {{$prestamo->cliente->apellidos}}, {{$prestamo->cliente->identificacion}}</b></i></li>
            <li>Atendido por: <i><b>{{$prestamo->usuario->nombre}} {{$prestamo->usuario->apellidos}}</b></i></li>
            <li>Fecha de adquisicion: <i><b>{{$prestamo->fecha_inicial}}</b></i></li>
            <li class="text-danger">Fecha de devolucion: <i><b>{{$prestamo->fecha_final}}</b></i></li>               
            <li class="text-success">
                Estatus: 
                <i><b>
                @if ($prestamo->estatus==1)
                    Devuelto
                @else
                    Pendiente
                @endif
                </b></i>
            </li>               
                           
        </ul>   
    </div>
    <!-- /.card-header --> 
    <div class="card-body d-flex justify-content-center">
        <table class="table" style="width:80%; margin:15px; ">
            <thead style="padding: 20px;" class="bg-info">
                <tr style="font-weight: bold;">
                    <td>Nombre del libro</td>
                    <td>Editorial</td>
                    <td>Genero</td>
                    <td>Autor</td>
                    <td>Estatus</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestamo->prestamo_detalles as $libro)
                    <tr>
                        <td>{{$libro->libro->nombre}}</td>
                        <td>{{$libro->libro->editorial->nombre}}</td>
                        <td>{{$libro->libro->genero->descripcion}}</td>
                        <td>{{$libro->libro->autor->nombre}}</td>
                        @if($libro->estatus == 1)
                            <td class='text-success text-center '>Devuelto</td>
                        @else
                            <td class='text-warning text-center'>Pendiente</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>                          
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection