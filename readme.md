# Student case


I used  slim php framework so I can have some base setup for containers and routing.

---
In order to run the app
1. Clone the repo
2. composer install
3. `cd public && php -S localhost:8888`
---

### Endpoints
`http://localhost:8888/students/:id`

By default the app uses `MemoryStudentRepository`.  
To change to `MysqlStudentRepository` comment out `line 23` in `public/index.php` and uncomment `line 24`.  

**mysql db name**: students_db  
**mysql config** `config/local.php`  
**dummy data** in `seeds/students_db.sql`