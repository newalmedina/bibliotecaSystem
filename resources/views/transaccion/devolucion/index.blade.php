@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Devoluciones de Prestamo</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Devoluciones de Prestamos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">LIBROS PENDIENTES</h3>
   </div>
    <!-- /.card-header --> 
     <div class="card-body table-responsive">
        
        <table id="dtDevolucion" style="width: 100%" class="table  table-bordered table-striped ">
            <thead>
                <tr>
                    <th hidden width="15">ID</th>          
                    <th width="15">CODIGO</th>                 
                    <th width="120">FECHA PRESTAMO</th>
                    <th width="100">FECHA FINAL</th>
                    <th>CLIENTE</th>
                    <th>IDENTIFICACION</th>
                    <th width="15"># LIBROS</th>   
                    <th width="100">ESTATUS</th>
                    <th class="text-center" width="50">Devolver</th>
                </tr>
            </thead>
            <tbody id="resultado">
                @foreach ($prestamos as $prestamo)
                    <tr>
                        <td hidden >{{$prestamo->id}}</td>
                        <td>{{$prestamo->codigo}}</td>
                        <td>{{$prestamo->fecha_inicial}}</td>                    
                      
                       
                        @if (date("Y-m-d") > $prestamo->fecha_final)
                             <td class="text-danger">{{ $prestamo->fecha_final}} vencido </td>
                        @else
                             <td>{{ $prestamo->fecha_final}}</td>
                        @endif
                        
                        <td>{{$prestamo->cliente->nombre}} {{$prestamo->cliente->apellidos}}</td>
                        <td>{{$prestamo->cliente->identificacion}}</td>
                        <td class="text-center">
                            {{count($prestamo->prestamo_detalles)}}                           
                        </td>
                        @if(!$prestamo->estatus != 1)
                            <td class='bg-success  '>Devuelto</td>
                        @else
                            <td class='bg-warning '>Pendiente</td>
                        @endif
                        <td class="text-center">
                          <a  class='btn btn-success mr-1 'href="{{action('DevolucionController@devolverForm',$prestamo->id)}}"><i class="fas fa-thumbs-up"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script>
     $('#dtDevolucion').DataTable({
        "order": [[3, "asc"],[2, "asc"]]
    });
</script>
@endsection