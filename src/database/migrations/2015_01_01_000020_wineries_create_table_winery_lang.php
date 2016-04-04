<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WineriesCreateTableWineryLang extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('014_191_winery_lang'))
		{
			Schema::create('014_191_winery_lang', function (Blueprint $table) {
				$table->engine = 'InnoDB';

				$table->integer('id_191')->unsigned();
				$table->string('lang_191', 2);

				$table->string('description_title_191')->nullable();
				$table->text('description_191')->nullable();
				$table->text('activity_191')->nullable();

				$table->primary(['id_191', 'lang_191'], 'pk01_014_191_winery_lang');

				$table->foreign('id_191', 'fk01_014_191_winery_lang')->references('id_190')->on('015_190_winery')
					->onDelete('cascade')->onUpdate('cascade');
				$table->foreign('lang_191', 'fk02_014_191_winery_lang')->references('id_001')->on('001_001_lang')
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
		if(Schema::hasTable('014_191_winery_lang'))
		{
			Schema::drop('014_191_winery_lang');
		}
	}
}