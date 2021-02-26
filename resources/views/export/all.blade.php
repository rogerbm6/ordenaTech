@foreach ($productos as $producto)
            @if (count($producto->unids)>0)
                            
            
                <table class="table table-sm mr-2">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col"><b>S/N</b></th>
                            <th scope="col"><b>P/N</b></th>
                            <th scope="col"><b>Nombre</b></th>
                            <th scope="col"><b>Marca</b></th>
                            <th scope="col"><b>Modelo</b></th>
                            <th scope="col"><b>Estado</b></th>
                            <th scope="col"><b>NotasUnidad</b></th>
                            <th scope="col"><b>NotasGenerales</b></th>
                            <th scope="col"><b>Cliente</b></th>
                            <th scope="col"><b>EmailCliente</b></th>
                            <th scope="col"><b>TelefonoCliente</b></th>
                            <th scope="col"><b>Tipo</b></th>
                            <th scope="col"><b>DireccionCliente</b></th>
                            <th scope="col"><b>Almacen</b></th>
                            <th scope="col"><b>EmailAlmacen</b></th>
                            <th scope="col"><b>DireccionAlmacen</b></th>
                            <th scope="col"><b>Codigo postal</b></th>
                            <th scope="col"><b>Isla</b></th>

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
                            <td class="p-2">{{$unid->notas}}</td>
                            <td class="p-2">{{$unid->producto->notas}}</td>
                            <td class="p-2">{{$unid->producto->cliente->nombre}}</td>
                            <td class="p-2">{{$unid->producto->cliente->email}}</td>
                            <td class="p-2">{{$unid->producto->cliente->telefono}}</td>
                            <td class="p-2">{{$unid->producto->cliente->tipo}}</td>
                            <td class="p-2">{{$unid->producto->cliente->direccion}}</td>
                            <td class="p-2">{{$unid->producto->almacene->nombre}}</td>
                            <td class="p-2">{{$unid->producto->almacene->email}}</td>
                            <td class="p-2">{{$unid->producto->almacene->direccion}}</td>
                            <td class="p-2">{{$unid->producto->almacene->cp}}</td>
                            <td class="p-2">{{$unid->producto->almacene->isla}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="17">Total</td>
                            <td><b>{{count($producto->unids)}}</b></td>
                        </tr>
                    </tbody>
                </table>
            
            @endif
            @endforeach