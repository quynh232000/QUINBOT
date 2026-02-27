import os
import google.generativeai as genai
import json
from dotenv import load_dotenv

load_dotenv()

# Khởi tạo cấu hình
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

def generate_video_script(title, content_raw):
    try:
        # BỎ "models/" ở đầu, chỉ dùng tên model
        # Thử với 'gemini-1.5-flash-8b' (bản cực nhẹ) hoặc 'gemini-1.5-flash'
        model = genai.GenerativeModel(
            model_name='gemini-1.5-flash',
            generation_config={"response_mime_type": "application/json"}
        )

        prompt = f"""
        Bạn là biên kịch video. Dựa vào: {title} - {content_raw}
        Tạo kịch bản video JSON:
        - metadata: {{duration_seconds, theme}}
        - scenes: [{{scene_index, voiceover, visual_prompt, duration}}]
        Yêu cầu: visual_prompt tiếng Anh, voiceover tiếng Việt.
        """

        # Sử dụng retry logic đơn giản
        response = model.generate_content(prompt)
        
        if response and response.text:
            return json.loads(response.text)
        return None

    except Exception as e:
        print(f"[!] Lỗi khi gọi Gemini: {e}")
        # Nếu vẫn 404, hãy thử in danh sách model để kiểm tra (chỉ dùng khi debug)
        # for m in genai.list_models(): print(m.name)
        return None