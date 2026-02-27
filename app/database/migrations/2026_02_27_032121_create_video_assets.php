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
        Schema::create('video_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_project_id')->constrained('video_projects')->onDelete('cascade');
            $table->integer('scene_index');        // Cảnh số 1, 2, 3...
            $table->text('scene_text');            // Đoạn văn bản cho cảnh này
            $table->string('image_prompt');        // Prompt dùng để gen ảnh/video nền
            $table->string('asset_path');          // Đường dẫn file ảnh/clip đã gen
            $table->string('asset_type')->default('image'); // image, video_clip
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_assets');
    }
};
