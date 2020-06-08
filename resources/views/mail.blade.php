<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AD3D GEO-INGENIERÍA</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #001028;
        }

        header {
            position: fixed;
            left: 0px;
            top: -130px;
            right: 0px;
            height: 100px;
            text-align: center;
        }

        header img {
            margin: 10px 0;
        }

        header p {
            margin: 0 0 500px 0;
        }

        main {
            position: absolute;
            left: 0px;
            top: 60px;
            right: 0px;
            height: 100px;
        }

        footer {
            position: fixed;
            left: 0px;
            bottom: -50px;
            right: 0px;
            height: 40px;
        }

        footer table {
            width: 100%;
        }

        footer .centro {
            text-align: center;
        }

        .logo {
            height: 70px;
        }

        .gracias {
            text-align: center;
        }

        .main {
            text-align: center;
        }
    </style>

<body>
    <header>

        <img src="{{ $message->embed(public_path() . '/img/logo2.png') }}" alt="OrdenaTech" class="logo">

    </header>
    <h1 class="lead"> Cordial saludo, {{$usuario->name}}</h1>
    <hr>
    <div class="main">
        <p>Por favor, no responda a este mensaje, es un envío automático.</p>
        <p class="font-weight-bold">Procedemos a enviarle este correo electronico para informarle <br> que uno de los productos del almacen {{$producto->almacene->nombre}} ha reducido su cantidad a {{$producto->cantidad}}</p>

        <br>
        <br>
        <div class="m-2">

            <p class="font-weight-bold">Producto {{$producto->nombre}} en cantidad minima </p>
            <p> Datos del cliente: <br>Nombre: {{$producto->cliente->nombre}} <br>Telefono: {{$producto->cliente->telefono}}<br>Tipo: {{$producto->cliente->tipo}}<br>Dirección: {{$producto->cliente->direccion ?: 'No tiene'}}</p>
            <p>Fecha: {{date("d-m-Y")}}</p>
        </div>

    </div>

    <footer>
        <table>
            <tr>
                <td class="gracias">
                    <p>GRACIAS POR CONFIAR EN NOSOTROS</p>
                </td>
            </tr>
        </table>
    </footer>


</body>

</html>
