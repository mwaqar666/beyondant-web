<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegacyTimelineTable extends Migration
{
    final public function up(): void
    {
        Schema::create('legacy_timeline', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('legacy_id');
            $table->year('year');
            $table->string('heading');
            $table->text('description');
            $table->timestamps();
        });

        Schema::table('legacy_timeline', static function (Blueprint $table) {
            $table->foreign('legacy_id')->references('id')->on('legacies')->onDelete('CASCADE');
        });
    }

    final public function down(): void
    {
        Schema::dropIfExists('legacy_timeline');
    }
}
