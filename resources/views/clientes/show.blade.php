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
@extends('layouts.master') @section('content') @if (session('info'))
<div class="row justify-content-center">
    <div class="col-sm-12">
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class=" ml-md-3">
        <div class="container text-light">

            <h1>{{$cliente->nombre}}</h1>
            <h5>{{$cliente->email}}</h5>
            <p>
                <span class="font-weight-bold">Telefono:</span>
                {{$cliente->telefono}}</p>
            <p>
                <span class="font-weight-bold">Tipo:</span>
                {{$cliente->tipo}}</p>

            <p>
                <span class="font-weight-bold">Direccion:</span>
                {{$cliente->direccion ? "$cliente->direccion" : 'No tiene'}}</p>

            <div class="d-inline-flex">
                <div>
                    <a
                        type="button"
                        href="{{route('clientes.index')}}"
                        class="btn btn-sm btn-info m-1">
                        <i class="fas fa-angle-left"></i>
                        Volver</a>

                    @can ('clientes.edit')
                    <a
                        type="button"
                        href="{{route('clientes.edit',$cliente->id)}}"
                        class="btn btn-warning m-1">
                        <i class="fas fa-user-edit"></i>
                        Editar</a>
                    @endcan @can ('clientes.destroy')
                    <form action="" method="POST" style="display:inline" class='eliminar'>
                        {{ method_field('DELETE') }}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger m-1" style="display:inline">
                            <i class="fas fa-trash"></i>
                            Borrar
                        </button>
                    </form>

                </div>
                <div class="">
                    @endcan @can ('productos.index')
                    <a
                        type="button"
                        href="{{route('clientes.pdf',$cliente->id)}}"
                        class="btn btn-success m-1">
                        <i class="fas fa-file-pdf"></i>
                        Exportar PDF</a>
                    
                    
                    <a
                        type="button"
                        href="{{route('clientes.excel',$cliente->id)}}"
                        class="btn btn-success m-1">
                        <i class="fas fa-file-excel"></i>
                        Exportar Excel</a>
                    @endcan

                </div>
            </div>
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
                    <h3 class="mb-0">{{$cliente->productos->count()}}
                        Productos</h3>
                </div>

                <div class="col text-right d-inline p-1">
                    @can('productos.create')
                    <a
                        type="button"
                        class="btn btn-sm btn-primary m-1"
                        href="{{route('producto.create',$cliente->id)}}">
                        <i class="fa fa-plus-square"></i>
                        Agregar productos al cliente
                    </a>
                    @endcan
                </div>

            </div>
        </div>
        <div class="table-responsive p-3">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id='tabla'>
                <thead class="thead-light">
                    <tr>
                        <th scope="col">P/N</th>
                        <th scope="col">Incidencia</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Almacen</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>

@stop