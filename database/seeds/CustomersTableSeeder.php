<?php

use Illuminate\Database\Seeder;
use \Survey\Models\Customer;

class CustomersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('customers')->delete();
        $customer = new Customer;
        $customer->name = "Joki";
        $customer->info_email = "info@joki.de";
        $customer->save();

        $customer = new Customer;
        $customer->name = "Kukita";
        $customer->info_email = "info@kukita.de";
        $customer->save();
    }

}
