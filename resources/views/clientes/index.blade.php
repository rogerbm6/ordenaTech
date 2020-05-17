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

<a type="button" href="/home" class="btn btn-sm btn-info m-1">
    <i class="fas fa-angle-left"></i> volver
</a>

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
                    <h3 class="mb-0">Clientes</h3>
                </div>
                @can('clientes.create')
                <div class="col text-right d-inline p-1">
                    <a type="button" class="btn btn-sm btn-primary m-1" href="{{route('clientes.create')}}">
                        <i class="fa fa-plus-square"></i>
                        Nuevo
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Dirección</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)


                    <tr>
                        <td scope="row">
                            {{$cliente->nombre}}
                        </td>
                        <th>
                            {{$cliente->tipo}}
                        </th>
                        <th>
                            {{$cliente->telefono}}
                        </th>
                        <td>
                            {{$cliente->direccion ? : 'No tiene'}}
                        </td>
                        <td>
                          @can ('clientes.show')
                            <a type="button" class="btn btn-sm btn-success" href="{{route('clientes.show', $cliente->id)}}">
                                <i class="fas fa-address-book fa-fw mr-2"></i>Ver
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
