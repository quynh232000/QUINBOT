# engine/repositories/trend_repo.py
from config.database import get_connection

def insert_collected_trends(trends, task_id, keyword, source_type='reddit'):
    print(f"[*] Đang chuẩn bị lưu {len(trends)} bài viết vào DB với task_id: {task_id}, keyword: {keyword}, source_type: {source_type}...")
    conn = get_connection()
    print("[*] Kết nối DB thành công, bắt đầu chèn dữ liệu...")
    cursor = conn.cursor()
    sql = """
        INSERT INTO trends (
            user_id, task_id, source_type, search_keyword, external_id, 
            source, post_type, title, content_raw, url_source, 
            thumbnail_url, engagement_score, comment_count, is_nsfw, 
            status, published_at, created_at, updated_at
        )
        VALUES (
            %s, %s, %s, %s, %s, 
            %s, %s, %s, %s, %s, 
            %s, %s, %s, %s, 
            'pending', %s, NOW(), NOW()
        )
        ON DUPLICATE KEY UPDATE 
            engagement_score = VALUES(engagement_score),
            comment_count = VALUES(comment_count),
            title = VALUES(title),
            content_raw = VALUES(content_raw),
            updated_at = NOW();
    """
    try:
        data = [
            (
                None,                   # user_id
                str(task_id),           # Đảm bảo là string
                str(source_type),       # Đảm bảo là string
                str(keyword),           # Đảm bảo là string
                str(t.get('external_id', '')),
                str(t.get('source', '')),
                # Nếu post_hint là list, lấy phần tử đầu hoặc ép về chuỗi
                str(t.get('post_hint')) if t.get('post_hint') else None, 
                str(t.get('title', ''))[:500], # Cắt chuỗi theo giới hạn DB
                str(t.get('content', '')),
                str(t.get('url', ''))[:700],
                str(t.get('thumbnail')) if t.get('thumbnail') else None,
                int(t.get('score', 0)),
                int(t.get('comment_count', 0)),
                1 if t.get('is_nsfw') else 0, # Chuyển bool sang int cho MySQL
                t.get('published_at')
            ) 
            for t in trends
        ]
        cursor.executemany(sql, data) # Dùng executemany để lưu cực nhanh hàng loạt
        conn.commit()
        print(f"[+] Đã lưu thành công {cursor.rowcount} bài viết vào DB.")
    except Exception as e:
        print(f"[X] Lỗi khi lưu vào DB: {e}")
        conn.rollback()
    finally:
        cursor.close()
        conn.close()
        
        
# get_trend_by_id
def get_trend_by_id(trend_id):
    conn = get_connection()
    cursor = conn.cursor(dictionary=True)
    try:
        cursor.execute("SELECT * FROM trends WHERE id = %s", (trend_id,))
        return cursor.fetchone()
    except Exception as e:
        print(f"[X] Lỗi khi lưu vào DB: {e}")
        conn.rollback() 
    finally:
        cursor.close()
        conn.close()
        