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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('provider_id')-> unsigned() -> index();
            $table->integer('place_id')->nullable()-> unsigned() -> index();
            $table->integer('category_id')->nullable()-> unsigned() -> index();
            $table->text('description')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->text('times')->nullable();
            
            $table->double('price', 9, 2)->default(0)->nullable();;
            $table->double('offer_price', 9, 2)->default(0)->nullable();;

            $table->integer('num_seats')->nullable()->default(0);

            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 10, 8)->nullable();
            $table->string('address')->nullable();
            
            $table->json('options')->nullable();
            $table->json('target_audience')->nullable();
            $table->integer('from_age')->nullable();
            $table->integer('to_age')->nullable();

            $table->boolean('allow_notes')->default(1);
            $table->boolean('is_free')->default(0);
            $table->boolean('need_confirm')->default(0);

            $table->double('rate')->nullable()->default(0);
            $table->integer('num_rating')->nullable()->default(0);
            $table->integer('num_views')->nullable()->default(0);
            $table->integer('num_reservations')->nullable()->default(0);

            $table->boolean('pin')->default(0);
            $table->integer('sort')->nullable()->default(0);
            $table->boolean('is_active')->default(1);
            $table->date('expire_at')->nullable();
            
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
        Schema::dropIfExists('services');
    }
};
