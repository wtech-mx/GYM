<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollsToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolls_to', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_plan');
            $table->unsignedBigInteger('id_user');
            $table->date('plan_date');
            $table->date('expire');
            $table->string('renewal');

            $table->foreign('id_plan')
                ->references('id')->on('plan')
                ->inDelete('set null');

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
        Schema::dropIfExists('enrolls_to');
    }
}
