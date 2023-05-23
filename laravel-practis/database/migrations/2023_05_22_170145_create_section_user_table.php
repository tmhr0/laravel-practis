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
        Schema::create('section_user', function (Blueprint $table) {
            $table->comment('sectionとuserの中間テーブル');
            $table->id()->comment('ID');
            $table->foreignIdFor(\App\Models\Section::class)->comment('部署ID');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class)->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_user');
    }
};
