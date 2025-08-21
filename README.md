# 🛠 Service Booking Management System

A simple and secure **Service Booking Management System** built with **Laravel 10** and **Sanctum API Authentication**.  
This project allows **Admins** to manage services and bookings, while **Customers** can browse services and make bookings through APIs.

## 🚀 Features

### 👨‍💼 Admin
- Manage Services (Create, Update, Delete)
- View All Bookings

### 👤 Customer
- View Available Services
- Book a Service
- View Own Bookings

### 🔑 Security
- API Authentication with **Laravel Sanctum**
- Role-based access for **Admin** and **Customer**

---

## ⚙️ Tech Stack
- **Backend**: Laravel 10  
- **Authentication**: Laravel Sanctum  
- **Database**: MySQL  
- **Frontend (Basic UI)**: Bootstrap 5  
- **API Format**: JSON

## 📦 Installation
Update your .env file with database credentials:
1. **Clone Repository**
   ```bash
   git clone https://github.com/sagor-askar/service-booking-qtec.git
   cd service-booking-qtec

2. **Install Dependencies**
   ```bash
   composer install
   npm install && npm run dev

3. **Environment Setup**
   ```bash
   cp .env.example .env

   Update your .env file with database credentials:
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=<database name>
   DB_USERNAME=root
   DB_PASSWORD=

4. **Run Migration**
   ```bash
   php artisan migrate

5. **Run the Application**
   ```bash
   php artisan serve
---
## 🔑 Authentication with Sanctum
**Login to generate a token:**
```bash
POST /api/login
Content-Type: application/json

{
  "email": "admin@gmail.com",
  "password": "123456789"
}

---

**Response**

```bash
{
  "token": "1|abcdefg123456..."
}

---

## 📡 API Endpoints
👨‍💼 Admin APIs

- POST /api/services → Create a new service
- PUT /api/services/{id} → Update service
- DELETE /api/services/{id} → Delete service
- GET /api/admin/bookings → List all bookings

👤 Customer APIs (Auth Required)

- GET /api/services → List available services
- POST /api/bookings → Book a service
- GET /api/bookings → List logged-in user's bookings

🧪 Testing with Postman

- Login with email & password
- Copy token from response
- Add to Authorization → Bearer Token in Postman
- Test Customer/Admin endpoints

