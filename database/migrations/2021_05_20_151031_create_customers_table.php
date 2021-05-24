<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('gender');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->date('date_birth');

            $table->string('streetName');
            $table->string('state');
            $table->string('city');
            $table->string('zipcode');

            $table->unsignedBigInteger('id_plan');
            $table->date('joining_date');

            $table->foreign('id_plan')
                ->references('id')->on('plan')
                ->inDelete('set null');

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
        Schema::dropIfExists('customers');
    }
}
