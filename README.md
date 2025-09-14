# Laravel Filament Project

This is a Laravel 12 project using **Filament** for managing products, product types, categories, and colors. It also integrates with the **Asmorphic API** to fetch external data.  

---

## Features

- **CRUD** for:
  - Products
  - Product Types (with API unique number fetching)
  - Product Categories
  - Product Colors
  - Type Assignments (pivot table)
- **Relationships**
  - Product belongs to a category and a color
  - Product has many types through `morphToMany`
- **Custom Fields**
  - Status bar in Product form (Hello message, background color from ProductColor)
- **Filament Dashboard**
  - Custom widget to display counts of products, types, and categories
- **External API Integration**
  - Uses `AsmorphicClient` service for authentication and API calls (`findAddress`)

---

## Requirements

- PHP 8.2+
- Laravel 12
- Filament V3
- MySQL (for local development)
- Composer
- Node.js & NPM (for assets)

---

## Installation

1. **Clone the repository**

```bash
git clone https://github.com/Kusalmarsh95/webco-app.git
