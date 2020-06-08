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
    <div class="offset-md-2 col-md-8">
        <div class="card">
            <div class="card-header text-center">
                Actualiza Rol
            </div>
            <div class="card-body" style="padding:30px">
                <div class="card-body" style="padding:30px">
                    {!!Form::model($rol, ['route' => ['roles.update', $rol->id], 'method' => 'PUT'])!!}

                    <fieldset class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$rol->name}}">
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="slug">URL amigable</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{$rol->slug}}">
                    </fieldset>

                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{$rol->description}}</textarea>
                    </div>


                    <hr>
                    <h3 class="display-5">Permiso especial</h3>
                    <fieldset class="form-group">

                        <label>
                            {{Form::radio('special', 'all-access')}} Acceso Total
                        </label>

                        <label>
                            {{Form::radio('special', 'no-access')}} Sin acceso
                        </label>

                        <label>
                            {{Form::radio('special', '')}} Ninguno
                        </label>

                    </fieldset>

                    <h3 class="display-5">Lista de permisos</h3>
                    <fieldset class="form-group">
                        <ul class="list-unstyled">
                            <div class="row">

                                @foreach ($permissions as $permiso)
                                <div class="col-md-6">
                                    <li>
                                        <label>
                                            {{Form::checkbox('permissions[]', $permiso->id,null)}}
                                            {{$permiso->name}}
                                            <em>({{$permiso->description ?: 'Sin descripcion'}})</em>
                                        </label>

                                    </li>
                                </div>
                                @endforeach

                            </div>

                        </ul>
                    </fieldset>

                    <div class="form-group text-center">
                        {{Form::submit('Guardar', ['class'=>'btn btn-sm btn-primary'])}}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@stop
