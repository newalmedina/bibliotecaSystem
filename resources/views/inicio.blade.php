@extends("layout.plantilla")
@section("contenido")
<section class="content-header">

    <h1>
  
      Tablero
  
      <small>Panel de Control</small>
  
    </h1>
  
  
  
  </section>
  
  <section class="content">

    <script>

      
    </script>
    <div class="row">
  
      <div class="col-md-3 col-sm-6 col-xs-6">
  
        <div class="small-box bg-primary">
  
          <div class="inner text-center">
  
          <h3>{{count($clientes)}}</h3>
  
            <p>Miembros</p>
            <hr>
            <a href="{{ route('cliente.index')}}" class="text-white info">Mas info <small><i class="fas fa-arrow-circle-right"></i></small></a>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-6">
  
        <div class="small-box bg-success">
  
          <div class="inner text-center">
  
            <h3>{{count($libros)}}</h3>
  
            <p>Libros</p>
            <hr>
            <a href="{{ route('libro.index')}}" class="text-white info">Mas info <small><i class="fas fa-arrow-circle-right"></i></small></a>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-6">
  
        <div class="small-box bg-warning ">
  
          <div class="inner text-center text-white ">
  
            <h3>{{count($editoriales)}}</h3>
  
            <p>Editoriales</p>
            <hr>
            <a href="{{ route('editorial.index')}}" class="text-white info">Mas info <small><i class="fas fa-arrow-circle-right"></i></small></a>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-6 ">
  
        <div class="small-box bg-danger ">
  
          <div class="inner text-center">
  
            <h3>{{count($generos)}}</h3>
  
            <p>Generos</p>
            <hr>
            <a href="{{ route('genero.index')}}" class="text-white info">Mas info <small><i class="fas fa-arrow-circle-right"></i></small></a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div id="" class=" col-md-12 card card-info bg-info pt-1">
  
        <h3 class="card-title  text-white"> <i class="fas fa-th mr-2"></i>Grafico de prestamos</h3>
  
        <div id="myfirstchart" class="text-center" style="height: 250px; width:100%;"></div>
  
      </div>
      <div class=" col-md-6 ">
        <!-- Input addon -->
        <div class="card card-info  border-top border-secondary ">
          <div class="card-header">
            <h3 class="card-title">Libros mas prestados</h3>
          </div>
          <div class="card-body">
            <div>
              <canvas id="myChart"  style="height:200px; min-height:230px"></canvas>
            </div>
  
          </div>
          <!-- /.card-body -->
        </div>
      </div>   
      <!--PRODUCTOS RECIENTES-->
      <div class=" col-md-6 ">
        <!-- Input addon -->
        <div class=" card card-info border-top border-primary">
          <div class="card-header">
            <h3 class="card-title">Libros recientes</h3>
          </div>
          <div class="card-body">
            <table class="table  table-bordered table-striped">
             
              <tbody >
                  @foreach($ultimosLibros as $libro)
                  <tr>
                    @if($libro->portada !="")
                    <td width="80" class="text-center"><img class="img-fluid rounded-circle text-center"  src="{{asset($libro->portada)}}" style="width: 40px; height:40px;" alt=""></td>
                    @else 
                    <td width="80" class="text-center"><img class="img-fluid rounded-circle"  src="{{asset('img/nobook.png')}}" style="width: 40px; height:40px;" alt=""></td>
                    @endif  
                    <td>{{$libro->nombre}}</td>                      
                    <td>{{$libro->genero->descripcion}}</td>                      
                  </tr>
              
                  @endforeach  
              </tbody>
          </table>
            <hr>
            <div class="text-center"> <a href="{{ route('libro.index')}}">Ver Todos los productos</a></div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
     
      @foreach ($prestamos as $prestamo)
          {{$prestamo->cantidad}}
      @endforeach
  </section>
  <script>
    //doughnut chart
     var libros = {!! json_encode($librosMasVendidos) !!};
    var datos=[];   
    var labels=[];
   
    for (let i = 0; i < libros.length; i++) {
      datos[i]=libros[i].cantidad;
      labels[i]=libros[i].nombre;  
    }

    var ctx = document.getElementById('myChart');
    var donutOptions = {
      maintainAspectRatio: false,
      responsive: true,
      borderWidth: 1,
      legend: {
        display: true,
        position: 'right',

      }

    }
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',

        // The data for our dataset
        data: {
            labels:labels,
            datasets: [{
                label: 'My First dataset',
                backgroundColor: ["red", "green", "yellow", "aqua", "purple", "blue", "cyan", "magenta", "orange", "gold"],
                data: datos
            }]
        },

        // Configuration options go here
        options: donutOptions
    });

    new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    
    @foreach ($prestamos as $prestamo)
    @php 
    echo " { y:'".$prestamo->fechaMes."', ventas:".$prestamo->cantidad."},";
    @endphp
   
     @endforeach
  ],
     xkey: 'y',
    ykeys: ['ventas'],
    labels: ['ventas'],
    lineColors: ['black'],
    lineWidth: 2,
    hideHover: 'auto',
    gridTextColor: '#fff',
    gridStrokeWidth: 0.4,
    pointSize: 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor: '#efefef',
    gridTextFamily: 'Open Sans',
    gridTextSize: 10
});
  </script>
@endsection