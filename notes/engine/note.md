pip install playwright celery redis python-dotenv
playwright install chromium # Cài đặt trình duyệt lõi cho scraper
celery -A tasks worker --loglevel=info --pool=threads
celery -A engine.tasks worker --loglevel=info -P solo
redis-cli flushdb
celery -A tasks flower / http://localhost:5555/


