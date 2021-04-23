<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegacyPrivateCommentsTable extends Migration
{
    final public function up(): void
    {
        Schema::create('legacy_private_comments', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('legacy_id');
            $table->text('comment');
            $table->timestamps();
        });

        Schema::table('legacy_private_comments', static function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('legacy_id')->references('id')->on('legacies')->onDelete('CASCADE');
        });
    }

    final public function down(): void
    {
        Schema::dropIfExists('legacy_private_comments');
    }
}
