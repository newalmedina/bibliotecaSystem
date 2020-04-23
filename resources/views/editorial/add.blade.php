@extends("layout.plantilla")
@section("contenido")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Administracion de Editoriales</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('editorial.index')}}">Administracion de Editoriales</a></li>
                    <li class="breadcrumb-item active">Nueva Editorial</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card" width="300">
    <div class="card-header">
        <h3 class="card-title">NUEVA EDITORIAL</h3>
        <a href="{{route('editorial.index')}}" class="btn btn-sm btn-warning" style="position:absolute; right: 20px;">Regresar</a><br>

    </div>

    <!-- /.card-header -->
    <form role="form" action="{{route('editorial.store')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-12">
                        <label for="nombre">Nombre</label>
                        <input value="{{ old('nombre') }}" type="text"  class="form-control" id="nombre" name="nombre" maxlength="100" minlength="5" required >
                        @if($errors->has('nombre'))
                        <div class="text-danger font-italic">{{ $errors->first('nombre') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
@endsection
