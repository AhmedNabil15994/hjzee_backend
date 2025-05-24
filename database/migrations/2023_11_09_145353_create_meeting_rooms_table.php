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
        Schema::create('meeting_rooms', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description')->nullable();
            $table->integer('place_id')->nullable()-> unsigned() -> index();
            $table->integer('category_id')->nullable()-> unsigned() -> index();
            
            $table->double('price', 9, 2)->default(0);
            $table->double('offer_price', 9, 2)->default(0);

            $table->boolean('allow_notes')->default(1);
            $table->boolean('need_confirm')->default(0);

            $table->integer('num_seats')->nullable()->default(0);
            
            $table->json('options')->nullable();

            $table->double('rate')->nullable()->default(0);
            $table->integer('num_rating')->nullable()->default(0);
            $table->integer('num_views')->nullable()->default(0);

            $table->integer('num_reservations')->default(0)->nullable();

            $table->boolean('pin')->default(0);
            $table->integer('sort')->nullable()->default(0);
            $table->boolean('is_active')->default(1);
            
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
        Schema::dropIfExists('meeting_rooms');
    }
};
