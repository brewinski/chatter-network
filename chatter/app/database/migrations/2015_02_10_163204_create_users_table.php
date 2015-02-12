<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

  /**
	 * Run the migrations.
	 *
	 * @return void
	 */
  public function up()
  {
    Schema::create('users', function($table)
                   {
                     $table->increments('id');
                     $table->string('username')->unique();;
                     $table->string('password')->index();
                     $table->string('remember_token')->nullable();
                     $table->string('first_name');
                     $table->string('last_name');
                     $table->date('birth_date');
                     $table->string("image_file_name")->nullable();
                     $table->integer("image_file_size")->nullable();
                     $table->string("image_content_type")->nullable();
                     $table->timestamp("image_updated_at")->nullable();
                     $table->timestamps();
                   });
  }

  /**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
  public function down()
  {
    //
  }

}
