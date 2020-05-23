@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Administracion de Prestamo</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Administracion de Prestamos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">LISTADO DE PRESTAMOS</h3>
        <a href="{{route('prestamo.create')}}" class="btn btn-sm btn-info" style="position:absolute; right: 20px;">Nuevo Prestamo</a><br>
    </div>
    <!-- /.card-header --> 
     <div class="card-body table-responsive">
        <div class="row  mb-3">
            <select onchange="ajaxRequest()" name="" id="estatus" class=" col-sm-4 col-md-2 custom-select select2">
                <option value="all" selected >Todos</option>
                <option value="1" >Devueltos</option>
                <option value="0">Pendientes</option>
            </select>
        </div>
        <table id="dtPrestamo" style="width: 100%" class="table  table-bordered table-striped ">
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
                    <th width="150">ACCIONES</th>
                </tr>
            </thead>
            <tbody id="resultado">
                @foreach ($prestamos as $prestamo)
                    <tr>
                        <td hidden >{{$prestamo->id}}</td>
                        <td>{{$prestamo->codigo}}</td>
                        <td>{{$prestamo->fecha_inicial}}</td>
                        <td>{{$prestamo->fecha_final}}</td>
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
                        <td>
                            
                            <a  class='btn btn-info mr-1 'href="{{action('PrestamoController@show',$prestamo->id)}}"><i class='fas fa-eye'></i></a>
                            <a  target="_blank" class='btn btn-success mr-1 'href="{{action('PdfController@index',$prestamo->id)}}"><i class='fas fa-print'></i></a>
                            <button  name="btnBorrar" class="btn btn-danger " onclick="eliminar({{$prestamo->id}}, 'prestamo/eliminar')" ><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script>
 
 function ajaxRequest() {  
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var estatus = document.getElementById("estatus").value;
            var ruta= "prestamo/ajaxRequest";
           // alert ("datos del estatus "+ estatus_id+ruta);
            $.ajax({
                type: 'GET',
                url: '/' + ruta + '/' + estatus,
                dataType: 'json',
                success: function (data) {
                    console.log(data['prestamos']);   
                    var tabla = "";
                    var estatus="";
                   
                   if(data['prestamos'].length==0){
                       tabla=`<tr class="text-center"><td  colspan="8">No data available in table</td></tr>`;
                   }
                   
                    for(let item of  data['prestamos']){
                        if(item.estatus)
                            estatus=`<td class='bg-success  '>Devuelto</td> `;
                        else
                            estatus=`<td class='bg-warning  '>Pendiente</td> `;                        

                        
                        tabla += `
                        <tr>
                            <td hidden >${item.id}</td>
                            <td>${item.codigo}</td>
                            <td>${item.fecha_inicial}</td>
                            <td>${item.fecha_final}</td>
                            <td>${item.cliente.nombre} ${item.cliente.apellidos} </td>
                            <td>${item.cliente.identificacion}</td>
                            <td class="text-center">
                                ${item.prestamo_detalles.length}                 
                            </td>                       
                             ${estatus}
                            <td>
                                <a  class='btn btn-info mr-1 'href="prestamo/show/${item.id}"><i class='fas fa-eye'></i></a>
                                <a  target="_blank" class='btn btn-success mr-1 'href="pdf/${item.id}"><i class='fas fa-print'></i></a>
                                <button  name="btnBorrar" class="btn btn-danger " onclick="eliminar(${item.id}, 'prestamo/eliminar')" ><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        `;
                    }
                     
                    document.getElementById("resultado").innerHTML= tabla;
                   // console.log(data['prestamos'].codigo);
                   
                                   
                },
                error: function (data) {
                    console.log(data);
                }
            });
 }

</script>

@endsection
