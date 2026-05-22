# Student Record Management System

A comprehensive web application built with Laravel Framework demonstrating Authentication, CRUD Operations, Dashboard Reporting, and Profile Management.

## Features

### ✅ Authentication
- User Registration with validation
- Login/Logout with session handling
- Toast notifications for all actions

### ✅ Dashboard
- Total Users count
- Total Students count
- User's Products count
- Graduated Students count
- Interactive Charts (Chart.js):
  - Students by Course (Bar Chart)
  - Students by Year Level (Doughnut Chart)

### ✅ Users Management (CRUD)
- View all users in a table
- Add new users with validation
- Edit existing users
- Delete users
- Fields: Name, Email, Gender, Phone, Address, Created Date

### ✅ Students Module (CRUD)
- Complete student records management
- Add, Edit, Delete students
- Fields: Student ID, Name, Email, Course, Year Level, GPA, Status

### ✅ Products Module (Second CRUD - User-specific)
- Each user manages their own products
- Add, Edit, Delete products
- Fields: Name, Description, Price, Quantity, Category
- Only shows products created by logged-in user

### ✅ User Profile
- View profile information
- Edit profile with validation
- Upload profile picture
- Update password
- Fields: Name, Email, Gender, Phone, Address, Profile Picture

### ✅ UI/UX Design
- Bootstrap 5.3.3
- Responsive sidebar navigation
- Clean and modern layout
- Toast notifications for all CRUD actions
- Bootstrap Icons

## Installation Instructions

### Step 1: Database Setup

1. Open **phpMyAdmin** (http://localhost/phpmyadmin)
2. Click on **SQL** tab
3. Copy the entire content from `database_setup.sql` file
4. Paste it into the SQL query box
5. Click **Go** to execute

**OR** use MySQL command line:
```bash
mysql -u root < database_setup.sql
```

### Step 2: Configure Environment

The `.env` file is already configured for XAMPP:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=merenciano_db
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3: Create Storage Link

Open Command Prompt in the project directory and run:
```bash
php artisan storage:link
```

This creates a symbolic link for profile picture uploads.

### Step 4: Start the Application

```bash
php artisan serve
```

Visit: **http://localhost:8000**

## Default Login Credentials

After running the SQL script, you can login with:

- **Email:** admin@example.com
- **Password:** password

## Project Structure

```
Merenciano/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php       # Login & Registration
│   │   ├── StudentController.php    # Students CRUD + Dashboard
│   │   ├── UserController.php       # Users Management
│   │   ├── ProductController.php    # Products CRUD
│   │   └── ProfileController.php    # User Profile
│   └── Models/
│       ├── User.php
│       ├── Student.php
│       └── Product.php
├── database/
│   └── migrations/
│       ├── 0001_01_01_000000_create_users_table.php
│       ├── 2025_01_01_000003_create_students_table.php
│       └── 2025_01_01_000004_create_products_table.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php           # Main layout with sidebar
│   ├── auth/
│   │   ├── register.blade.php
│   │   └── login.blade.php
│   ├── dashboard.blade.php         # Dashboard with charts
│   ├── users/                      # Users Management views
│   ├── students/                   # Students CRUD views
│   ├── products/                   # Products CRUD views
│   └── profile/                    # Profile views
├── routes/
│   └── web.php                     # All routes
├── database_setup.sql              # Complete SQL script
└── .env                            # Environment configuration
```

## Routes

### Public Routes
- `GET /register` - Registration page
- `POST /register` - Register user
- `GET /login` - Login page
- `POST /login` - Authenticate user

### Protected Routes (Requires Authentication)
- `GET /dashboard` - Dashboard with charts
- `POST /logout` - Logout

**Users Management:**
- `GET /users` - List all users
- `GET /users/create` - Add user form
- `POST /users` - Store user
- `GET /users/{id}/edit` - Edit user form
- `PUT /users/{id}` - Update user
- `DELETE /users/{id}` - Delete user

**Students:**
- `GET /students` - List students
- `GET /students/create` - Add student
- `POST /students` - Store student
- `GET /students/{id}/edit` - Edit student
- `PUT /students/{id}` - Update student
- `DELETE /students/{id}` - Delete student

**Products:**
- `GET /products` - List user's products
- `GET /products/create` - Add product
- `POST /products` - Store product
- `GET /products/{id}/edit` - Edit product
- `PUT /products/{id}` - Update product
- `DELETE /products/{id}` - Delete product

**Profile:**
- `GET /profile` - View profile
- `GET /profile/edit` - Edit profile
- `PUT /profile` - Update profile

## Technologies Used

- **Framework:** Laravel 12.x
- **Frontend:** Bootstrap 5.3.3, Bootstrap Icons
- **Charts:** Chart.js 4.4.3
- **Database:** MySQL (XAMPP)
- **Session:** File-based sessions
- **Authentication:** Laravel built-in Auth

## Features Demonstrated

✅ Authentication (Login & Registration)  
✅ CRUD Operations (Users, Students, Products)  
✅ Dashboard Reporting (Charts/Graphs)  
✅ Navigation & UI Design (Bootstrap)  
✅ Session Handling  
✅ Toast Notifications  
✅ Form Validation  
✅ File Upload (Profile Pictures)  
✅ User-specific Data (Products)  
✅ Responsive Design  

## Notes

- Profile pictures are stored in `storage/app/public/profiles/`
- All CRUD operations show toast notifications
- Products are filtered by logged-in user
- Sample data is included in the SQL script
- Password for sample user is hashed using bcrypt

## Support

For issues or questions, check:
- Laravel Documentation: https://laravel.com/docs
- Bootstrap Documentation: https://getbootstrap.com/docs
- Chart.js Documentation: https://www.chartjs.org/docs

---

**Developed with Laravel Framework 12.57.0**
