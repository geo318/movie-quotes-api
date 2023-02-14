<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::table('movies', function (Blueprint $table) {
			$table->string('description', 10000)->nullable();
			$table->string('director', 500)->nullable();
			$table->string('budget')->nullable();
		});
	}

	public function down()
	{
		Schema::table('movies', function (Blueprint $table) {
			$table->dropColumn('description');
			$table->dropColumn('director');
			$table->dropColumn('budget');
		});
	}
};
