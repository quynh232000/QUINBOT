from groq import Groq
import os
import json

client = Groq(api_key=os.getenv("GROQ_API_KEY"))

def generate_video_script(title, content_raw):
    try:
        num_scenes = 8 # TikTok hiện tại ưu tiên video trên 1 phút, 8-10 scenes là lý tưởng

        chat_completion = client.chat.completions.create(
            messages=[
                {
                    "role": "system",
                    "content": (
                        "Bạn là chuyên gia biên kịch TikTok (Content Creator) sở hữu kênh triệu view. "
                        "Phong cách viết của bạn là: Giật gân, cuốn hút, súc tích và đánh vào tâm lý tò mò. "
                        f"Nhiệm vụ: Tạo kịch bản JSON gồm ít nhất {num_scenes} phân cảnh (scenes). "
                        
                        "Quy tắc vàng của kịch bản: "
                        "1. Scene 1 phải là HOOK (Mồi nhử) cực mạnh, đánh thẳng vào vấn đề hoặc gây sốc trong 3 giây đầu. "
                        "2. Các Scene tiếp theo phải duy trì nhịp độ nhanh, không thừa thãi. "
                        "3. Voiceover phải tự nhiên như người thật nói, sử dụng từ ngữ bắt trend, tránh dùng từ ngữ hành chính. "
                        "4. Visual_prompt phải miêu tả điện ảnh (cinematic), ánh sáng cực đẹp để AI tạo ảnh chất lượng cao. "
                        
                        "Cấu trúc JSON yêu cầu: "
                        "{"
                        "  'title_vi': 'Tiêu đề giật gân (Clickbait)', "
                        "  'metadata': {'duration_seconds': 60, 'theme': 'phong cách video', 'target_audience': 'đối tượng xem'}, "
                        "  'scenes': ["
                        "     {'id': 1, 'description': 'Mô tả hình ảnh', 'visual_prompt': 'English cinematic prompt', 'characters': [], 'voiceover': 'Lời thoại lôi cuốn'} "
                        "  ], "
                        "  'plot_twists': [{'id': 1, 'description': 'Cú lừa/Sự thật bất ngờ', 'impact': 'Tại sao nó khiến người xem phải comment'}]"
                        "}. "
                        
                        "YÊU CẦU QUAN TRỌNG: "
                        "1. Tuyệt đối không được 'lười', phải tạo đủ số lượng scene yêu cầu. "
                        "2. Phải có ít nhất 1 Plot Twist ở gần cuối để giữ chân người xem đến giây cuối cùng. "
                        "3. Ngôn ngữ: Visual_prompt (Tiếng Anh), còn lại là Tiếng Việt (Gen Z, tự nhiên)."
                    )
                },
                {
                    "role": "user",
                    "content": f"Hãy tạo kịch bản viral cho chủ đề: '{title}'. Nội dung gốc: {content_raw}"
                }
            ],
            model="llama-3.3-70b-versatile",
            response_format={"type": "json_object"},
            temperature=0.85 # Tăng một chút để AI sáng tạo ngôn từ "bay bổng" hơn
        )
        data = json.loads(chat_completion.choices[0].message.content)
        # print(f'data gen-------: {data}')
        return data
    except Exception as e:
        print(f"Groq Error: {e}")
        return None