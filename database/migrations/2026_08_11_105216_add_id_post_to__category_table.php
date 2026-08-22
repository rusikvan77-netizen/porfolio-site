<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('Category', function (Blueprint $table) {
            $table->unsignedBigInteger('idPost')->after('nameCategory');
            $table->foreign('idPost')->references('id')->on('posts')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('=Category', function (Blueprint $table) {
            $table->dropForeign('idPost');
            $table->dropColumn('idPost');
        });
    }
};
