from celery import shared_task
from repositories.trend_repo import insert_collected_trends
from processors.reddit_scraper import scrape_reddit_trending
@shared_task(name="tasks.collect_trends")
def collect_trends(sources=['ArtificialInteligence', 'programming']):
    all_trends = []
    print(f"--- Bắt đầu Task cào dữ liệu: {sources} ---")
    task_id = 1  # Giả định có task_id từ bên ngoài, bạn có thể thay thế bằng cách lấy từ DB hoặc tham số truyền vào
    
    # Ép kiểu sources thành list nếu bị gửi sang dạng string/ký tự
    if isinstance(sources, str):
        sources = [sources]

    for sub in sources:
        print(f"[*] Đang cào r/{sub}...")
        try:
            # GỌI TRỰC TIẾP: Không cần loop.run_until_complete vì scrape_reddit_trending giờ là hàm thường
            trends = scrape_reddit_trending(sub, limit=5)
            
            if trends:
                print(f"[+] Thành công r/{sub}: Thu thập {len(trends)} bài viết")
                all_trends.extend(trends)
            else:
                print(f"[!] r/{sub} không trả về dữ liệu.")
                
        except Exception as e:
            print(f"[X] Lỗi tại subreddit {sub}: {e}")
            
    if all_trends:
        print(f"[*] Đang lưu {len(all_trends)} bài viết vào DB...")
        # Gọi hàm lưu vào DB (Tôi sẽ viết hàm này ở dưới)
        insert_collected_trends(all_trends, task_id, sources[0], source_type='reddit')
        
    return f"Đã lưu thành công {len(all_trends)} tin vào DB với Task ID: {task_id}"