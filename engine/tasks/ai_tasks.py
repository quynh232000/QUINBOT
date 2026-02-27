from celery import shared_task
import json
# from processors.ai_handlers import generate_video_script 
# from processors.gen_content.ai_gemini import generate_video_script 
from processors.gen_content.ai_groq import generate_video_script 
from repositories.trend_repo import get_trend_by_id
from repositories.video_repo import update_video_project

@shared_task(name="tasks.generate_script")
def generate_script(project_id, trend_id):
    # print(f"[*] project_id: {project_id} ; trend_id:{trend_id}")
    # 1. Lấy nội dung gốc từ DB
    
    trend = get_trend_by_id(trend_id)
    # print(f"[*] trend: {trend} ")
    # 2. Gọi AI viết kịch bản
    print(f"[*] Đang viết kịch bản cho Project {project_id}...")
    # return 12
    script_json = generate_video_script(trend['title'], trend['content_raw'])
    
    # 3. Lưu kịch bản vào bảng video_projects
    if script_json:
        script_as_string = json.dumps(script_json, ensure_ascii=False)
        update_video_project(project_id, {
            'final_script': script_as_string,
            'current_step': 'voicing', # Bước tiếp theo là gen giọng nói
            'progress_percent': 30,
            'ai_model' : 'grop/llama-3.3-70b-versatile'
        })
    
    return f"Đã xong kịch bản cho project {project_id}"