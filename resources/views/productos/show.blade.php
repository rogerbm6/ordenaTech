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
@extends('layouts.master') @section('content')

<div class="col-md-11 m-2 p-2">

    @if (session('info'))
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="alert alert-success">
                {{session('info')}}
            </div>
        </div>
    </div>
    @endif

</div>

<div class="row">
    <div class="col-md-7 col-sm-5 mb-2">
        <div class="card">
            <div class="card-header">
                Producto
            </div>
            <div class="card-body">
                <h5 class="card-title">Datos del producto</h5>
                <div class="row mb-4 ml-1 ">
                    <div class="col-sm-12 col-md-5 p-2">
                        <p class="card-text">
                            <span class="font-weight-bold">S/N:</span>
                            {{$producto->numero_serie}}</p>

                        <p class="card-text">
                            <span class="font-weight-bold">P/N:</span>
                            {{$producto->part_number}}</p>

                        <p class="card-text">
                            <span class="font-weight-bold">Nombre:</span>
                            {{$producto->nombre}}</p>

                        <p class="card-text">
                            <span class="font-weight-bold">Marca:</span>
                            {{$producto->marca}}</p>
                    </div>
                    <div class="col-sm-12 col-md-5 p-2">
                        <p class="card-text">
                            <span class="font-weight-bold">Incidencia:</span>
                            {{$producto->incidencia}}</p>

                        <p class="card-text">
                            <span class="font-weight-bold">Modelo:</span>
                            {{$producto->modelo}}</p>

                        <p class="card-text">
                            <span class="font-weight-bold">Estado:</span>
                            {{$producto->estado}}</p>

                        <p class="card-text">
                            <span class="font-weight-bold">Ubicación:</span>
                            {{$producto->ubicacion}}</p>

                    </div>
                </div>
                <div class="row mt-2 mb-4">
                    <div class="col-md-3">
                        <p class="h3">Cantidad:
                            {{$producto->cantidad}}</p>
                    </div>
                    <div class="col-md-9 pt-2">
                        <p class="h5">
                            {{$producto->notas}}</p>
                    </div>
                </div>
                @can ('productos.edit')
                <a
                    type="button"
                    href="{{route('producto.edit',$producto->id)}}"
                    class="btn btn-warning">
                    <i class="fas fa-user-edit"></i>
                    Editar</a>
                @endcan @can ('productos.edit')
                <!-- Button trigger modal -->
                <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#exampleModal">
                    <i class="fas fa-exchange-alt"></i>
                    Enviar a almacen
                </button>

                <!-- Modal -->
                <div
                    class="modal fade"
                    id="exampleModal"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cambio de almacen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form
                                method="post"
                                action="{{route('producto.almacen', $producto->id)}}"
                                enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="modal-body">

                                    <h5>Elige el almacen al que quieres enviar el producto</h5>
                                    <fieldset class="form-group">
                                        <label for="almacen">Almacén</label>
                                        <select class="custom-select" name="almacen">
                                            @foreach ($almacenes as $almacen)
                                            <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                            @endforeach

                                        </select>
                                    </fieldset>
                                    <hr>
                                        <h5>¿Cuantas unidades quieres enviar?</h5>
                                        <fieldset class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input
                                                type="number"
                                                id="cantidad"
                                                name="cantidad"
                                                class="form-control"
                                                value="{{$producto->cantidad}}"></fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                                            Enviar
                                        </button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        @endcan @can ('productos.destroy')
                        <form
                            action="{{route('producto.destroy',$producto->id)}}"
                            method="POST"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger" style="display:inline">
                                <i class="fas fa-trash"></i>
                                Borrar
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-7">
                <div class="row mb-2">
                    @can ('clientes.index')
                    <div class="col-md-12 mb-2">
                        <div class="card">
                            <div class="card-header">
                                Cliente
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Datos del Cliente</h5>
                                <div class="row mb-4 ml-1 float-sm-left">
                                    <div class="col-sm-12 col-md-5 p-2">
                                        <p class="card-text">
                                            <span class="font-weight-bold">Nombre:</span>
                                            {{$producto->cliente->nombre}}</p>

                                        <p class="card-text">
                                            <span class="font-weight-bold">Telefono:</span>
                                            {{$producto->cliente->telefono}}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-5 p-2">
                                        <p class="card-text">
                                            <span class="font-weight-bold">Tipo:</span>
                                            {{$producto->cliente->tipo}}</p>

                                        <p class="card-text">
                                            <span class="font-weight-bold">Direccón:</span>
                                            {{$producto->cliente->direccion ?:'No tiene'}}</p>

                                    </div>
                                </div>
                                <a
                                    href="{{route('clientes.show',$producto->cliente->id)}}"
                                    class="btn btn-primary">Ir al cliente</a>
                            </div>
                        </div>
                    </div>
                    @endcan @can ('almacenes.index')

                    <div class="col-md-12 mb-2">
                        <div class="card">
                            <div class="card-header">
                                Almacen
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Datos del Almacen</h5>
                                <div class="row mb-4 ml-1 float-left">
                                    <div class="col-sm-12 col-md-5 p-2 float-left">
                                        <p class="card-text">
                                            <span class="font-weight-bold">Nombre:</span>
                                            {{$producto->almacene->nombre}}</p>

                                        <p class="card-text">
                                            <span class="font-weight-bold">Isla:</span>
                                            {{$producto->almacene->isla}}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-5 p-2">
                                        <p class="card-text">
                                            <span class="font-weight-bold">CP:</span>
                                            {{$producto->almacene->cp}}</p>

                                        <p class="card-text">
                                            <span class="font-weight-bold">Direccón:</span>
                                            {{$producto->almacene->direccion ?:'No tiene'}}</p>

                                    </div>
                                </div>
                                @can ('almacenes.show')
                                <a
                                    href="{{route('almacenes.show',$producto->almacene->id)}}"
                                    class="btn btn-primary">Ir al almacen</a>
                                @endcan

                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>

        @stop