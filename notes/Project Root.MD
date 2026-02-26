quinbot/
├── app/                 # Laravel Project (Dashboard, API, Job Dispatcher)
├── engine/              # Python AI Engine (Workers, AI Logic, Rendering)
├── shared/              # Thư mục dùng chung (Media, Logs, Temporary files)
│   ├── storage/         # Chứa video, ảnh, audio đang xử lý
│   └── models/          # Chứa các file AI models tải về (nếu chạy local)
├── docker/              # Chứa các Dockerfile tùy chỉnh
│   ├── php/
│   ├── python/
│   └── nginx/
├── .env                 # Biến môi trường tổng (DB, Redis, API Keys)
└── docker-compose.yml   # Orchestration cho toàn bộ hệ thống


engine/
├── tasks.py          # Nơi định nghĩa các hàm Celery (Crawl, Render, Gen AI)
├── utils/            # Các công cụ bổ trợ (Kết nối DB, gọi API)
├── processors/       # Logic chi tiết từng bước (Scraper.py, Video.py)
├── Dockerfile        # Đóng gói Python environment
└── requirements.txt  # Danh sách thư viện