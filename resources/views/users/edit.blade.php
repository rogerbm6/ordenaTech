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
    <div class="offset-md-3 col-md-6">
        <div class="card">
            <div class="card-header text-center">
                Modificar Usuario
            </div>
            <div class="card-body" style="padding:30px">
                <form method="post" action="{{route('user.show', $user->id)}}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <fieldset class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value='{{$user->name}}'>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}">
                    </fieldset>

                    <hr>
                    <h3 class="display-5">Lista de Roles</h3>
                    <fieldset class="form-group">
                        <ul class="list-unstyled">
                            @foreach ($roles as $role)

                            <li>
                                <label>
                                  {{Form::checkbox('roles[]', $role->id,
                                    function () {
                                        if (in_array($role, $user->roles, true)) {
                                          return null;
                                        }
                                        
                                      }
                                    )}}
                                  {{$role->name}}
                                  <em>({{$role->description ?: 'Sin descripcion'}})</em>
                                </label>

                            </li>

                            @endforeach
                        </ul>
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
