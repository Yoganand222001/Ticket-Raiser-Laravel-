<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('counts', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('tickets_count');
            $table->smallInteger('activity_count');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('counts');
    }
};
