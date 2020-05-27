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
    <img src="{{asset('img/logo2.png')}}" class="img-fluid" alt="Icono de la empresa">
  </div>
  <div class="container">
    <!-- Datos de la empresa vendedora -->
    <hr>
      <div class="m-2">
        <p class="font-weight-bold">Consulta de productos a nombre del cliente {{$cliente->nombre}}</p>
        <p> Datos del cliente: <br>Telefono: {{$cliente->telefono}}<br>Tipo: {{$cliente->tipo}}<br>Dirección: {{$cliente->direccion}}</p>
        <p>Fecha: {{date("d-m-Y")}}</p>
      </div>

    <!-- Artículos comprados -->
    <div class="row">
      <table class="table">
        <thead class="thead-light">
          <tr>
              <th scope="col">Numero serial</th>
              <th scope="col">Nombre</th>
              <th scope="col">Marca</th>
              <th scope="col">Modelo</th>
              <th scope="col">Almacen</th>
              <th scope="col">Cantidad</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cliente->productos as $producto)
            <tr>
              <th>{{$producto->numero_serie}}</th>
              <td>{{$producto->nombre}}</td>
              <td>{{$producto->marca}}</td>
              <td>{{$producto->modelo}}</td>
              <td>{{$producto->almacene->nombre}}</td>
              <td>{{$producto->cantidad}}</td>
            </tr>

          @endforeach
        </tbody>
      </table>
    </div>
    <div class="page-footer font-small bg-light pt-4">
      <div class="text-center">
        <p>GRACIAS POR CONFIAR EN NOSOTROS</p>
      </div>
    </div>
  </div>

</body>

</html>
