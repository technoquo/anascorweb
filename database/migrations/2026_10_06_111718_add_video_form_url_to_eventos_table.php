<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('eventos', function (Blueprint $table): void {
            $table->string('video_url')->nullable()->after('imagen');
            $table->string('form_url')->nullable()->after('video_url');
        });
    }

    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table): void {
            $table->dropColumn(['video_url', 'form_url']);
        });
    }
};
