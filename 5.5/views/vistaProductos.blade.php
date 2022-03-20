@extends('plantillas.plantillaEstructura') {{--Se relaciona la vista con la plantilla que establece la estructura de la página--}}

@section('titulo')
    {{$titulo}}
@endsection

@section('encabezado')
    {{$encabezado}}
@endsection

@section('contenido')
    <table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Nombre Corto</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listaProductos as $producto)  
                <tr class="text-center">
                    <th scope="row">{{$producto->id}}</th>
                    <td>{{$producto->nombre}}</td>
                    <td>{{$producto->nombre_corto}}</td>
                    @if($producto->pvp>100)
                        <th class='text-danger'>{{$producto->pvp}} €</th>
                    @else
                        <th class='text-success'>{{$producto->pvp}} €</th>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <center>
        <form class="form">
            <p>
                <br><button type="submit" class="btn btn-primary" formaction="../public/portada.php">Volver ao inicio</button>
            </p>
        </form>
    </center>
@endsection