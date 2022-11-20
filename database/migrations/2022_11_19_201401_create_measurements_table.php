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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensor_id')->constrained('sensors');
            $table->double('irrigation')->nullable();
            $table->double('acidity')->nullable();
            $table->double('irradiation')->nullable();
            $table->double('phosphorus')->nullable();
            $table->double('potassium')->nullable();
            $table->double('magnesium')->nullable();
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
        Schema::dropIfExists('measurements');
    }
};
