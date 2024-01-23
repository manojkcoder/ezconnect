<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_social_networks', function (Blueprint $table) {
            $table->string('custom_icon_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_social_networks', function (Blueprint $table) {
            $table->dropColumn('custom_icon_url');
        });
    }
};
