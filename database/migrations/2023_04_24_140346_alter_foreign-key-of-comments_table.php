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
        Schema::table('comments', function (Blueprint $table) {

            $table->dropForeign('comments_ticket_id_foreign');

            $table->foreign('ticket_id')
                ->references('id')->on('tickets')->cascadeOnDelete();

        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {

            $table->dropForeign('comments_ticket_id_foreign');

            $table->dropForeign('comments_user_id_foreign');

            $table->dropIndex('comments_ticket_id_foreign');

            $table->dropIndex('comments_user_id_foreign');
        });
    }
};
