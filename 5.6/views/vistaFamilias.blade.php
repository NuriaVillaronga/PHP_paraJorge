@extends('plantillas.plantillaEstructura')

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
            </tr>
        </thead>
        <tbody>
            @foreach($listaFamilias as $familia)  
                <tr class="text-center">
                    <td>{{$familia->cod}}</td>
                    <td>{{$familia->nombre}}</td>
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