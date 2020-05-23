<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblioteca system</title>
    @include("layout.links")
    @include("layout.scripts")
</head>
<body>
    <header class="container-fluid">
        <div class="row">
            <p class="col-12">Muy buenas <label for="">{{$data["cliente"]->nombre}} {{$data["cliente"]->apellidos}}</label>!</p>
       </div>        
    </header>      

    <section class="row">
        <article class="col-12">
            <p >{{$data["mensaje"]}}</p>
            <ul>               
                <li>Atendido por: <i><b>{{$data["prestamo"]->usuario->nombre}} {{$data["prestamo"]->usuario->apellidos}}</b></i></li>
                <li>Codigo del prestamo: <i><b>{{$data["prestamo"]->codigo}}</b></i></li>
                <li>Fecha de adquisicion: <i><b>{{$data["prestamo"]->fecha_inicial}}</b></i></li>
                <li style="color:red;">Fecha de devolucion: <i><b>{{$data["prestamo"]->fecha_final}}</b></i></li>               
                <li>Libros adquiridos : </li>               
            </ul>            
                <div class="col-12 container">
                   
                        <table class="table" style="width:80%; margin:15px; ">
                            <thead style="padding: 20px;">
                                <tr style="font-weight: bold; background-color:aqua;">
                                    <td>Nombre del libro</td>
                                    <td>Editorial</td>
                                    <td>Genero</td>
                                    <td>Autor</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data["detalle"] as $libro)
                                    <tr>
                                        <td>{{$libro->libro->nombre}}</td>
                                        <td>{{$libro->libro->editorial->nombre}}</td>
                                        <td>{{$libro->libro->genero->descripcion}}</td>
                                        <td>{{$libro->libro->autor->nombre}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>                  
                </div>
        </article>        
    </section> 
    <br>
    <br>
    <br>
    <footer class="container-fluid">
        <div class="row">
            <div class="col-3">
                <img style="width:200px;height:160px" src="{{ asset($data["configuracion"]->foto) }}"  alt="">
            </div>
            <div class="col-12">
               
                <p>
                    <h4>{{$data["configuracion"]->nombre_biblioteca}}</h4>
                    {{$data["configuracion"]->direccion}} <br> {{$data["configuracion"]->telefono}} <br>  {{$data["configuracion"]->correo}}
                </p>
            </div>
        </div>
    </footer>  

</body>
</html>