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
        Schema::create('favorite_meeting_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('meeting_room_id')->constrained()->references('id')->on('meeting_rooms')->onDelete('cascade');
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
        Schema::dropIfExists('favorite_meeting_rooms');
    }
};
