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
        Schema::create('video_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trend_id')->nullable()->constrained('trends');
            $table->string('project_name');

            // Cấu hình AI người dùng chọn
            $table->string('ai_model')->default('gpt-4o');
            $table->string('voice_id')->nullable();         // ID giọng đọc ElevenLabs
            $table->string('language')->default('vi');      // vi, en...

            // Trạng thái Pipeline (Dùng để hiển thị Progress Bar)
            // Các step: scripting, voicing, visual_gen, rendering, completed, failed
            $table->string('current_step')->default('scripting');
            $table->integer('progress_percent')->default(0);
            $table->string('status')->default('processing');

            // Kết quả đầu ra
            $table->text('final_script')->nullable();       // Kịch bản sau khi AI viết
            $table->string('voice_url')->nullable();        // Link file audio (.mp3)
            $table->string('video_url')->nullable();        // Link video cuối cùng (.mp4)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_projects');
    }
};
