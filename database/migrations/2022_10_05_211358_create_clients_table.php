<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone');
			$table->string('email');
			$table->integer('blood_type_id')->unsigned();
			$table->string('password');
			$table->string('name');
			$table->date('d_o_b');
			$table->date('last_donation_date');
			$table->string('pin_code');
			$table->integer('city_id')->unsigned();
			$table->boolean('is_active')->default(1);
            $table->string('api_token',60)->unique()->nullable();
            // $table->integer('donation_request_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
