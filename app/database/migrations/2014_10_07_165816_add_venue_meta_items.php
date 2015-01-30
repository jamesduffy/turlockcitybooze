<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVenueMetaItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$item = new VenueMetaItem;
		$item->name = 'has_wifi';
		$item->description = 'WiFi';
		$item->save();

		$item = new VenueMetaItem;
		$item->name = 'good_for_groups';
		$item->description = 'Good for Groups';
		$item->save();

		$item = new VenueMetaItem;
		$item->name = 'good_for_kids';
		$item->description = 'Good for Kids';
		$item->save();

		$item = new VenueMetaItem;
		$item->name = 'allows_reservations';
		$item->description = 'Allows Reservations';
		$item->save();

		$item = new VenueMetaItem;
		$item->name = 'has_tv';
		$item->description = 'TV';
		$item->save();

		$item = new VenueMetaItem;
		$item->name = 'street_parking';
		$item->description = 'Street Parking';
		$item->save();

		$item = new VenueMetaItem;
		$item->name = 'private_parking';
		$item->description = 'Private Parking';
		$item->save();

		$item = new VenueMetaItem;
		$item->name = 'bike_parking';
		$item->description = 'Bike Parking';
		$item->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('venue_meta_items')->truncate();
	}

}
