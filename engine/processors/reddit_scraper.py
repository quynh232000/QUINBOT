# engine/processors/reddit_scraper.py
from datetime import datetime

import requests

def scrape_reddit_trending(subreddit="ArtificialInteligence", limit=5):
    results = []
    # Endpoint JSON thần thánh của Reddit
    url = f"https://www.reddit.com/r/{subreddit}/top/.json?t=day&limit={limit}"
    # url = f"https://www.reddit.com/search.json?q={subreddit}&sort=top&t=day&limit={limit}"
    
    # Header giả lập trình duyệt cơ bản là đủ với Endpoint này
    headers = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
    }

    try:
        # print(f"[*] Đang lấy dữ liệu từ Reddit JSON: {url}")
        response = requests.get(url, headers=headers, timeout=10)
        
        if response.status_code == 200:
            data = response.json()
            posts = data.get('data', {}).get('children', [])
            
            for post in posts:
                post_data = post.get('data', {})
                created_utc = post_data.get('created_utc')
                formatted_date = datetime.fromtimestamp(created_utc).strftime('%Y-%m-%d %H:%M:%S') if created_utc else None
                results.append({
                    "external_id": post_data.get('id'),
                    "title": post_data.get('title'),
                    "content": post_data.get('selftext'),
                    "url": f"https://www.reddit.com{post_data.get('permalink')}",
                    "score": post_data.get('ups'),
                    "comment_count": post_data.get('num_comments'),
                    "source": f"r/{subreddit}",
                    "thumbnail": post_data.get('thumbnail') if post_data.get('thumbnail') not in ['self', 'default', ''] else None,
                    "published_at": formatted_date,
                    
                    # --- THÔNG TIN BỔ SUNG QUAN TRỌNG ---
                    "is_nsfw": post_data.get('over_18', False), # Để lọc nội dung nhạy cảm
                    "post_hint": post_data.get('post_hint'),    # 'image', 'link', 'hosted:video' (giúp xác định loại nội dung)
                    "clicked": False                            # Đánh dấu trạng thái đã đọc/xử lý chưa
                })
                # print(f"    - Lấy bài: {post_data.get('title')}")
            
            # print(f"[+] Đã lấy thành công {len(results)} bài viết.")
            return results
        else:
            # log file bị lỗi
            print(f"[!]  Lỗi HTTP {response.status_code}")
            return []
            
    except Exception as e:
        print(f"[X] Lỗi: {str(e)}")
        return []