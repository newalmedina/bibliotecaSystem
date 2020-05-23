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
  
        <h3 class="card-title  text-white"> <i class="fas fa-th mr-2"></i>Grafico de Ventas</h3>
  
        <div id="myfirstchart" class="text-center" style="height: 250px; width:100%;"></div>
  
      </div>
      <div class=" col-md-6 ">
        <!-- Input addon -->
        <div class="card card-info  border-top border-secondary ">
          <div class="card-header">
            <h3 class="card-title">Productos mas vendidos</h3>
          </div>
          <div class="card-body">
            <div>
              <canvas id="donutChart" style="height:200px; min-height:230px"></canvas>
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
            <h3 class="card-title">Productos Recientes</h3>
          </div>
          <div class="card-body">
            <table class="table">
                 //grafica productos recientes
            </table>
            <hr>
            <div class="text-center"> <a href="index.php?directorio=producto&pagina=index.php">Ver Todos los productos</a></div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
  </section>
@endsection