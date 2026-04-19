# Laravel Academic Management System

A complete Academic Management System built with Laravel, designed to manage classes, subjects, and users with role-based access control. This system helps streamline academic operations efficiently with a clean and user-friendly interface.

---

## 🚀 Features

* Class Management
* Subject Management
* Assign Subjects to Classes
* Prevent Duplicate Subject Assignments
* Role-Based Authentication (Admin, Teacher, Student)
* Secure Login System
* Form Validation with Proper Error Handling
* Clean and Responsive UI (Bootstrap)

---

## 🛠️ Tech Stack

* **Backend:** Laravel (PHP)
* **Frontend:** HTML, CSS, Bootstrap
* **Database:** MySQL
* **Tools:** VS Code, Git, GitHub

---

## ⚙️ Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/SufyanTalib01/academic-management-system-laravel.git
```

### 2. Navigate to Project Folder

```bash
cd academic-management-system-laravel
```

### 3. Install Dependencies

```bash
composer install
npm install && npm run dev
```

### 4. Setup Environment File

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Database

Open `.env` file and update:

```env
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Start Development Server

```bash
php artisan serve
```

Now open your browser and visit:

```
http://127.0.0.1:8000
```

---

## 📌 Key Highlights

* Prevents assigning duplicate subjects to the same class
* Implements role-based access control
* Clean architecture and maintainable code structure
* Beginner-friendly Laravel project

---

## 👨‍💻 Author

**Muhammad Sufyan**

GitHub: https://github.com/SufyanTalib01

---

## 📄 License

This project is open-source and available for learning purposes.
