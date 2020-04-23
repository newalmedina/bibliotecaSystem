<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary  elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('img/library logo.png')}}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Lybrary System</span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
  
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
          <li id="user_permisos" class="nav-item">
            <a href="{{ route('usuario.index')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li id="categoria_permisos" class="nav-item">
            <a href="{{ route('cliente.index')}}" class="nav-link">
             <i class="nav-icon fas fa-users"></i>
              <p>
                Miembros
              </p>
            </a>
          </li>
          <li id="categoria_permisos" class="nav-item">
            <a href="{{ route('autor.index')}}" class="nav-link">
             <i class="nav-icon fas fa-users"></i>
              <p>
                Autores
              </p>
            </a>
          </li>
          <li id="productos_permisos" class="nav-item">
            <a href="{{ route('editorial.index')}}" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-v"></i>
              <p>
                Editoriales
              </p>
            </a>
          </li>
          <li id="cliente_permisos" class="nav-item">
            <a href="{{ route('genero.index')}}" class="nav-link">
              
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Generos
              </p>
            </a>
          </li>
          <li id="cliente_permisos" class="nav-item">
            <a href="{{ route('libro.index')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Libros
              </p>
            </a>
          </li>
          <li id="venta_permisos" class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Tansacciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?directorio=venta&pagina=index.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Prestamo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?directorio=venta&pagina=add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Renavacion</p>
                </a>
              </li>
              <li id="rep_venta_permisos" class="nav-item">
                <a href="index.php?directorio=venta&pagina=reporte.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Devolucion</p>
                </a>
              </li>
            </ul>
          </li>
          <li id="cliente_permisos" class="nav-item">
            <a href="{{ route('configuration.index')}}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Configuracion
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>