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
