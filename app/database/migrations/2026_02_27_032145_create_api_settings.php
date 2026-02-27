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
        // Bảng lưu Token API cho người dùng (OpenAI, ElevenLabs, TikTok...)
        Schema::create('api_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('provider'); // openai, elevenlabs, tiktok, youtube
            $table->text('api_key');    // Nên được mã hóa (encrypted)
            $table->timestamps();
        });

        // Bảng lên lịch đăng bài
        Schema::create('publishing_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_project_id')->constrained();
            $table->string('platform');       // tiktok, youtube_shorts, facebook_reels
            $table->timestamp('scheduled_at');
            $table->string('status')->default('scheduled'); // scheduled, published, failed
            $table->string('platform_video_id')->nullable(); // ID sau khi đăng thành công
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_settings');
        Schema::dropIfExists('publishing_schedules');
    }
};
