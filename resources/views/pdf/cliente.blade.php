<!DOCTYPE html>
<html lang="es" dir="ltr">

    <head>
        <!-- ======================================= -->
        <meta charset="utf-8">
        <!-- ======================================= -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <!-- ======================================= -->
    </head>

    <body>
        <div class="m-2">
            <img
                src="{{asset('img/logo2.png')}}"
                class="img-fluid"
                alt="Icono de la empresa">
        </div>
        <div class="container">
            <!-- Datos de la empresa vendedora -->
            <hr>
            <div class="m-2">
                <p class="font-weight-bold">Consulta de productos a nombre del cliente
                    {{$cliente->nombre}}</p>
                <p>
                    Datos del cliente<br>
                    Email: {{$cliente->email}}
                    <br>Telefono:{{$cliente->telefono}}<br>
                    Tipo: {{$cliente->tipo}}<br>
                    Dirección: {{$cliente->direccion ?? 'Sin dirección'}}</p>
                <p>Fecha:
                    {{date("d-m-Y")}}</p>
            </div>
          </div>
            <!-- Artículos comprados -->
            @foreach ($cliente->productos as $producto)
            @if (count($producto->unids)>0)
                            
            
            <div class="d-flex justify-content-start">
                <table class="table table-sm mr-2">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">P/N</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Almacen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producto->unids as $unid)
                        <tr>
                            <td class="p-2">{{$unid->numero_serie}}</td>
                            <td class="p-2">{{$unid->producto->part_number}}</td>
                            <td class="p-2">{{$unid->producto->nombre}}</td>
                            <td class="p-2">{{$unid->producto->marca}}</td>
                            <td class="p-2">{{$unid->producto->modelo}}</td>
                            <td class="p-2">{{$unid->estado}}</td>
                            <td class="p-2">{{$unid->producto->almacene->nombre}}</td>
                        </tr>
                        @endforeach
                        <tr class="table-active">
                            <td colspan="6">Total</td>
                            <td class="p-2">{{count($producto->unids)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
            @endforeach
            <div class="page-footer font-small bg-light pt-4">
                <div class="text-center">
                    <p>GRACIAS POR CONFIAR EN NOSOTROS <br>
                    soporte@ordenatech.es</p>
                </div>
            </div>
        

    </body>

</html>