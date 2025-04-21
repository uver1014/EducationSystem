<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curriculums_id');
            $table->unsignedBigInteger('users_id');
            $table->tinyInteger('clear_flg')->default(0)->nullable(false)->comment('クリア:1,未クリア:0');
            $table->timestamps();

            $table->foreign('curriculums_id')->references('id')->on('curriculums')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculum_progress');
    }
};
