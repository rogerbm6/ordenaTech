{{-- Copyright (c) 2020 <YOUR NAME>

GNU GENERAL PUBLIC LICENSE
   Version 3, 29 June 2007

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>. --}}

<!DOCTYPE html>
<html lang="es" dir="ltr">

    <head>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>{{ config('app.name', 'Inventario') }}</title>

                @if (Request::route()->getName()=='producto.show')
                <link
                    rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"/>
                @endif

                <!-- Theme CSS -->
                <link rel="stylesheet" href="{{asset('css/theme-5.css')}}"/>
                <link
                    rel="stylesheet"
                    type="text/css"
                    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
                <link
                    rel="stylesheet"
                    type="text/css"
                    href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"/>

                <script
                    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"
                    charset="utf-8"></script>

            </head>

            <body class="fondo">
                {{-- barra de navegación --}}
                @include('partials.navbar')

                <div class="main-wrapper">
                    <div class="container-fluid mt-5">
                        @yield('content')
                    </div>

                    @include('partials.footer')
                </div>

                <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

                <script
                    type="text/javascript"
                    src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
                <script
                    type="text/javascript"
                    src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
                <script
                    type="text/javascript"
                    src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

                <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                @if (Request::route()->getName()=='producto.show')
                @if(count($producto->unids)>0)
                <script
                    src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                <!-- buscador de referencia(albaranes) en producto.show -->
                <script>
                    $(function () {
                        @foreach($producto ->unids as $unid)

                        $("#referencia{{$unid->id}}").autocomplete({
                            source: function (request, response) {
                                $.ajax({
                                    url:        "{{route('albaran.search')}}",
                                    dataType:   "json",
                                    data:{
                                        term:request.term
                                    },
                                    success:function (data) {
                                        response(data);
                                    }
                                });
                            }
                        });

                        @endforeach
                    });
                </script>
                @endif @endif @include('partials.tables') @include('partials.popup')

                <!-- FontAwesome JS-->
                <script
                    defer="defer"
                    src="https://use.fontawesome.com/releases/v5.7.1/js/all.js"
                    integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7"
                    crossorigin="anonymous"></script>

            </body>

        </html>