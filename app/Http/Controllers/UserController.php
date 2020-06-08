<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\User;
use Caffeinated\Shinobi\Models\Role;


use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
  public function index()
  {
      $users = User::all();

      if (request()->ajax()) {
        return datatables()
        ->eloquent(User::query())
        ->addColumn('btn', 'users/actions')
        ->rawColumns(['btn'])
        ->toJson();
      }

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

    if (request()->ajax()) {
      $roles= $user->roles;
      return Datatables::of($roles)
      ->addColumn('btn', 'users/actionshow')
      ->rawColumns(['btn'])
      ->make(true);
    }

      return view('users/show', ['user'=>$user]);
  }


  public function edit(User $user)
  {
      $roles=Role::all();

      return view('users/edit', ['user'=>$user, 'roles'=>$roles]);
  }



  public function update(User $user, UserFormRequest $request)
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
