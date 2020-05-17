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


<div class="row">
    <div class="col-sm-8">
        <div class="container">

            <h1>{{$almacen->nombre}}</h1>

            <p><span class="font-weight-bold">Direccion:</span> {{$almacen->direccion}}</p>
            <p><span class="font-weight-bold">Código postal:</span> {{$almacen->cp}}</p>

            <p><span class="font-weight-bold">Isla:</span> {{$almacen->isla}}</p>


            <a type="button" href="{{route('almacenes.index')}}" class="btn btn-sm btn-info m-1"><i class="fas fa-angle-left"></i> Volver</a>

            @can ('almacenes.edit')
            <a type="button" href="{{route('almacenes.edit',$almacen->id)}}" class="btn btn-warning"><i class="fas fa-user-edit"></i> Editar</a>
            @endcan

            @can ('almacenes.destroy')
            <form action="" method="POST" style="display:inline">
                {{ method_field('DELETE') }}
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-danger" style="display:inline">
                    <i class="fas fa-trash"></i> Borrar
                </button>
            </form>
            @endcan
        </div>
    </div>

</div>



<div class="col-md-11 m-2 p-2">

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


    <div class="card mb-5">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Productos</h3>
                </div>
                @can('producto.create')
                <div class="col text-right d-inline p-1">
                    <a type="button" class="btn btn-sm btn-primary m-1" href="{{route('producto.redirect')}}">
                        <i class="fa fa-plus-square"></i>
                        Agregar producto al almacen
                    </a>

                @endcan

                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Numero de serie</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Cliente</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)


                    <tr>
                        <th scope="row">
                            {{$producto->numero_serie}}
                        </th>
                        <td>
                            {{$producto->nombre}}
                        </td>
                        <td>
                            {{$producto->marca}}
                        </td>
                        <td>
                            {{$producto->modelo}}
                        </td>
                        <th>
                            {{$producto->cliente->nombre}}
                        </th>
                        <td>
                            @can ('producto.show')

                            <a type="button" class="btn btn-sm btn-success" href="{{route('producto.show', $producto->id)}}">
                                <i class="fas fa-address-book fa-fw mr-2"></i>Ir
                            </a>
                            @endcan
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop
