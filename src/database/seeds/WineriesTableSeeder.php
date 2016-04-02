<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WineriesTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call(WineriesPackageTableSeeder::class);
        $this->call(WineriesResourceTableSeeder::class);
        $this->call(WineriesAttachmentMimeSeeder::class);

        Model::reguard();
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="WineriesTableSeeder"
 */