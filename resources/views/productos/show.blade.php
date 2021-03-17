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
    @endif @if ($errors->any())
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
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
                                <span class="font-weight-bold">Ubicación:</span>
                                {{$producto->ubicacion}}</p>

                        </div>
                    </div>
                    <div class="row mt-2 mb-4">
                        <div class="col-md-3">
                            <p class="h3">Cantidad:
                                {{count($producto->unids)}}</p>
                        </div>
                        <div class="col-md-9 pt-2">
                            <p class="h5">
                                "{{$producto->notas}}"</p>
                        </div>
                    </div>

                    <!-- Button trigger modal VER UNIDADES-->
                    <button
                        type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#verUnidades">
                        <i class="fas fa-eye"></i>
                        Ver unidades
                    </button>

                    <!-- Modal -->
                    <div
                        class="modal fade"
                        id="verUnidades"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Lista de productos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="row ">
                                                @foreach ($producto->unids as $unidad)

                                                <fieldset class="form-group col-md-3 col-sm-12">
                                                    <form
                                                        method="post"
                                                        action="{{route('unid.update', $unidad->id)}}"
                                                        enctype="multipart/form-data"
                                                        class="form-group"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        {{ method_field('PUT') }}
                                                        <input
                                                            type="text"
                                                            class="form-control m-md-0 m-sm-2"
                                                            id="numero_serie"
                                                            name="numero_serie"
                                                            value="{{$unidad->numero_serie}}"></fieldset>
                                                        <fieldset class="form-group col-md-2 col-sm-12">

                                                            <select class="custom-select " name="estado">
                                                                <option selected="selected">{{$unidad->estado}}</option>

                                                                <option value="usado">Usado</option>

                                                                <option value="nuevo">Nuevo</option>

                                                                <option value="averiado">Averiado</option>

                                                                <option value="doa">DOA</option>

                                                            </select>
                                                        </fieldset>

                                                        <div class="form-group col-md-5 col-sm-12">
                                                            <textarea class="form-control" id="notas" name="notas" rows="01">{{$unidad->notas}}</textarea>
                                                        </div>

                                                        <div class="col-md-2 col-sm-12 my-md-0 mb-sm-2">
                                                            @can ('productos.edit')
                                                            <button type="submit" class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            @endcan

                                                        </form>
                                                        <form
                                                            action="{{route('unid.destroy',$unidad->id)}}"
                                                            method="POST"
                                                            style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {!! csrf_field() !!} @can ('productos.destroy')
                                                            <button
                                                                type="submit"
                                                                class="btn btn-danger my-md-0 mb-sm-2"
                                                                style="display:inline">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            @endcan
                                                        </form>
                                                    </div>
                                                    @endforeach

                                                </div>

                                            </div>

                                        </div>

                                        <p class="d-flex justify-content-center">
                                            @can ('productos.create')
                                            <a
                                                class="btn btn-primary m-3 "
                                                data-toggle="collapse"
                                                href="#collapseExample"
                                                role="button"
                                                aria-expanded="false"
                                                aria-controls="collapseExample">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            @endcan
                                        </p>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <form
                                                    method="post"
                                                    action="{{route('unid.store', $producto->id)}}"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="d-flex justify-content-md-center">
                                                        <div class="p-4">
                                                            <fieldset class="form-group">
                                                                <label for="numero_serie">Numero de serie</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    id="numero_serie"
                                                                    name="numero_serie"
                                                                    value="{{old('numero_serie')}}"></fieldset>

                                                                <fieldset class="form-group">
                                                                    <label for="estado">Estado</label>
                                                                    <select class="custom-select" name="estado" required="required">

                                                                        <option value="usado">Usado</option>

                                                                        <option value="nuevo">Nuevo</option>

                                                                        <option value="averiado">Averiado</option>

                                                                        <option value="doa">DOA</option>

                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                            <div class="p-4">
                                                                <div class="form-group">
                                                                    <label for="notas">Notas</label>
                                                                    <textarea class="form-control" id="notas" name="notas" rows="3">{{old('notas')}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button
                                                                type="submit"
                                                                class="btn btn-primary"
                                                                style="padding:8px 100px;margin-top:25px;">
                                                                Enviar
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Button trigger modal VER Albaranes-->
                            <button
                                type="button"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#verAlbaran">
                                <i class="far fa-list-alt"></i>
                                Albaranes
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="verAlbaran"
                                tabindex="-1"
                                role="dialog"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Lista de Albaranes</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">N/S</th>
                                                                <th scope="col">Estado</th>
                                                                <th scope="col">Albaran</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($producto->unids as $unidad)
                                                            <tr>
                                                                <th>
                                                                    {{$unidad->numero_serie}}
                                                                </th>
                                                                <th>
                                                                    {{$unidad->estado}}
                                                                </th>
                                                                <th>
                                                                    <div class="ui-widget">
                                                                        <input
                                                                        type="text"
                                                                        class="searchReferencia form-control m-md-0 m-sm-2"
                                                                        id="referencia{{$unidad->id}}"
                                                                        name="referencia"
                                                                        autocomplete="off"
                                                                        value="{{$unidad->albaran->referencia ?? 'no tiene'}}">
                                                                    </div>
                                                                    
                                                                    </th>
                                                                    <th>
                                                                        <form>@can ('productos.destroy')
                                                                            <button
                                                                                type="submit"
                                                                                class="btn btn-danger my-md-0 mb-sm-2"
                                                                                style="display:inline">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                            @endcan
                                                                        </form>
                                                                    </th>
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>

                                                    </div>

                                                </div>

                                                <p class="d-flex justify-content-center">
                                                    @can ('productos.create')
                                                    <a
                                                        class="btn btn-primary m-3 "
                                                        data-toggle="collapse"
                                                        href="#collapseExample2"
                                                        role="button"
                                                        aria-expanded="false"
                                                        aria-controls="collapseExample">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                    @endcan
                                                </p>
                                                <div class="collapse" id="collapseExample2">
                                                    <div class="card card-body">
                                                        <form
                                                            method="post"
                                                            action="{{route('albaran.store', $producto->id)}}"
                                                            enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="d-flex justify-content-md-center">
                                                                <div class="p-4">
                                                                    <fieldset class="form-group">
                                                                        <label for="referencia">Referencia</label>
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            id="referencia"
                                                                            name="referencia"
                                                                            value="{{old('referencia')}}"></fieldset>

                                                                    </div>
                                                                    <div class="p-4">
                                                                        <div class="form-group">
                                                                            <label for="ruta">Imagen</label>
                                                                            <input type="file" name="ruta">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group text-center">
                                                                    <button
                                                                        type="submit"
                                                                        class="btn btn-primary"
                                                                        style="padding:8px 100px;margin-top:25px;">
                                                                        Enviar
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                </div>

                                            </div>
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
                                        class="btn btn-success"
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
                                                {!!Form::model($producto, ['route' => ['producto.almacen', $producto->id],
                                                'method' => 'PUT'])!!}
                                                <div class="modal-body">

                                                    <h5>Elige el almacen al que quieres enviar</h5>
                                                    <fieldset class="form-group">
                                                        <label for="almacen">Almacén</label>
                                                        <select class="custom-select" name="almacen">
                                                            @foreach ($almacenes as $almacen)
                                                            <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                                            @endforeach

                                                        </select>
                                                    </fieldset>
                                                    <hr>
                                                        <h5>¿Que unidades quieres enviar?</h5>
                                                        <fieldset class="form-group">
                                                            <ul class="list-unstyled p-2">
                                                                <div class="row">
                                                                    @foreach ($producto->unids as $unidad)
                                                                    <div class="col-md-6">
                                                                        <li>
                                                                            <label>
                                                                                {{Form::checkbox('unidades[]', $unidad->id,null)}}
                                                                                {{$unidad->numero_serie}}
                                                                                <em>({{$unidad->estado}})</em>
                                                                            </label>

                                                                        </li>
                                                                    </div>
                                                                    @endforeach
                                                                </div>

                                                            </ul>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                Enviar
                                                            </button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            @endcan @can ('productos.destroy')
                                            <form
                                                action="{{route('producto.destroy',$producto->id)}}"
                                                method="POST"
                                                class="eliminar"
                                                style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger" style="display:inline">
                                                    <i class="fas fa-trash"></i>
                                                    Borrar
                                                </button>

                                            </form>
                                            <!-- Modal -->

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