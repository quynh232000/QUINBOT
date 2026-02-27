# import os
# from celery import Celery
# from dotenv import load_dotenv
# from processors.reddit_scraper import scrape_reddit_trending

# load_dotenv()

# app = Celery('quinbot_engine', 
#              broker=os.getenv('REDIS_URL', 'redis://localhost:6379/0'),
#              backend=os.getenv('REDIS_URL', 'redis://localhost:6379/0'))

# app.conf.task_default_queue = 'quinbot-database-celery'

# @app.task(name="tasks.collect_trends")
# def collect_trends(sources=['ArtificialInteligence', 'programming'],task_id=None):
#     all_trends = []
#     print(f"--- Bắt đầu Task cào dữ liệu: {sources} ---")
    
#     # Ép kiểu sources thành list nếu bị gửi sang dạng string/ký tự
#     if isinstance(sources, str):
#         sources = [sources]

#     for sub in sources:
#         print(f"[*] Đang cào r/{sub}...")
#         try:
#             # GỌI TRỰC TIẾP: Không cần loop.run_until_complete vì scrape_reddit_trending giờ là hàm thường
#             trends = scrape_reddit_trending(sub, limit=5)
            
#             if trends:
#                 print(f"[+] Thành công r/{sub}: Thu thập {len(trends)} bài viết")
#                 all_trends.extend(trends)
#             else:
#                 print(f"[!] r/{sub} không trả về dữ liệu.")
                
#         except Exception as e:
#             print(f"[X] Lỗi tại subreddit {sub}: {e}")
            
#     if all_trends:
#         # Gọi hàm lưu vào DB (Tôi sẽ viết hàm này ở dưới)
#         save_to_database(all_trends, task_id, sources)
        
#     return f"Đã lưu thành công {len(all_trends)} tin vào DB với Task ID: {task_id}"

from celery import Celery
import os
from dotenv import load_dotenv

load_dotenv()

app = Celery('quinbot_engine',
             broker=os.getenv('REDIS_URL', 'redis://localhost:6379/0'),
             backend=os.getenv('REDIS_URL', 'redis://localhost:6379/0'))

# QUAN TRỌNG: Khai báo tất cả các file chứa task ở đây
app.conf.update(
    imports=[
        'tasks.trend_tasks', 
        'tasks.ai_tasks',
    ],
    task_default_queue='quinbot-database-celery',
)