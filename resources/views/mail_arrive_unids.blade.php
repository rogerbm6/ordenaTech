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
                {{$almacen_nuevo->nombre}}</h1>
            <hr>
            <div class="main">
                <p>Por favor, no responda a este mensaje, es un envío automático.</p>
                <p class="font-weight-bold">Procedemos a enviarle este correo electronico para informarle
                    <br>
                    sobre el cambio de almacen del producto "{{$producto->nombre}}" de "{{$producto->almacene->nombre}}"al almacen<br>
                    "{{$almacen_nuevo->nombre}}" en la<br>
                    isla
                    {{$almacen_nuevo->isla}}
                    a la dirección
                    <br>{{$almacen_nuevo->direccion}}
                    con código<br>
                    postal
                    {{$almacen_nuevo->cp}}, por favor verifique el cambio en el sistema
                </p>
                <br>
                <br>
                <h2 class="font-weight-bold">Los productos con este Numero de serie</h2>
                <br>
                <ul class="list-unstyled p-2" style="list-style: none; margin-right: 3%;">
                    <div class="row">

                        <div>

                            @foreach ($unids as $unidad)
                            <p>
                                <li>
                                    {{$unidad->numero_serie}}
                                    <em>({{$unidad->estado}})</em><br>
                                </li>
                            </p>

                            @endforeach

                        </div>

                    </div>
                </ul>
                <div class="m-2">

                    <p class="font-weight-bold">Producto
                        {{$producto->nombre}}<br>
                        Part Number:
                        {{$producto->part_number}}<br>
                        Incidencia :
                        {{$producto->incidencia}}<br>
                    </p>
                    <p>
                        Datos del cliente:
                        <br>
                        Nombre:{{$producto->cliente->nombre}}<br>
                        Email:{{$producto->cliente->email}}<br>
                        Telefono:{{$producto->cliente->telefono}}<br>
                        Tipo:{{$producto->cliente->tipo}}<br>
                        Dirección:{{$producto->cliente->direccion ?: 'No tiene'}}</p>
                    <h4>Fecha:
                        {{date("d-m-Y")}}</h4>
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