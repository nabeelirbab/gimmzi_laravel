<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $UserTypes=['SUPER-ADMIN','CLIENT','PROVIDER','CONSUMER','MERCHANT','SHORT TERM RENTAL PROVIDER','HOTEL RESORT PROVIDER'];
        foreach ($UserTypes as $key => $UserType) {
            Role::create(['name' => $UserType]);
        }

    }
}
