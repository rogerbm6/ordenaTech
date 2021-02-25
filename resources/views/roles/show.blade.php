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

@if (session('info'))
<div class="row justify-content-center">
    <div class="col-sm-12">
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-sm-8">
        <div class="container text-light">

            <h1>{{$rol->name}}</h1>

            <p><span class="font-weight-bold">Cargo:</span> {{$rol->slug}}</p>

            <p><span class="font-weight-bold">Descripción:</span> {{$rol->description}}</p>

            <a type="button" href="{{route('roles.index')}}" class="btn btn-sm btn-info m-1"><i class="fas fa-angle-left"></i> Volver</a>

            @can ('roles.edit')
            <a type="button" href="{{route('roles.edit',$rol->id)}}" class="btn btn-warning"><i class="fas fa-user-edit"></i> Editar</a>
            @endcan

            @can ('roles.destroy')
            <form action="" method="POST" style="display:inline" class="eliminar">
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

    <div class="card mb-5">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Permisos</h3>
                </div>
            </div>
        </div>
        @if ($rol->special)
        <h1 class="display-4 m-5 p-2">Tiene el permiso especial {{$rol->special}}</h1>
        @else
        <div class="table-responsive">
            <!-- Projects table -->

            <table class="table align-items-center table-flush">
                <thead class="thead-light">

                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rol->permissions as $permiso)


                    <tr>
                        <th scope="row">
                            {{$permiso->name}}
                        </th>

                        <td>
                            {{$permiso->slug}}
                        </td>

                        <td>
                            {{$permiso->description}}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@stop
