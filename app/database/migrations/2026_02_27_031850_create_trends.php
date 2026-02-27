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
        Schema::create('trends', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->index(); 

            $table->string('task_id')->nullable()->index();
            $table->string('source_type')->default('reddit'); // reddit, hackernews, web_crawl...
            $table->string('search_keyword')->nullable()->index();
            
            // Định danh và Phân loại
            $table->string('external_id')->unique();        // ID từ Reddit (ví dụ: t3_1asdfg)
            $table->string('source');                       // r/ArtificialIntelligence, r/technology...
            $table->string('post_type')->nullable();        // image, video, link, self (văn bản)
            
            // Nội dung chính
            $table->string('title', 500);
            $table->text('content_raw')->nullable();        // Nội dung văn bản (selftext)
            $table->string('url_source', 700);              // Link đến bài viết gốc
            $table->string('thumbnail_url', 700)->nullable();
            
            // Chỉ số Viral (Dùng để sắp xếp mức độ ưu tiên)
            $table->integer('engagement_score')->default(0); // Upvotes
            $table->integer('comment_count')->default(0);   // Số bình luận
            $table->float('upvote_ratio')->nullable();      // Tỉ lệ upvote (biết được độ hot/tranh cãi)
            
            // Trạng thái hệ thống
            $table->string('status')->default('pending');    // pending, approved, rejected, processing, completed
            $table->boolean('is_nsfw')->default(false);     // Bộ lọc nội dung nhạy cảm
            
            // Thời gian
            $table->timestamp('published_at')->nullable();  // Thời gian bài được đăng trên nguồn gốc
            $table->timestamps();                            // created_at (lúc cào về), updated_at
            
            // Index để truy vấn nhanh
            $table->index(['source', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trends');
    }
};
