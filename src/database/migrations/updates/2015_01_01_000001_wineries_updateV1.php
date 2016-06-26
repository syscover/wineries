<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Syscover\Pulsar\Libraries\DBLibrary;

class WineriesUpdateV1 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// change country_190
		DBLibrary::renameColumnWithForeignKey('015_190_winery', 'country_190', 'country_id_190', 'VARCHAR', 2, false, false, 'fk01_015_190_winery', '001_002_country', 'id_002');
		// change territorial_area_1_190
		DBLibrary::renameColumnWithForeignKey('015_190_winery', 'territorial_area_1_190', 'territorial_area_1_id_190', 'VARCHAR', 6, false, true, 'fk02_015_190_winery', '001_003_territorial_area_1', 'id_003');
		// change territorial_area_2_190
		DBLibrary::renameColumnWithForeignKey('015_190_winery', 'territorial_area_2_190', 'territorial_area_2_id_190', 'VARCHAR', 10, false, true, 'fk03_015_190_winery', '001_004_territorial_area_2', 'id_004');
		// change territorial_area_3_190
		DBLibrary::renameColumnWithForeignKey('015_190_winery', 'territorial_area_3_190', 'territorial_area_3_id_190', 'VARCHAR', 10, false, true, 'fk04_015_190_winery', '001_005_territorial_area_3', 'id_005');
		// change custom_field_group_190
		DBLibrary::renameColumnWithForeignKey('015_190_winery', 'custom_field_group_190', 'field_group_id_190', 'INT', 10, true, true, 'fk05_015_190_winery', '001_025_field_group', 'id_025');

		// change lang_191
		DBLibrary::renameColumnWithForeignKey('015_191_winery_lang', 'lang_191', 'lang_id_191', 'VARCHAR', 2, false, false, 'fk02_015_191_winery_lang', '001_001_lang', 'id_001');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){}
}