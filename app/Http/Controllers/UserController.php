<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Caffeinated\Shinobi\Models\Role;

class UserController extends Controller
{
  public function index()
  {
      $users = User::all();

      return view('users/index', ['users'=>$users]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
      return view('users/show', ['user'=>$user]);
  }


  public function edit(User $user)
  {
      $roles=Role::all();
      return view('users/edit', ['user'=>$user, 'roles'=>$roles]);
  }



  public function update(User $user, Request $request)
  {
      //Actualiza el usuario
      $user->update($request->all());

      //sincroniza todos los roles
      $user->roles()->sync($request->get('roles'));

      return redirect()->action('UserController@show', ['user'=>$user])->with('info', 'Usuario actualizado correctamente');

  }

  public function destroy(User $user)
  {
      $user->delete();

      return redirect()->action('UserController@index')->with('info', 'Usuario eliminado correctamente');

  }
}
