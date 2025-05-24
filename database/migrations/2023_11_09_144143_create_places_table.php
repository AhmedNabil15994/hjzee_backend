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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description')->nullable();
            $table->integer('provider_id')-> unsigned() -> index();
            $table->integer('city_id')->nullable()-> unsigned() -> index();
            $table->integer('category_id')->nullable()-> unsigned() -> index();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 10, 8)->nullable();
            $table->string('address')->nullable();
            $table->integer('num_meeting_rooms')->nullable()->default(0);
           
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
        Schema::dropIfExists('places');
    }
};
