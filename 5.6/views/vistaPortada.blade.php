@extends('plantillas.plantillaEstructura')

@section('titulo')
    {{$titulo}}
@endsection

@section('encabezado')
    {{$encabezado}}
@endsection

@section('contenido')
    <center>
        <form class="form">
            <p>
                <br><button type="submit" class="btn btn-primary" formaction="../public/productos.php">Ver productos</button>
            </p>
            <p>
                <br><button type="submit" class="btn btn-primary" formaction="../public/familias.php">Ver familias</button>
            </p>
        </form>
    </center>
@endsection