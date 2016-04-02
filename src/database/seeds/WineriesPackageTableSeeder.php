<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Package;

class WineriesPackageTableSeeder extends Seeder
{
    public function run()
    {
        Package::insert([
            ['id_012' => '15', 'name_012' => 'Wineries Package', 'folder_012' => 'wineries', 'sorting_012' => 15, 'active_012' => '0']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="WineriesPackageTableSeeder"
 */