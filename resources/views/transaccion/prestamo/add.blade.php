@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Administracion de Generos</h1>
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
        <h3 class="card-title">NUEVO PRESTAMO</h3>
        <a href="{{route('prestamo.index')}}" class="btn btn-sm btn-warning" style="position:absolute; right: 20px;">Regresar</a><br>

    </div>
    <form id="form" method="POST" action="{{route('prestamo.store')}}" onsubmit="return  validarAlquiler()">
        {{ csrf_field() }}
        <!-- /.card-header --> 
        <div class="card-body table-responsive">
            <h5 class="text-success">Libros maximos permitidos por miembros: {{$librosPermitidos}}</h5>
            <!-- PRESTAMO CABECERA -->
            <div class="row">
                <div class="col-md-4 col-12"> 
                    <input type="hidden" name="usuario_id" value="{{auth()->user()->id}}">
                    <label for="">Datos del bibliotecario</label>
                    <input type="text" disabled class="form-control" value="{{auth()->user()->nombre}} {{auth()->user()->apellidos}}">
                </div>
                <div class="col-md-4 col-12">                
                    <label for="">Documentacion y nombre del miembro</label>
                    <select name="cliente_id" id="cliente_id" class="custom-select select2" required onchange="comprobarPrestamos()">
                        <option  value="">Seleccione</option>
                        @foreach($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->identificacion}}   --  {{$cliente->nombre}} {{$cliente->apellidos}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('cliente_id'))
                    <div class="text-danger font-italic">{{ $errors->first('cliente_id') }}</div>
                    @endif    
                </div>
            </div>
            <h6 id="num_libros" class="text-danger"></h6>
            
            <hr>
            <!-- PRESTAMO DETALLE -->
            <div id="divLibros"   class="row">
            
                    <div class="col-md-12">
                    <table width="100%" class=" table">
                        <thead class=" bg-secondary">
                        <tr>
                            <th>NOMBRE</th>
                            <th>ISB</th>
                            <th>Autor</th>                   
                            <th>Editorial</th>                   
                            <th>Genero</th>   
                            <th width="15"></th>   
                        </tr>
                        </thead>
                        <tbody id="addLibros">
                        
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>
        <div class="card-footer">      

            <!-- LISTADO DE LIBROS-->
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <button type="button" id="addLibro" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        Añadir libro
                    </button>
                    <input id="alquilar" type="submit" value="Realizar alquiler"  class="btn btn-success">
                </div>               
            </div>
        </div>
    </form>
    <div class="col-12">
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title text-success">Listado de libros disponibles</h4>
                <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                <table id="dataTable" class="table  table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="40">PORTADA</th>
                            <th width="15">ID</th>          
                            <th>NOMBRE</th>
                            <th>ISBN</th>
                            <th>Autor</th>                   
                            <th>Editorial</th>                   
                            <th>Genero</th>              
                            <th width="15">Disponible</th>                                  
                            <th width=""></th>
                        </tr>
                    </thead>
                    <tbody id="resultado">
                        @if($libros->count())
                        @foreach($libros as $libro)
                        <tr>
                            
                            @if($libro->portada !="")
                            <td class="text-center"><img class="img-fluid rounded-circle text-center"  src="{{asset($libro->portada)}}" style="width: 40px; height:40px;" alt=""></td>
                            @else 
                            <td class="text-center"><img class="img-fluid rounded-circle"  src="{{asset('img/nobook.png')}}" style="width: 40px; height:40px;" alt=""></td>
                            @endif
                            <td>{{$libro->id}}</td>                   
                            <td>{{$libro->nombre}}</td>
                            <td>{{$libro->isbn}}</td>
                            <td>{{$libro->autor->nombre}}</td>
                            <td>{{$libro->editorial->nombre}}</td>
                            <td>{{$libro->genero->descripcion}}</td>                
                            @if($libro->stock - $libro->alquilados > 0)
                            <td class='text-success text-center font-weight-bolder'>{{$libro->stock - $libro->alquilados}}</td>
                            @else
                            <td class='text-danger text-center font-weight-bolder'>{{$libro->stock - $libro->alquilados}}</td>
                            @endif         
                            <td class="text-center">                      
                                @if ( $libro->stock - $libro->alquilados > 0)
                                    <button  id='btn{{$libro->id}}'class='btn btn-success mr-1 ' onclick="agregarLibro('#btn{{$libro->id}}',{{$libro->id}}, '{{$libro->nombre}}','{{$libro->isbn}}','{{$libro->autor->nombre}}','{{$libro->editorial->nombre}}','{{$libro->genero->descripcion}}')"> <i class='fas fa-plus'></i></button>
                                @else
                                <button  disabled  class='btn btn-danger mr-1 '> <i class='fas fa-plus'></i></button>
                                @endif
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
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                
            </div>
            </div>
        </div>
    </div>  
