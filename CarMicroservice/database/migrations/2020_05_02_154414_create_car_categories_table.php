<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('car_categories', function (Blueprint $table) {
            $table->bigIncrements('_id');
            $table->string('name')->unique();
            $table->decimal('price_per_minute', 10, 2)->default(0.00);
            $table->boolean('isRegisterable')->default(false);
            $table->boolean('isBillable')->default(false);
            $table->boolean('monthlyCharge')->default(false);
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_categories');
    }
}
