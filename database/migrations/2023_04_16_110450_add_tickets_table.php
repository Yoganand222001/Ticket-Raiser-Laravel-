<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->foreign('agent_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex('tickets_agent_id_foreign');
        });
    }
};
