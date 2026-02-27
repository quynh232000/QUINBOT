# engine/repositories/video_repo.py
from config.database import get_connection
import json

def update_video_project(project_id, data):
    conn = get_connection()
    cursor = conn.cursor(dictionary=True)
    
    # KIỂM TRA VÀ CHUYỂN ĐỔI TỰ ĐỘNG
    processed_data = {}
    for key, value in data.items():
        if isinstance(value, dict) or isinstance(value, list):
            # Nếu là dict hoặc list thì chuyển thành chuỗi JSON
            processed_data[key] = json.dumps(value, ensure_ascii=False)
        else:
            processed_data[key] = value

    placeholders = ", ".join([f"{key} = %s" for key in processed_data.keys()])
    values = list(processed_data.values())
    values.append(project_id)
    
    sql = f"UPDATE video_projects SET {placeholders}, updated_at = NOW() WHERE id = %s"
    
    try:
        cursor.execute(sql, values)
        conn.commit()
        print(f"--- [DB] Project {project_id} cập nhật thành công ---")
    except Exception as e:
        print(f"Lỗi SQL: {e}")
    finally:
        cursor.close()
        conn.close()

def get_video_project_by_id(project_id):
    conn = get_connection()
    cursor = conn.cursor(dictionary=True)
    try:
        cursor.execute("SELECT * FROM video_projects WHERE id = %s", (project_id,))
        return cursor.fetchone()
    finally:
        cursor.close()
        conn.close()