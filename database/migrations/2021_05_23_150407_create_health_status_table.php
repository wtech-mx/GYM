<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_status', function (Blueprint $table) {
            $table->id();
            $table->string('calorie');
            $table->string('height');
            $table->string('weight');
            $table->string('fat');
            $table->string('remarks');
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_user')
                ->references('id')->on('customers')
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
        Schema::dropIfExists('health_status');
    }
}
