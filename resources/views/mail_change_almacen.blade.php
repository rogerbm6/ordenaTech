<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ORDENATECH</title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                color: #001028;
            }

            header {
                position: fixed;
                left: 0;
                top: -130px;
                right: 0;
                height: 100px;
                text-align: center;
            }

            header img {
                margin: 10px 0;
            }

            header p {
                margin: 0 0 500px;
            }

            main {
                position: absolute;
                left: 0;
                top: 60px;
                right: 0;
                height: 100px;
            }

            footer {
                position: fixed;
                left: 0;
                bottom: -50px;
                right: 0;
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

                <img
                    src="{{ $message->embed(public_path() . '/img/logo2.png') }}"
                    alt="OrdenaTech"
                    class="logo">

            </header>
            <h1 class="lead">
                Cordial saludo,
                {{$almacen_antiguo->nombre}}</h1>
            <hr>
            <div class="main">
                <p>Por favor, no responda a este mensaje, es un envío automático.</p>
                <p class="font-weight-bold">Procedemos a enviarle este correo electronico para informarle
                    <br>
                    sobre el cambio de almacen del producto "{{$producto->nombre}}" al almacen
                    {{$producto->almacene->nombre}} en la isla {{$producto->almacene->isla}} a la dirección {{$producto->almacene->direccion}} con código postal {{$producto->almacene->cp}}, por favor envie el producto lo antes posible</p>

                <h3>Envie todas las unidades</h3>

                <br>
                <br>
                <div class="m-2">

                    <p>
                        Datos del producto:
                        <br>
                        Nombre:{{$producto->nombre}}<br>
                        S/N:{{$producto->numero_serie}}<br>
                        P/N:{{$producto->part_number}}<br>
                        Modelo:{{$producto->modelo}}<br>
                        Incidencia:{{$producto->incidencia}}<br>
                        Marca:{{$producto->marca}}<br>
                        Estado:{{$producto->estado}}<br>
                        Ubicación:{{$producto->ubicacion}}<br>
                        Cantidad:{{$producto->cantidad}}<br>
                    <p>Fecha:
                        {{date("d-m-Y")}}</p>
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