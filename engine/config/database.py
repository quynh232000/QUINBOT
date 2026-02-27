# engine/config/database.py
import mysql.connector.pooling
import os
from dotenv import load_dotenv

load_dotenv()

db_config = {
    "host": os.getenv("DB_HOST", "127.0.0.1"),
    "user": os.getenv("DB_USERNAME", "root"),
    "password": os.getenv("DB_PASSWORD", ""),
    "database": os.getenv("DB_DATABASE", "quinbot")
}

# Tạo Pool để quản lý nhiều kết nối cùng lúc
pool = mysql.connector.pooling.MySQLConnectionPool(
    pool_name="quinbot_pool",
    pool_size=10, # Cho phép tối đa 10 task kết nối cùng lúc
    **db_config
)

def get_connection():
    return pool.get_connection()