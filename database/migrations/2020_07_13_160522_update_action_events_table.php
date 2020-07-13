<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateActionEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_events', function (Blueprint $table) {
            $table->char('user_id')->change();
            $table->char('actionable_id', 40)->change();
            $table->char('target_id', 40)->change();
            $table->char('model_id', 40)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(Blueprint $table)
    {
        $table->char('user_id')->change();
        $table->char('actionable_id', 40)->change();
        $table->char('target_id', 40)->change();
        $table->char('model_id', 40)->change();
    }
}
