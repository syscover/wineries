<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WineriesCreateTableWinery extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(! Schema::hasTable('015_190_winery'))
        {
            Schema::create('015_190_winery', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id_190')->unsigned();

                // custom
                $table->integer('custom_field_group_190')->unsigned()->nullable();

                // hotel related
                $table->integer('hotel_id_190')->unsigned()->nullable();

                // spa description
                $table->string('name_190');
                $table->string('slug_190')->nullable();
                $table->string('web_190')->nullable();
                $table->string('web_url_190')->nullable();
                $table->string('contact_190')->nullable();
                $table->string('email_190')->nullable();
                $table->string('phone_190')->nullable();
                $table->string('mobile_190')->nullable();
                $table->string('fax_190')->nullable();

                // access
                $table->boolean('active_190');

                // geolocation data
                $table->string('country_190', 2);
                $table->string('territorial_area_1_190', 6)->nullable();
                $table->string('territorial_area_2_190', 10)->nullable();
                $table->string('territorial_area_3_190', 10)->nullable();
                $table->string('cp_190')->nullable();
                $table->string('locality_190')->nullable();
                $table->string('address_190')->nullable();
                $table->string('latitude_190')->nullable();
                $table->string('longitude_190')->nullable();

                $table->string('data_lang_190')->nullable();
                $table->text('data_190')->nullable();

                // INDEX
                $table->index('slug_190', 'ix01_007_190_hotel');

                $table->foreign('country_190', 'fk01_014_191_winery_lang')->references('id_002')->on('001_002_country')
                    ->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('territorial_area_1_190', 'fk02_014_191_winery_lang')->references('id_003')->on('001_003_territorial_area_1')
                    ->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('territorial_area_2_190', 'fk03_014_191_winery_lang')->references('id_004')->on('001_004_territorial_area_2')
                    ->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('territorial_area_3_190', 'fk04_014_191_winery_lang')->references('id_005')->on('001_005_territorial_area_3')
                    ->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('custom_field_group_190', 'fk05_014_191_winery_lang')->references('id_025')->on('001_025_field_group')
                    ->onDelete('restrict')->onUpdate('cascade');
            });
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        if (Schema::hasTable('015_190_winery'))
        {
            Schema::drop('015_190_winery');
        }
	}
}