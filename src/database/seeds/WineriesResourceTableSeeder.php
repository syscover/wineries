<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Resource;

class WineriesResourceTableSeeder extends Seeder {

    public function run()
    {
        Resource::insert([
            ['id_007' => 'wineries',            'name_007' => 'Wineries Package',   'package_id_007' => '15'],
            ['id_007' => 'wineries-winery',     'name_007' => 'Winery',             'package_id_007' => '15'],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="WineriesResourceTableSeeder"
 */