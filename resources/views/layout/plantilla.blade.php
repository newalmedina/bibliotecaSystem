<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Biblioteca Sistem</title>
        @include("layout.links")
        @include("layout.scripts")
    </head>

    @if(Session::has('success'))
    
    <script>
        $(document).ready(function(){
            var success = "{{Session::get('success')}}";
            var mensaje = "{{Session::get('mensaje')}}";
            swal({
            title: success,
            text: "Operacion realizada Correctamente",
            icon: "success",
            timer: 2000,
            buttons: false
            });
        });        
    </script>        
    @endif
    @include("layout.header")

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            @include("layout.navbar")

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">                        
                        @yield("contenido") 
                    </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        @include("layout.footer")
        
        <script>
           
            $(document).ready(function() {
            $('.select2').select2();
           
            $('#dataTable').DataTable();

        });
        </script>
    </body>
</html>