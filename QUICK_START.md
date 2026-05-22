# 🚀 QUICK START GUIDE

## 3 Simple Steps to Run the Application

### Step 1: Import Database
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Click **SQL** tab
3. Copy ALL content from `database_setup.sql`
4. Paste and click **Go**

### Step 2: Create Storage Link
Open Command Prompt in project folder:
```bash
php artisan storage:link
```

### Step 3: Start Server
```bash
php artisan serve
```

Visit: **http://localhost:8000**

---

## 🔑 Login Credentials

**Email:** admin@example.com  
**Password:** password

---

## 📋 SQL Script Location

The complete SQL script is in: `database_setup.sql`

**What it includes:**
- Creates database: `merenciano_db`
- Creates all tables (users, students, products, etc.)
- Inserts sample data
- Sets up migrations table

---

## ✨ Features Overview

### 1. Authentication
- Register new account
- Login/Logout
- Session handling

### 2. Dashboard
- View statistics
- Interactive charts
- Quick overview

### 3. Users Management
- Add/Edit/Delete users
- View all users
- Manage user information

### 4. Students Module
- Complete CRUD operations
- Student records management
- Track GPA and status

### 5. Products Module
- User-specific products
- Inventory management
- Category-based organization

### 6. User Profile
- View profile
- Edit information
- Upload profile picture
- Change password

---

## 🎨 UI Features

✅ Bootstrap 5 responsive design  
✅ Sidebar navigation  
✅ Toast notifications  
✅ Form validation  
✅ Charts and graphs  
✅ Clean modern interface  

---

## 📁 Important Files

- `database_setup.sql` - Complete database script
- `SETUP_INSTRUCTIONS.md` - Detailed documentation
- `.env` - Already configured for XAMPP
- `routes/web.php` - All application routes

---

## 🔧 Troubleshooting

**Problem:** Database connection error  
**Solution:** Make sure XAMPP MySQL is running

**Problem:** Storage link error  
**Solution:** Run `php artisan storage:link`

**Problem:** Profile picture not showing  
**Solution:** Check if storage link was created

**Problem:** Port 8000 already in use  
**Solution:** Use `php artisan serve --port=8001`

---

## 📊 Sample Data Included

- 1 Admin user
- 5 Sample students
- 3 Sample products
- Various courses and categories

---

## 🌐 All Routes

**Public:**
- `/register` - Registration
- `/login` - Login

**Protected:**
- `/dashboard` - Dashboard
- `/users` - Users Management
- `/students` - Students CRUD
- `/products` - Products CRUD
- `/profile` - User Profile

---

**That's it! You're ready to go! 🎉**
