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

  @if (session('info'))
  <div class="row justify-content-center">
      <div class="col-sm-12">
          <div class="alert alert-success">
              {{session('info')}}
          </div>
      </div>
  </div>
  @endif

<a type="button" href="/home" class="btn btn-sm btn-info m-1">
    <i class="fas fa-angle-left"></i> volver
</a>

<div class="col-md-11 m-2 p-2">

    <div class="card mb-5">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Almacenes</h3>
                </div>

                <div class="col text-right d-inline p-1">
                  @can('almacenes.create')
                    <a type="button" class="btn btn-sm btn-primary m-1" href="{{route('almacenes.create')}}">
                        <i class="fa fa-plus-square"></i>
                        Nuevo Almacen
                    </a>

                    @endcan

                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($almacenes as $almacen)
            <div class="col-xl-6 col-md-6 col-sm-6">
                <div class="card card-stats px-3 m-3">
                    <!-- Card body -->
                    <div class="card-body p-3">

                        <h5 class="card-title text-uppercase text-muted mb-0"><a href="{{route('almacenes.show', $almacen->id)}}">{{$almacen->nombre}}</a></h5>
                        <span class="h6 font-weight-bold mb-0">{{$almacen->isla}}</span>

                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</div>

@stop
