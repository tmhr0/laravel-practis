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
        Schema::create('user_section', function (Blueprint $table) {
            $table->comment('userとsectionの中間テーブル');
            $table->id()->comment('ID');
            $table->foreignIdFor(\App\Models\Section::class)->comment('部署ID');
            $table->foreignIdFor(\App\Models\User::class)->comment('ユーザーID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_section');
    }
};
