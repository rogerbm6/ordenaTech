<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class RoleController extends Controller
{
  public function index()
  {
      $roles = Role::all();

      if (request()->ajax()) {
        return datatables()
        ->eloquent(Role::query())
        ->addColumn('btn', 'roles/actions')
        ->rawColumns(['btn'])
        ->toJson();
      }

      return view('roles/index', ['roles'=>$roles]);
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $permissions= Permission::all();

      return view('roles/create', ['permissions'=>$permissions]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $rol = Role::create($request->all());

      $rol->permissions()->sync($request->get('permissions'));

      return redirect()->action('RoleController@show', ['rol'=>$rol]);
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Role $rol)
  {
      return view('roles/show', ['rol'=>$rol]);
  }


  public function edit(Role $rol)
  {
      $permissions= Permission::all();

      return view('roles/edit', ['rol'=>$rol, 'permissions'=>$permissions]);
  }



  public function update(Role $rol, Request $request)
  {
      //Actualiza el rol
      $rol->update($request->all());

      //sincroniza todos los permisos
      $rol->permissions()->sync($request->get('permissions'));

      return redirect()->action('RoleController@show', ['rol'=>$rol])->with('info', 'Rol actualizado correctamente');

  }

  public function destroy(Role $rol)
  {
      $rol->delete();

      return redirect()->action('RoleController@index')->with('info', 'Rol eliminado correctamente');

  }
}
