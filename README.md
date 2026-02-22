# 🚚 FleetFlow – Modular Fleet & Logistics Management System

FleetFlow is a **web-based ERP-style Fleet & Logistics Management System** designed to manage vehicles, drivers, trips, maintenance, expenses, and analytics from a single unified platform.

The project focuses on **real-world fleet operations**, **status-based automation**, and **data-driven decision making**, making it suitable for **hackathons, academic projects, and ERP demonstrations**.

---

## 📌 Key Features

### 🔐 Authentication & User Roles
- Secure login and registration system
- Role-based users:
  - Fleet Manager
  - Dispatcher
  - Safety Officer
  - Finance Analyst
- Session-based authentication

---

### 🚗 Vehicle Management
- Add and manage vehicles
- Vehicle registry with live status
- Vehicle status control:
  - `Available`
  - `Not Available`
  - `On Trip` (locked)
  - `Retired` (locked)
- Vehicles on active trips cannot be disabled

---

### 👨‍✈️ Driver Management & Safety
- Add drivers with license details
- License expiry tracking
- Automatic suspension of drivers with expired licenses
- Driver safety score calculation
- Suspended drivers cannot be assigned to trips

---

### 🚚 Trip Dispatch & Management
- Assign available vehicles and eligible drivers
- Trip lifecycle:
  - Dispatched
  - Completed
  - Cancelled
- Automatic vehicle & driver status updates
- Success popup after trip dispatch

---

### 🛠 Maintenance & Service Logs
- Log vehicle maintenance and service history
- Track service date and cost
- Maintenance records linked to vehicles

---

### 💸 Expense & Fuel Logging
- Record trip expenses
- Fuel and miscellaneous cost tracking
- Driver-wise expense entries

---

### 📊 Analytics & Reports
- Fleet utilization rate
- Total fuel & maintenance cost
- Estimated revenue and ROI
- Monthly financial summary
- KPI-based operational dashboard

---

## 🛠 Technology Stack

| Layer | Technology |
|------|------------|
| Frontend | HTML, CSS |
| Backend | PHP (Core PHP) |
| Database | MySQL |
| Server | Apache (XAMPP) |
| Styling | Custom Dark ERP UI |

---

## 📂 Project Structure


---

## ⚙️ Installation & Setup

### 1️⃣ Prerequisites
- XAMPP (Apache + MySQL)
- PHP 7.4 or higher
- Web Browser (Chrome recommended)

---

### 2️⃣ Setup Steps

1. Copy the project folder to:

2. Start **Apache** and **MySQL** from XAMPP Control Panel

3. Open phpMyAdmin:

4. Create a database named:

5. Configure database connection in:

---

### 3️⃣ Run the Project

- Login Page:

- Dashboard (after login):

---

## 🧪 Testing Checklist

- Login & Registration
- Vehicle creation and status toggle
- Driver creation and suspension logic
- Trip dispatch with popup confirmation
- Maintenance logging
- Expense tracking
- Analytics dashboard validation

---

## 🧠 Business Logic Highlights

- Vehicles on active trips cannot be disabled
- Suspended drivers are blocked from trip assignment
- License expiry triggers automatic suspension
- Status-based filtering ensures operational safety

---

> **FleetFlow is an ERP-style fleet management platform that automates vehicle availability, driver compliance, trip dispatching, and operational analytics in real time.**

---

## 🚀 Future Enhancements
- AJAX-based actions (no page reload)
- Role-based dashboards
- Email/SMS alerts
- GPS & live vehicle tracking
- Report export (PDF / Excel)

---

## 👨‍💻 Author

**FleetFlow Project**  
Developed for hackathon and academic demonstration purposes.
