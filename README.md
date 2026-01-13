# 🏠 RentalSite

**RentalSite** is a lightweight web application for managing rental properties, tenant groups, and rental preferences. It provides a clean interface for viewing listings, updating tenant information, and automating rent‑related calculations.  
Built with **PHP + MySQL** on the backend and **HTML/CSS** on the frontend.

---

## 🔧 Features

- **Property Listings**  
  Browse and manage available rental units.

- **Rental Groups**  
  Organize tenants into groups for shared leases.

- **Preferences Management**  
  Update rental preferences and tenant details.

- **Automated Rent Averages**  
  Calculate average rent across all listings.

- **Streamlined UI**  
  Clean, minimal interface with reusable layout components.

---

## 🛠️ Tech Stack

- **Backend:** PHP, MySQL  
- **Frontend:** HTML, CSS  
- **Database:** `rentalDB.sql` schema for properties, groups, and preferences

---

## 📁 Project Structure

| File/Folder              | Purpose |
|--------------------------|---------|
| `db_connection.php`      | Database connection configuration |
| `rentalDB.sql`           | SQL schema for rental data |
| `properties.php`         | Displays property listings |
| `rentalGroups.php`       | Manages rental groups |
| `preferencesUpdate.php`  | Updates tenant preferences |
| `rentAvg.php`            | Computes average rent |
| `images/`                | UI assets |
| `main.css`               | Global stylesheet |
| `header.html` / `footer.html` | Shared layout components |

---

## 🚀 Getting Started

### 1. Clone the repository
```bash
git clone https://github.com/HamzaIqbalG/RentalSite.git
```

### 2. Import the database
Import `rentalDB.sql` into your MySQL server.

### 3. Configure database credentials
Update the values in `db_connection.php` to match your local MySQL setup.

### 4. Run the application
Use any local PHP server (XAMPP, MAMP, or PHP’s built‑in server):

```bash
php -S localhost:8000



