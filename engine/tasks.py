import os
import sys
import asyncio
from celery import Celery
from dotenv import load_dotenv
from processors.reddit_scraper import scrape_reddit_trending

load_dotenv()

# Cấu hình Celery
app = Celery('quinbot_engine', 
             broker=os.getenv('REDIS_URL', 'redis://localhost:6379/0'),
             backend=os.getenv('REDIS_URL', 'redis://localhost:6379/0'))

app.conf.task_default_queue = 'quinbot-database-celery'

@app.task(name="tasks.collect_trends")
def collect_trends(sources=['ArtificialInteligence', 'programming']):
    all_trends = []
    print(f"--- Bắt đầu Task cào dữ liệu: {sources} ---")
    
    # THIẾT LẬP LOOP CHO WINDOWS TRONG MỖI LẦN CHẠY TASK
    if sys.platform == 'win32':
        # ProactorEventLoop là bắt buộc để Playwright có thể mở Chrome
        loop = asyncio.ProactorEventLoop()
        asyncio.set_event_loop(loop)
    else:
        loop = asyncio.new_event_loop()
        asyncio.set_event_loop(loop)

    try:
        for sub in sources:
            print(f"--- Đang cào r/{sub} ---")
            try:
                # Chạy hàm async bằng loop vừa khởi tạo
                trends = loop.run_until_complete(scrape_reddit_trending(sub))
                all_trends.extend(trends)
            except Exception as e:
                print(f"Lỗi khi cào r/{sub}: {e}")
    finally:
        loop.close()
        print("--- Task hoàn tất, đã đóng loop ---")
            
    return all_trends