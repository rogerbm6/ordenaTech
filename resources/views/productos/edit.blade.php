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
@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
    <div class="offset-md-2 col-md-8">
        <div class="card">
            <div class="card-header text-center">
                Actualizar producto
            </div>
            <div class="card-body" style="padding:30px">
                <form method="post" action="{{route('producto.update', $producto->id)}}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="numero_serie">Numero de serie</label>
                                <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="{{$producto->numero_serie}}">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$producto->nombre}}">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="marca">Marca</label>
                                <input type="text" id="marca" name="marca" class="form-control" value="{{$producto->marca}}">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="modelo">Modelo</label>
                                <input type="text" id="modelo" name="modelo" class="form-control" value="{{$producto->modelo}}">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="estado">Estado</label>
                                <select class="custom-select" name="estado">
                                    <option selected>{{$producto->estado}}</option>

                                    <option value="usado">Usado</option>

                                    <option value="nuevo">Nuevo</option>

                                    <option value="averiado">Averiado</option>

                                    <option value="doa">DOA</option>

                                </select>
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" id="cantidad" name="cantidad" class="form-control" value="{{$producto->cantidad}}">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="almacen">Almacén</label>
                                <select class="custom-select" name="almacen">
                                    <option selected value='{{$producto->almacene->id}}'>{{$producto->almacene->nombre}}</option>
                                    @foreach ($almacenes as $almacen)
                                    <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                    @endforeach

                                </select>
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="ubicacion">Ubicación en el almacén</label>
                                <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{$producto->ubicacion}}">
                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notas">Notas</label>
                        <textarea class="form-control" id="notas" name="notas" rows="3">{{$producto->notas}}</textarea>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                            Enviar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@stop
