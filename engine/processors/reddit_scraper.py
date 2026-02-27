# engine/processors/reddit_scraper.py
from playwright.sync_api import sync_playwright

def scrape_reddit_trending(subreddit="ArtificialInteligence", limit=5):
    # Đảm bảo không có event loop nào bị kẹt
    # return '123'
    with sync_playwright() as p:
        print(f"--- Mở trình duyệt để cào r/{subreddit} ---")
        # Thêm argument để chạy ổn định hơn trong môi trường server/worker
        browser = p.chromium.launch(
            headless=True,
            args=["--no-sandbox", "--disable-gpu"] # Giảm tải cho Windows
        )
        print(f"--- Trình duyệt đã mở, bắt đầu truy cập r/{subreddit} ---")
        context = browser.new_context(user_agent="Mozilla/5.0 ...")
        page = context.new_page()
        print(f"--- Đã tạo page mới, bắt đầu truy cập r/{subreddit} ---")
        try:
            url = f"https://www.reddit.com/r/{subreddit}/top/?t=day"
            page.goto(url, wait_until="domcontentloaded", timeout=60000) # Đợi DOM thôi cho nhanh
            print(f"--- Đã truy cập r/{subreddit}, bắt đầu cào dữ liệu ---")
            posts = page.query_selector_all('shreddit-post')
            results = []
            for post in posts[:limit]:
                  title = post.get_attribute('post-title')

            link = post.get_attribute('content-href')

            score = post.get_attribute('score') # Số upvote
            if title and link:

                results.append({
                    "title": title,
                    "url": link,
                    "score": score,
                    "source": f"r/{subreddit}"
                })
            return results
        finally:
            browser.close()