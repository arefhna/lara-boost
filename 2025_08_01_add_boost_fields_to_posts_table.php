<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoostFieldsToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_boosted')->default(false);
            $table->timestamp('boost_start_at')->nullable();
            $table->timestamp('boost_end_at')->nullable();
            $table->timestamp('last_boosted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['is_boosted', 'boost_start_at', 'boost_end_at', 'last_boosted_at']);
        });
    }
}
