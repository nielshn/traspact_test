# 🧩 Employee Management System — PT. TRASPAC MAKMUR SEJAHTERA

A modern and interactive **Employee Management System** built with **Laravel 11**, **Livewire 3**, and **TailwindCSS**, designed for managing employee data with features like dynamic filtering, hierarchical unit structure (tree), responsive table grid, file upload, PDF printing, and dark mode support.

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-3-purple?style=flat-square)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.4-blue?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-%5E8.2-blueviolet?style=flat-square)
![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)

---

## 🚀 Project Overview

This system was built as a part of an academic project to meet several key software engineering and UI/UX requirements:

✅ **CRUD operations** for employee management
✅ **Tree component** for hierarchical unit structure (Unit Kerja)
✅ **Data table** with pagination, search, and filters
✅ **Combo box**, **radio buttons**, and **file upload**
✅ **Dark/light mode support** using Laravel Breeze layout
✅ **PDF export/print feature** with company logo
✅ **SweetAlert confirmation dialogs**
✅ **Responsive layout** with Tailwind grid & flex utilities

---

## 🏗️ Tech Stack

| Layer                | Technology                       |
| -------------------- | -------------------------------- |
| **Backend**          | Laravel 11                       |
| **Frontend**         | Livewire 3 + TailwindCSS         |
| **UI Theme**         | Laravel Breeze (Dark/Light Mode) |
| **PDF Export**       | DOMPDF / Barryvdh Laravel-Dompdf |
| **Icons**            | Heroicons (Blade Components)     |
| **JS Interactivity** | Alpine.js + SweetAlert2          |
| **Database**         | MySQL / MariaDB                  |

---

## 📂 Project Structure

```
app/
 ├── Http/Livewire/Employees/        # Livewire components for employee CRUD & filtering
 ├── Models/                         # Eloquent models (Employee, Unit, Position, Rank, etc.)
 └── Http/Controllers/               # (Optional) if hybrid approach with controller routes

resources/
 ├── views/
 │   ├── employees/                  # Blade templates for employee pages
 │   │   ├── index.blade.php         # Employee list with tree + table
 │   │   ├── create.blade.php        # Employee create form
 │   │   ├── edit.blade.php          # Employee edit form
 │   │   └── partials/
 │   │       └── unit-tree.blade.php # Recursive partial for hierarchical units
 │   └── pdf/
 │       └── employees.blade.php     # PDF layout for employee print
 └── components/                     # Reusable Blade components

public/
 ├── logotraspac.png                 # Company logo for header & PDF
 └── images/no-photo.png             # Default employee photo placeholder
```

---

## ⚙️ Installation Guide

Follow these steps to run the project locally:

### 1⃣ Clone the Repository

```bash
git clone https://github.com/yourusername/employee-management-system.git
cd employee-management-system
```

### 2⃣ Install Dependencies

```bash
composer install
npm install && npm run build
```

### 3⃣ Copy Environment File

```bash
cp .env.example .env
```

### 4⃣ Configure Database

Edit your `.env` file:

```env
DB_DATABASE=employee_db
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bash
php artisan migrate --seed
```

_(Includes seeders for unit, position, and rank data)_

### 5⃣ Run the Application

```bash
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000)

---

## 🧠 Key Features

### 🌳 Hierarchical Tree (Unit Kerja)

- Interactive tree/slider showing the organization’s structure.
- Expand/collapse child units dynamically (Alpine.js).
- Fully scrollable horizontal tree layout (responsive).

### 📋 Employee Data Table

- Paginated and searchable list of employees.
- Filtering by name, NIP, unit, and other attributes.
- Integrated with Livewire for real-time updates.

### 🧻 PDF Printing

- Printable PDF with company logo, formatted headers, and employee details.
- Supports long tables and multi-page export.

### 🧑‍💼 CRUD Operations

- Create, edit, and delete employee records with Livewire modal forms.
- File upload (photo) with preview and fallback image.

### 🌙 Dark Mode Support

- Seamlessly switch between light/dark themes using Laravel Breeze.

### ⚠️ SweetAlert Integration

- Confirmation dialog for delete actions.
- Flash messages for success/error alerts with Alpine transitions.

---

## 🧐 System Requirements

| Component | Version |
| --------- | ------- |
| PHP       | >= 8.2  |
| Composer  | >= 2.5  |
| Node.js   | >= 18   |
| MySQL     | >= 5.7  |
| Laravel   | 11.x    |
| Livewire  | 3.x     |

---

## 🧠 Developer Notes

This project implements:

- **Repository-Service pattern** (for clean business logic separation)
- **Livewire-only approach** for most CRUD features (no page reloads)
- **Component-based Blade structure** for modular development

The application layout and component styling follow **Tailwind utility-first design**, ensuring consistency and reusability.

---

## 🖼️ Preview

| Dashboard                                                                               | Tree Structure                                                                            | PDF Export                                                              |
| --------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------- | ----------------------------------------------------------------------- |
| ![Dashboard Screenshot](https://via.placeholder.com/300x180.png?text=Dashboard+Preview) | ![Tree Structure Screenshot](https://via.placeholder.com/300x180.png?text=Tree+Structure) | ![PDF Preview](https://via.placeholder.com/300x180.png?text=PDF+Output) |

---

## 👨‍💻 Author

**Daniel Siahaan**
Machine Learning & Web Developer

- 💼 [LinkedIn](https://www.linkedin.com/in/nielshn)
- 💻 [GitHub](https://github.com/nielshn)
- ✉️ [dsiahaan581@gmail.com](mailto:dsiahaan581@gmail.com)
- 📱 +62 856 6830 5160

---

## 📜 License

This project is open-source and available under the [MIT License](LICENSE).

---

## ⭐ Contributing

Pull requests are welcome!
For major changes, please open an issue first to discuss what you would
