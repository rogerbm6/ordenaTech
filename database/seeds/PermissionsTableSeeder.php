<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              /* Permisos de Usuarios */
        //permiso para ver en la ruta index de todos los users
        Permission::create([
        'name'        =>  'Ver user',
        'slug'        =>  'user.index',
        'description' =>  'Lista y navega todos los user del sistema',
        ]);

        //permiso para ver en la ruta show donde solo hay un user
        Permission::create([
        'name'        =>  'Ver detalles de un user',
        'slug'        =>  'user.show',
        'description' =>  'Muestra todos los detalles de un user',
        ]);

        //permiso para actualizar un user
        Permission::create([
        'name'        =>  'Edición de user',
        'slug'        =>  'user.edit',
        'description' =>  'Muestra y actualiza la informacion de un user',
        ]);

        //permiso eliminar user
        Permission::create([
        'name'        =>  'Eliminar user',
        'slug'        =>  'user.destroy',
        'description' =>  'Elimina del sistema un user',
        ]);
/*-------------------------------------------------------------------------------*/

              /* Permisos de roles */
        //permiso para ver en la ruta index de todos los roles
        Permission::create([
        'name'        =>  'Ver roles',
        'slug'        =>  'roles.index',
        'description' =>  'Lista y navega todos los roles del sistema',
        ]);

        //permiso para ver en la ruta show donde solo hay un rol
        Permission::create([
        'name'        =>  'Ver detalles de un rol',
        'slug'        =>  'roles.show',
        'description' =>  'Muestra todos los detalles de un rol',
        ]);

        //permiso para crear un nuevo rol
        Permission::create([
        'name'        =>  'Creación de rol',
        'slug'        =>  'roles.create',
        'description' =>  'Permite crear un rol',
        ]);

        //permiso para actualizar un rol
        Permission::create([
        'name'        =>  'Edición de rol',
        'slug'        =>  'roles.edit',
        'description' =>  'Muestra y actualiza la informacion de un rol',
        ]);

        //permiso eliminar roles
        Permission::create([
        'name'        =>  'Eliminar rol',
        'slug'        =>  'roles.destroy',
        'description' =>  'Elimina del sistema un rol',
        ]);
/*-------------------------------------------------------------------------------*/
                      /* Permisos de clientes */
        //permiso para ver en la ruta index de todos los clientes
        Permission::create([
          'name'        =>  'Ver clientes',
          'slug'        =>  'clientes.index',
          'description' =>  'Lista y navega todos los clientes del sistema',
        ]);

        //permiso para ver en la ruta show donde solo hay un cliente
        Permission::create([
          'name'        =>  'Ver detalles de un cliente',
          'slug'        =>  'clientes.show',
          'description' =>  'Muestra todos los detalles de un cliente',
        ]);

        //permiso para crear un nuevo cliente
        Permission::create([
          'name'        =>  'Creación de cliente',
          'slug'        =>  'clientes.create',
          'description' =>  'Permite crear un cliente',
        ]);

        //permiso para actualizar un cliente
        Permission::create([
          'name'        =>  'Edición de cliente',
          'slug'        =>  'clientes.edit',
          'description' =>  'Muestra y actualiza la informacion de un cliente',
        ]);

        //permiso eliminar clientes
        Permission::create([
          'name'        =>  'Eliminar cliente',
          'slug'        =>  'clientes.destroy',
          'description' =>  'Elimina del sistema un cliente',
        ]);

/*-------------------------------------------------------------------------------*/
                  /* Permisos de almacenes */
        //permiso para ver en la ruta index de todos los almacenes
        Permission::create([
        'name'        =>  'Ver almacenes',
        'slug'        =>  'almacenes.index',
        'description' =>  'Lista y navega todos los almacenes del sistema',
        ]);

        //permiso para ver en la ruta show donde solo hay un almacenalmacen
        Permission::create([
        'name'        =>  'Ver detalles de un almacen',
        'slug'        =>  'almacenes.show',
        'description' =>  'Muestra todos los detalles de un almacen',
        ]);

        //permiso para crear un nuevo almacen
        Permission::create([
        'name'        =>  'Creación de almacen',
        'slug'        =>  'almacenes.create',
        'description' =>  'Permite crear un almacen',
        ]);

        //permiso para actualizar un almacen
        Permission::create([
        'name'        =>  'Edición de almacen',
        'slug'        =>  'almacenes.edit',
        'description' =>  'Muestra y actualiza la informacion de un almacen',
        ]);

        //permiso eliminar almacen
        Permission::create([
        'name'        =>  'Eliminar almacen',
        'slug'        =>  'almacenes.destroy',
        'description' =>  'Elimina del sistema un almacen',
        ]);
    }
}
