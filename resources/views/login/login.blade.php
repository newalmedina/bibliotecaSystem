@extends("layout.plantilla2")
@section("contenido")
<body class="hold-transition login-page">

    <div class="login-box m-auto">
        <div class="login-logo">
            <img src="{{asset('img/library logo.png')}}" class='img-fluid' alt="">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <form action="{{route('login')}}" method="POST">
                    {{csrf_field()}}
                   
                    <div class="input-group mb-3">
                        
                        <input id="correo" type="correo" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}"   autofocus>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if($errors->has('correo'))
                        <div class="text-danger font-italic">{{ $errors->first('correo') }}</div>
                        @endif
                    </div>
                      
                    <div class="input-group mb-3">
                        <input type="password" name='password' class="form-control @error('email') is-invalid @enderror" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div><br>
                        @if($errors->has('password'))
                        <div class="text-danger font-italic">{{ $errors->first('password') }}</div>
                        @endif                               
                    </div>


                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" name="acceder" class="btn btn-primary btn-block">Acceder</button>
                    </div>

                </form>


                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
        @endsection  