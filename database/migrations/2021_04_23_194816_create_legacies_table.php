<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegaciesTable extends Migration
{
    final public function up(): void
    {
        Schema::create('legacies', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('cemetery_location');
            $table->year('from');
            $table->year('to');
            $table->text('description');
            $table->timestamps();
        });

        Schema::table('legacies', static function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    final public function down(): void
    {
        Schema::dropIfExists('legacies');
    }
}
