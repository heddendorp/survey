<?php

use Illuminate\Database\Seeder;
use \Survey\Models\User;
use \Survey\Models\Customer;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        $joki = Customer::find(1);

        $user = new User;
        $user->name = 'Lukas';
        $user->email = 'lu.heddendorp@gmail.com';
        $user->password = 'lukas2110';
        $user->admin = true;
        $user->customer()->associate($joki);
        $user->save();

        $user = new User;
        $user->name = 'Uwe';
        $user->email = 'heddendorp@aol.com';
        $user->password = 'lu2110';
        $user->admin = true;
        $user->customer()->associate($joki);
        $user->save();

        $kukita = Customer::find(2);

        $user = new User;
        $user->name = 'Lukas';
        $user->email = 'lu.heddendorp@gmail.com';
        $user->password = 'lukas2110';
        $user->admin = true;
        $user->customer()->associate($kukita);
        $user->save();

        $user = new User;
        $user->name = 'Petra';
        $user->email = 'p.hipp@t-online.de';
        $user->password = 'petra';
        $user->admin = true;
        $user->customer()->associate($kukita);
        $user->save();
    }

}