<script>
    

    document.getElementById("addLibro").disabled = true;
    var limite_libro =  {{$librosPermitidos}};
    var libros_alquilados=0;
    var libros_nuevos=0;
  
    function comprobarPrestamos() {  
     

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var cliente_id = document.getElementById("cliente_id").value;
            var ruta= "prestamo/comprobarPrestamos";
            //alert ("datos del cliente "+ cliente_id);
            $.ajax({
                type: 'GET',
                url: '/' + ruta + '/' + cliente_id,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    console.log("success");
                     libros_alquilados=data["numeroLibros"];
                     libros_nuevos=data["numeroLibros"];

                    if(data["numeroLibros"]==0){
                            document.getElementById("num_libros").innerHTML="Este miembro  no tiene libros alquilados, puedes alquilar "+limite_libro;
                            document.getElementById("addLibro").disabled = false;
                    }
                    else if(data["numeroLibros"]>0){
                        document.getElementById("num_libros").innerHTML= "Tienes " +libros_alquilados+" libro/s alquilados, aun  puedes alquilar "+  (parseInt(limite_libro) - parseInt(libros_alquilados)) +" mas";
                        document.getElementById("addLibro").disabled = false;
                    }
                    if(data["numeroLibros"]>=limite_libro){
                        document.getElementById("num_libros").innerHTML= "Tienes " +libros_alquilados+" libro/s alquilados, no puedes seguir alquilando ya que sobrepasaras el limite permitido";
                        document.getElementById("addLibro").disabled = true;
                    }
                   
                },
                error: function (data) {
                    console.log(data);
                    document.getElementById("num_libros").innerHTML= "";
                }
            });
        }
    $("#divLibros").hide();
    //agregarLibro({{$libro->id}}, '{{$libro->nombre}}','{{$libro->isbn}}','{{$libro->editorial}}','{{$libro->genero}}')
    function agregarLibro(btn, libro_id,nombre,isbn,autor,editorial,genero) {
        if(libros_nuevos >= limite_libro){
            swal({
            title: "Advertancia!",
            text: "No puedes seguir alquilando ya que sobre pasarias el limite permitido",
            icon: "warning",
            timer: 3000
            });
        }
        else{

            $("#divLibros").show();
            $(btn).attr("disabled", true);

        var campos = "<tr id='libro" + libro_id + "' name='libros'><td class='text-secondary'>" + nombre + " <input name='libro_id[]' type='hidden' value='" + libro_id + "'></td>";
            campos += "<td> "+isbn+"</td>";
            campos += "<td> "+autor+"</td>";
            campos += "<td> "+editorial+"</td>";
            campos += "<td> "+genero+"</td>";
            campos += "<td class='text-center'> <button  onclick='eliminarLibro(\"#libro" + libro_id + "\",\"" + btn + "\" )' class='btn btn-danger'> <i class='fas fa-times'></i></button> </td></tr>";
            var libro = $("#addLibros").append(campos); 
            libros_nuevos++;
        }

     }
       
    function eliminarLibro(libro, btn) {
        $(btn).attr("disabled", false);
        $(libro).remove();
        libros_nuevos--;
    }
    function validarAlquiler() {
        var libros_seleccionados = document.getElementsByName("libros");
        if (!libros_seleccionados.length) {

        swal({
            title: "!Advertencia",
            text: "No tienes Libros selecionados",
            icon: "warning",
        });
        return false;
        }        


        if (libros_alquilados >= limite_libro) {

        swal({
            title: "!Advertencia",
            text: "No puedes proceder con el alquiler este usuario ya ha sobre pasado el limite de libros permitidos",
            icon: "warning",
        });
        return false;
        }
        
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
    
</div>
@endsection
