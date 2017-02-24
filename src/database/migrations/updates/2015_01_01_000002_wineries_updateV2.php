<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Syscover\Pulsar\Libraries\DBLibrary;

class WineriesUpdateV2 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(! Schema::hasColumn('015_190_winery', 'booking_data_190'))
        {
            Schema::table('015_190_winery', function (Blueprint $table) {
                $table->string('booking_data_190')->nullable()->after('longitude_190');
            });
        }

        if(! Schema::hasColumn('015_190_winery', 'booking_email_190'))
        {
            Schema::table('015_190_winery', function (Blueprint $table) {
                $table->string('booking_email_190')->nullable()->after('booking_data_190');
            });
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){}
}