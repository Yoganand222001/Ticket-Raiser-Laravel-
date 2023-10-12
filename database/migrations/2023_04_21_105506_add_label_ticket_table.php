<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('label_ticket', function (Blueprint $table) {

            $table->dropForeign('label_ticket_ticket_id_foreign');

            $table->foreign('ticket_id')
                ->references('id')->on('tickets')->onDelete('cascade');

            $table->foreign('label_id')
                ->references('id')->on('labels')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::table('category_ticket', function (Blueprint $table) {

            $table->dropForeign('label_ticket_ticket_id_foreign');

            $table->dropForeign('label_ticket_label_id_foreign');

            $table->dropIndex('label_ticket_ticket_id_foreign');

            $table->dropIndex('label_ticket_label_id_foreign');
        });

    }
};
