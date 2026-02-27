# engine/processors/ai_handlers.py
import os
import json
from openai import OpenAI
from dotenv import load_dotenv

load_dotenv()

client = OpenAI(base_url=os.getenv("OPENAI_API_URL") ,api_key=os.getenv("OPENAI_API_KEY"))

def generate_video_script(title, content_raw):
    """
    Biến nội dung thô thành kịch bản phân cảnh (JSON)
    """
    system_prompt = """
    Bạn là chuyên gia biên kịch video ngắn (TikTok/Reels/Shorts).
    Nhiệm vụ: Chuyển nội dung người dùng cung cấp thành kịch bản video hấp dẫn.
    Định dạng đầu ra PHẢI là JSON chuẩn với cấu trúc sau:
    {
        "metadata": {"duration_seconds": 60, "theme": "modern"},
        "scenes": [
            {
                "scene_index": 1,
                "voiceover": "Lời thoại nhân vật hoặc thuyết minh bằng tiếng Việt",
                "visual_prompt": "Mô tả chi tiết hình ảnh để AI Gen ảnh (bằng tiếng Anh)",
                "duration": 5
            }
        ]
    }
    """

    user_content = f"Tiêu đề: {title}\nNội dung gốc: {content_raw}"

    try:
        response = client.chat.completions.create(
            # model="gpt-4o-2024-08-06", # Hoặc gpt-4o-mini để tiết kiệm
            model="upstage/solar-pro-3:free", # Hoặc gpt-4o-mini để tiết kiệm
            messages=[
                {"role": "system", "content": system_prompt},
                {"role": "user", "content": user_content}
            ],
            response_format={ "type": "json_object" } # Ép trả về JSON
        )
        
        # Parse kết quả
        script_data = json.loads(response.choices[0].message.content)
        return script_data
        
    except Exception as e:
        print(f"Lỗi khi gọi AI: {e}")
        return None