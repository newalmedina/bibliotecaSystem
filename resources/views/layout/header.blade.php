 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background:#343a40">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
 
    </ul>
    <ul class="navbar-nav ml-auto btn btndefault" style="background:#343a40">
 
      <li class="dropdown user user-menu">
 
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          @if (auth()->user()->foto!="")
            <img src="{{asset(auth()->user()->foto)}}" alt="photo" class="user-image">
          @else
            <img src="{{asset('img/noimage.jpg')}}" alt="photo" class="user-image">
          @endif
        
         
          <span class="hidden-xs ">{{auth()->user()->nombre}} {{auth()->user()->apellidos}}</span>
 
        </a>
 
        <!-- Dropdown-toggle -->
 
        <ul class="dropdown-menu btn" style="background:#343a40">
 
          <li class="user-body">
 
            <div class="pull-right">
              <form action="{{route('logout')}}" method="POST">
                @csrf
                <button class="btn btn-danger"> cerrar session</button>
             </form>
 
            </div>
 
          </li>
 
        </ul>
 
      </li>
 
    </ul>
    <!-- Right navbar links -->
 
 
  </nav>
  <!-- /.navbar -->