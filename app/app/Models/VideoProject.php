<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoProject extends Model
{
    protected $guarded = [];
    protected $casts = [
        'final_script' => 'array', // Hoặc 'json' tùy phiên bản Laravel
    ];
    public function getStatusLabelAttribute()
    {
        // Giả sử bạn dùng Constant/Enum đã tạo trước đó
        return match ($this->status) {
            'pending' => 'Đang chờ',
            'processing' => 'Đang xử lý',
            'completed' => 'Hoàn thành',
            default => 'Lỗi',
        };
    }
    public function trend(){
        return $this->belongsTo(Trend::class,'trend_id','id');
    }
}
