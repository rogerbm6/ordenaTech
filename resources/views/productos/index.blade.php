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
<div class="d-flex justify-content-between">
    <div class="p-2 ">
        <a type="button" href="/home" class="btn btn-sm btn-info m-1">
            <i class="fas fa-angle-left"></i> volver
        </a>
    </div>
    <div class="p-2 mr-md-5">
        @can('almacenes.index')
        @can ('clientes.index')
        <div class="mr-md-4">
            <a type="button" href="{{route('productos.excel')}}" class="btn btn-success mr-md-5"><i class="fas fa-file-pdf"></i> Exportar Excel</a>
    
        </div>
        @endcan
        @endcan
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

    @if (session('info'))
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="alert alert-success">
                {{session('info')}}
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
                @can('productos.create')
                <div class="col text-right d-inline p-1">
                    <a type="button" class="btn btn-sm btn-primary m-1" href="{{route('producto.redirect')}}">
                        <i class="fa fa-plus-square"></i>
                        Nuevo producto
                    </a>

                </div>
                @endcan
            </div>
        </div>
        <div class="table-responsive p-3">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="tabla">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">P/N</th>
                        <th scope="col">Incidencia</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Almacen</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>

@stop
