<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('address', 300)->nullable();
            $table->date('birth_at')->comment("date of birth")->nullable();
            $table->string("phone")->nullable();

            $table->double("weight", 8, 2)->nullable();
            $table->double("height", 8, 2)->nullable();
            $table->double("bsa", 8, 2)->nullable();
            $table->double("bmi", 8, 2)->nullable();
            $table->integer("age")->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
