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
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');

            // `int unsigned` に変更して `curriculums.id` と型を合わせる
            $table->unsignedInteger('curriculums_id'); 
            $table->foreign('curriculums_id')->references('id')->on('curriculums')->onDelete('cascade');

            $table->tinyInteger('clear_flg')->default(0);
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
        Schema::table('curriculum_progress', function (Blueprint $table) {
            $table->dropForeign(['curriculums_id']);
            $table->dropForeign(['users_id']);
        });

        Schema::dropIfExists('curriculum_progress');
    }
};
