<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        App\Role::insert([
            ['name' => 'superadmin'],
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'editor'],
        ]);

        // Basic permissions data
        App\Permission::insert([
            ['name' => 'access.backend'],
            ['name' => 'access.user'],
            ['name' => 'create.user'],
            ['name' => 'edit.user'],
            ['name' => 'delete.user'],
            ['name' => 'access.article'],
            ['name' => 'create.article'],
            ['name' => 'edit.article'],
            ['name' => 'delete.article'],
            ['name' => 'access.dokumen'],
            ['name' => 'create.dokumen'],
            ['name' => 'edit.dokumen'],
            ['name' => 'delete.dokumen'],
            ['name' => 'access.informasi'],
            ['name' => 'create.informasi'],
            ['name' => 'edit.informasi'],
            ['name' => 'delete.informasi'],
            ['name' => 'access.layer'],
            ['name' => 'create.layer'],
            ['name' => 'edit.layer'],
            ['name' => 'delete.layer'],
            ['name' => 'access.fpj'],
            ['name' => 'create.fpj'],
            ['name' => 'edit.fpj'],
            ['name' => 'delete.fpj'],

            ['name' => 'access.fst'],
            ['name' => 'create.fst'],
            ['name' => 'edit.fst'],
            ['name' => 'delete.fst'],
        ]);

        // Add a permission to a role
        $role = App\Role::where('name', 'admin')->first();
        $role->addPermission('access.backend');
        $role->addPermission('access.user');
        $role->addPermission('create.user');
        $role->addPermission('edit.user');
        $role->addPermission('delete.user');

        $role->addPermission('access.layer');
        $role->addPermission('create.layer');
        $role->addPermission('edit.layer');
        $role->addPermission('delete.layer');
        // ... Add other role permission if necessary

        // Create a user, and give roles
        $user = App\User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'name' => 'Super Admin',
            'password' => bcrypt('password'),
            'md5_password' => md5('password'),
            'isactived' => 1,
            'isverified' => 1,
        ]);

        $user->assignRole('superadmin');

        $operator = App\User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'md5_password' => md5('password'),
        ]);

        $user->assignRole('admin');
    }
}
