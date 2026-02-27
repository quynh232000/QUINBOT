# Sử dụng image Python chính thức
FROM python:3.10-slim

# Thiết lập thư mục làm việc trong container
WORKDIR /app

# Copy file danh sách thư viện vào trước
COPY requirements.txt .

# Chạy lệnh cài đặt (Đây là lúc thư viện thực sự được nạp vào Docker)
RUN pip install --no-cache-dir -r requirements.txt

# Copy toàn bộ code vào sau
COPY . .

CMD ["python", "main.py"]