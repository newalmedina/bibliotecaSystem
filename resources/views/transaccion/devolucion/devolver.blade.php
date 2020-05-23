@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Devolucion del prestamo: <small>{{$prestamo->codigo}}</small></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('prestamo.index')}}">Administracion de Prestamos</a></li>
                    <li class="breadcrumb-item active">Nuevo Genero</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card" width="300">
    <div class="card-header">
        <h3 class="card-title">Datos del Prestamo</h3>
        <a href="{{route('devolucion.index')}}" class="btn btn-sm btn-warning" style="position:absolute; right: 20px;">Regresar</a><br>

    </div>

    <form id="form" method="POST" action="{{route('devolucion.devolver',$prestamo->id)}}" onsubmit="return  validarDevuelta()">
        {{ csrf_field() }}
        <!-- /.card-header --> 
        <div class="card-body table-responsive">
           
            <!-- PRESTAMO CABECERA -->
            <div class="row">
                <div class="col-12"> 
                    <ul style="list-style: none">
                        <li><label for="">Nombre y Documentacion del Miembro: </label> {{$prestamo->cliente->nombre}} {{$prestamo->cliente->apellidos}},{{$prestamo->cliente->identificacion}}</li>
                        <li><label for="">Fecha de adquisicion: </label> {{$prestamo->fecha_inicial}}</li>
                        <li><label for="">Fecha maxima de devolucion: </label> {{$prestamo->fecha_final}}</li>
                    </ul>
                </div>
            </div>
               
            <hr>
            <!-- PRESTAMO DETALLE -->
            <div id="divLibros"   class="row">
            
                    <div class="col-md-12">
                    <table width="100%" class=" table">
                        <thead class=" bg-secondary">
                        <tr>
                            <th>NOMBRE</th>
                            <th>ISBN</th>
                            <th>Autor</th>                   
                            <th>Editorial</th>                   
                            <th>Genero</th>   
                            <th width="170">Devuelto</th>   
                        </tr>
                        </thead>
                        <tbody id="">
                            @php
                                $contador=0;
                            @endphp
                            @foreach ($prestamo->prestamo_detalles as $libro)
                            <tr>
                                
                                <td>{{$libro->libro->nombre}}</td>
                                <td>{{$libro->libro->isbn}}</td>
                                <td>{{$libro->libro->autor->nombre}}</td>
                                <td>{{$libro->libro->editorial->nombre}}</td>
                                <td>{{$libro->libro->genero->descripcion}}</td>
                                
                                    @if ($libro->estatus==1)
                                    <td class='bg-info  '>{{$libro->fecha_devolucion}}</td>
                                    @else
                                    <td>
                                    <input class="form-control" type="checkbox" value="{{$libro->libro->id}}" name="libros_id[]">
                                    </td>
                                    @endif
                                    
                                                             
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                        @if($errors->has('libros_id'))
                        <div class=" col-12 text-danger font-italic">{{ $errors->first('libros_id') }}</div>
                        @endif
                   
            </div>
        </div>
        <div class="card-footer">      

            <!-- LISTADO DE LIBROS-->
            <div class="row">
                <div class="col-12 ">
                   
                    <input id="alquilar" type="submit" value="Devolver Libro"  class="float-right btn btn-success">
                </div>               
            </div>
        </div>
    </form>
</div>
<script>
     function validarDevuelta() {
        
        swal({
            title: "Precesando",
            text: "Espera porfavor....",
            icon: "/img/loading.gif",
            button: false,
            closeOnClickOutside: false,
            closeOnEsc: false
        });
        return true;
     }

</script>
@endsection
