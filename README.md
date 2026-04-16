# RBAC Dashboard (Laravel)

A Role-Based Access Control (RBAC) dashboard built using Laravel. This project demonstrates user authentication, role management, and permission-based access control.

---

## 🚀 Features

* User Authentication (Login/Register)
* Role Management (Admin, User, etc.)
* Permission Management
* Assign Roles to Users
* Middleware-based Access Control
* Clean Dashboard UI (Tailwind CSS)

---

## 🛠 Tech Stack

* PHP (Laravel)
* MySQL
* Tailwind CSS
* Vite

---

## ⚙️ Installation

1. Clone the repository

```bash
git clone https://github.com/your-username/rbac-dashboard.git
cd rbac-dashboard
```

2. Install dependencies

```bash
composer install
npm install
```

3. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env`

5. Run migrations

```bash
php artisan migrate
```

6. Run project

```bash
php artisan serve
npm run dev
```

---

## 🔐 RBAC Flow

* Admin can create roles
* Admin can assign permissions to roles
* Users are assigned roles
* Access is controlled via middleware

---

## 📌 Future Improvements

* API support (JWT/Sanctum)
* Role hierarchy
* Activity logs
* UI improvements

---

## 👨‍💻 Author

Mohammed Naufil Shaikh
