<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    final public function up(): void
    {
        Schema::table('users',function (Blueprint $table){
            $table->bigInteger('contact_number')->nullable();
            $table->string('occupation', 100)->nullable();
            $table->string('profile_picture', 100)->nullable();
            $table->integer('votes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    final public function down(): void
    {
        Schema::table('users',function (Blueprint $table){
            $table->dropColumn('contact_number');
            $table->dropColumn('occupation');
            $table->dropColumn('profile_picture');
        });
    }
}
