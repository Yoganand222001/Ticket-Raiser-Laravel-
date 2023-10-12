<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('category_ticket', function (Blueprint $table) {

            $table->dropForeign('category_ticket_ticket_id_foreign');

            $table->dropForeign('category_ticket_category_id_foreign');

            $table->foreign('ticket_id')
                ->references('id')->on('tickets')->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')->on('categories')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::table('category_tickets', function (Blueprint $table) {

            $table->dropForeign('category_ticket_ticket_id_foreign');

            $table->dropForeign('category_ticket_category_id_foreign');

            $table->dropIndex('category_ticket_ticket_id_foreign');

            $table->dropIndex('category_ticket_category_id_foreign');
        });
    }
};
