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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger( 'parent_id' ) -> unsigned() -> index()->nullable();
            $table->string('name');
            
            $table->string('country_code',5)->default('965');
            $table->string('phone',15)->nullable();
            $table->string('email',50);
            $table->string('password',100);
            
            $table->enum('type',['service','place'])->nullable();
            $table->enum('gender',['male','female'])->default('male')->nullable();

            $table->text('job')->nullable();
            $table->text('info')->nullable();
            $table->text('education_info')->nullable();
            $table->double('rate')->nullable()->default(0);
            $table->integer('num_rating')->nullable()->default(0);
            $table->integer('num_courses')->nullable()->default(0);
            $table->integer('num_lessons')->nullable()->default(0);
            $table->string('image', 50)->default('default.png');
            $table->string('lang', 2)->default('ar');
            $table->boolean('is_notify')->default(true);
            $table->string('code', 10)->nullable();
            $table->timestamp('code_expire')->nullable();
            $table->json('employee_permissions')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('providers');
    }
};
