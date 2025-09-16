# 📌 Laravel PostgreSQL Todo API (Technical Test)

Proyek ini adalah implementasi Todo API menggunakan **Laravel + PostgreSQL** untuk memenuhi soal technical test.  
Fitur yang tersedia:
- ✅ Create Todo (API POST)
- ✅ Export Todo ke Excel dengan filter (API GET)
- ✅ Chart Data (API GET, summary by status, priority, assignee)

---

## 🚀 Cara Install & Jalankan

```bash
# 1. Clone repository
git clone https://github.com/your-username/your-repo.git
cd your-repo

# 2. Install dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Atur koneksi database PostgreSQL di file .env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=todo_db
DB_USERNAME=postgres
DB_PASSWORD=your_password

# 5. Generate key
php artisan key:generate

# 6. Jalankan migrasi & seeder
php artisan migrate --seed

# 7. Jalankan server
php artisan serve


API bisa diakses di:
👉 http://127.0.0.1:8000/api

Seeder otomatis membuat dummy data Todo agar bisa langsung diuji.

📊 API Endpoints
1. Create Todo

Endpoint

POST /api/todos


Body (JSON)
{
  "title": "Belajar Laravel",
  "assignee": "Saul",
  "due_date": "2025-09-20",
  "time_tracked": 5,
  "status": "open",
  "priority": "high"
}

Catatan Validasi

title: wajib

due_date: wajib, tidak boleh di masa lalu

status: default pending jika tidak dikirim

time_tracked: default 0 jika tidak dikirim

priority: enum low, medium, high

Response

{
  "id": 1,
  "title": "Belajar Laravel",
  "assignee": "Saul",
  "due_date": "2025-09-20",
  "time_tracked": 5,
  "status": "open",
  "priority": "high",
  "created_at": "2025-09-17T10:00:00.000000Z"
}


2. Export Todos ke Excel

Endpoint

GET /api/todos/export


| Param    | Tipe      | Contoh       | Keterangan                 |
| -------- | --------- | ------------ | -------------------------- |
| title    | string    | belajar      | Partial match              |
| assignee | string\[] | John,Doe     | Multi value (dipisah koma) |
| start    | date      | 2025-09-01   | Range awal due\_date       |
| end      | date      | 2025-09-30   | Range akhir due\_date      |
| min      | integer   | 0            | Min time\_tracked          |
| max      | integer   | 100          | Max time\_tracked          |
| status   | string\[] | pending,open | Multi value                |
| priority | string\[] | low,high     | Multi value                |


GET /api/todos/export?title=belajar&assignee=Saul&start=2025-09-01&end=2025-09-30&min=0&max=100&status=pending,open&priority=high

esponse

Menghasilkan file Excel todos_export_YYYYMMDD_HHMMSS.xlsx

Kolom: title, assignee, due_date, time_tracked, status, priority

Baris terakhir berisi summary:

Total Todos

Total Time Tracked


Contoh Hasil Excel (preview tabel Markdown)


| title           | assignee | due\_date  | time\_tracked | status  | priority |
| --------------- | -------- | ---------- | ------------- | ------- | -------- |
| Belajar Laravel | Saul     | 2025-09-20 | 5             | open    | high     |
| Belajar Export  | John     | 2025-09-25 | 10            | pending | high     |
| **Summary**     | -        | -          | **15**        | **2**   | -        |



3. Chart Data

Endpoint

GET /api/chart?type={status|priority|assignee}

a. Status Summary
GET /api/chart?type=status


Response

{
  "status_summary": {
    "pending": 5,
    "open": 3,
    "in_progress": 2,
    "completed": 7
  }
}

b. Priority Summary
GET /api/chart?type=priority


Response

{
  "priority_summary": {
    "low": 4,
    "medium": 6,
    "high": 7
  }
}

c. Assignee Summary
GET /api/chart?type=assignee


Response

{
  "assignee_summary": {
    "Saul": {
      "total_todos": 5,
      "total_pending_todos": 2,
      "total_timetracked_completed_todos": 8
    },
    "John": {
      "total_todos": 3,
      "total_pending_todos": 1,
      "total_timetracked_completed_todos": 5
    }
  }
}


📥 Postman Collection
Buat file Todo-API.postman_collection.json lalu import ke Postman.
Contoh minimal collection sudah tersedia di atas dengan endpoint:

POST /api/todos

GET /api/todos/export

GET /api/chart?type=status

GET /api/chart?type=priority

GET /api/chart?type=assignee




👤 Author

Nama: Saul Santo Anju
Role: Backend Developer (Laravel, REST API, PostgreSQL)



