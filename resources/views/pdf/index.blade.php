<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblioteca system</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body{
            font-size: 10px;
        }
        img{
            width: 150px;
             height:75px;
             filter: grayscale(100%);
        }
    </style>
</head>
<body>
    
        <header class="row">
               <div class=" text-center">
                   <img src="{{ asset($configuracion->foto) }}"alt="">
                    <p style="  margin-top:-15px;">
                        {{$configuracion->nombre_biblioteca}} <br>
                        {{$configuracion->direccion}} <br> 
                        {{$configuracion->telefono}} <br>  
                        {{$configuracion->correo}}
                  
                    </p>
                </div>
        </header>      
    
        <section  >
                <p  style="font-size: 10px; list-style: none;">
                    Codigo del prestamo: <i><b>{{$prestamo->codigo}}</b></i> <br>
                    Codigo del prestamo: <i><b>{{$prestamo->cliente->nombre}} {{$prestamo->cliente->apellidos}}</b></i> <br>
                    Fecha de adquisicion: <i><b>{{$prestamo->fecha_inicial}}</b></i><br>
                   Fecha de devolucion: <i><b>{{$prestamo->fecha_final}}</b></i>
                </p>  
                <p  style="font-size: 10px; list-style: none;">
                    Listado de libros:
                </p> 

                <table class="">
                    <thead  style="font-size: 8px; border:1px; margin-bottom: 5px; border-bottom-style:  solid;" >
                        <tr>
                            <th style="padding:2px;">Nombre </th>
                            <th  style="padding:2px;">Editorial</th>
                            <th  style="padding:2px;">Genero</th>
                            <th  style="padding:2px;">Autor</th>
                        </tr>
                    </thead>
                    <tbody  style="font-size: 9px;">
                        @foreach ($prestamo->prestamo_detalles as $libro)
                            <tr style=" border-bottom-style:  solid;">
                                <td style="padding:2px;">{{$libro->libro->nombre}}</td>
                                <td style="padding:2px;">{{$libro->libro->editorial->nombre}}</td>
                                <td style="padding:2px;">{{$libro->libro->genero->descripcion}}</td>
                                <td style="padding:2px;">{{$libro->libro->autor->nombre}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>    
        </section> 
        <footer>
            <br>
            <br>
            <br>
            <p>!!Muchas Gracias por </p>
        </footer>
</body>
</html>