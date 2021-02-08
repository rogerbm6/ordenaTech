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
@if ($errors->any())
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

<div class="row" style="margin-top:40px">
    <div class="offset-md-3 col-md-6">
        <div class="card">
            <div class="card-header text-center">
                Agregar nuevo cliente
            </div>
            <div class="card-body" style="padding:30px">
                <form method="post" action="{{route('clientes.store')}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value={{old('nombre')}}>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="tel" id="telefono" name="telefono" class="form-control" value={{old('telefono')}}>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value={{old('direccion')}}>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="tipo">Tipo</label>
                        <select class="custom-select" name="tipo">
                            <option selected value="{{old('tipo')}}">{{old('tipo')?: 'Escoge un Tipo'}}</option>

                            <option value="particular">Particular</option>

                            <option value="empresa">Empresa</option>

                        </select>
                    </fieldset>

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
