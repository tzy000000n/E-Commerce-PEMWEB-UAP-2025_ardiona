# DK Supply Co. - E-Commerce Platform

**Premium Streetwear Collection**  
*Est. by Dion & Kheiza*

## 📋 Project Overview

DK Supply Co. adalah platform e-commerce modern yang mengkhususkan diri dalam koleksi streetwear premium. Platform ini dibangun menggunakan Laravel 12 dengan fitur multi-seller, multi-language support, dan sistem manajemen yang komprehensif.

## 🚀 Key Features

### 🛍️ E-Commerce Core
- **Multi-Seller Platform**: Dua toko utama (Dion Store & Kheiza Store)
- **Product Management**: 15 produk premium across 5 kategori
- **Shopping Cart & Checkout**: Sistem keranjang belanja terintegrasi
- **Payment System**: Sistem pembayaran dengan wallet digital
- **Order Management**: Tracking pesanan dan riwayat transaksi

### 🌐 Multi-Language Support
- **Indonesian (Default)**: Bahasa utama platform
- **English**: Bahasa alternatif
- **Dynamic Language Switcher**: Flag-based language selection
- **Session-based Locale**: Preferensi bahasa tersimpan per sesi

### 👥 Role-Based Access Control
- **Admin**: Manajemen penuh sistem, verifikasi toko, manajemen user
- **Seller**: Manajemen produk, toko, dan pesanan
- **Customer**: Shopping, checkout, wallet management

### 🎨 Modern UI/UX
- **Hero Section**: Full viewport dengan video support
- **Responsive Design**: Mobile-first approach
- **Transparent Navbar**: Dynamic styling berdasarkan halaman
- **Product Cards**: Clean design dengan short descriptions
- **Admin Dashboard**: Comprehensive management interface

## 🏪 Store Structure

### **DK Supply Co. - Dion Store**
- **Owner**: Dion (dion@dksupplyco.com)
- **Specialization**: Mixed Collection (All Categories)
- **Location**: Jl. Kemang Raya No. 45, Jakarta Selatan
- **Products**: 8 items (2 Outerwear + 1 T-Shirts + 2 Bottoms + 2 Footwear + 1 Accessories)

### **DK Supply Co. - Kheiza Store**
- **Owner**: Kheiza (kheiza@dksupplyco.com)
- **Specialization**: Mixed Collection (All Categories)
- **Location**: Jl. Senopati No. 78, Jakarta Selatan
- **Products**: 7 items (1 Outerwear + 1 T-Shirts + 1 Bottoms + 2 Footwear + 2 Accessories)

## 📦 Product Categories & Inventory

### 1. **Outerwear** (3 products)
- **Dion Store**: DK Legacy Varsity Jacket (Rp 1,899,000), Midnight Rider Leather Jacket (Rp 2,499,000)
- **Kheiza Store**: Urban Ops Bomber Hoodie (Rp 1,599,000)

### 2. **T-Shirts** (2 products)
- **Dion Store**: DK Legacy Cherub Tee (Rp 599,000)
- **Kheiza Store**: Renaissance Washed Tee (Rp 599,000)

### 3. **Bottoms** (3 products)
- **Dion Store**: DK Brutalist Concrete Tech-Pants (Rp 1,299,000), Wasteland Grunge Cargo (Rp 1,199,000)
- **Kheiza Store**: DK Obsidian Panel Leather Pants (Rp 1,799,000)

### 4. **Footwear** (4 products)
- **Dion Store**: The Maroon Chunky Sneaker (Rp 1,599,000), The Tan Leather Boot (Rp 2,199,000)
- **Kheiza Store**: The Brown Cut-Out Heel (Rp 1,899,000), The Pink Chunky Sneaker (Rp 1,299,000)

### 5. **Accessories** (3 products)
- **Dion Store**: DK Owners Club Varsity Cap (Rp 399,000)
- **Kheiza Store**: DK Shadow Camo Beanie (Rp 299,000), Rebel Silver Wallet Chain (Rp 499,000)

**Total Products**: 15 items across 5 categories

## 🔧 Technical Stack

### Backend
- **Framework**: Laravel 12
- **Database**: MySQL with multi-language columns
- **Authentication**: Laravel Breeze with role-based middleware
- **Middleware**: Custom role-based access control (Admin, Seller, Customer)
- **Localization**: Complete multi-language support with session management
- **Asset Management**: Vite for modern asset compilation

### Frontend
- **Styling**: Tailwind CSS with custom components
- **JavaScript**: Vanilla JS with Alpine.js integration
- **UI Components**: Blade templates with localization support
- **Responsive**: Mobile-first design approach
- **Language Switching**: Dynamic content switching without page reload

### Database Architecture
- **Users**: Role-based user management (admin, seller, member)
- **Stores**: Multi-seller store system with verification
- **Products**: Comprehensive product management with dual-language support
- **Transactions**: Complete order and payment tracking
- **Reviews**: Product review and rating system
- **Balances**: Wallet and store balance management with withdrawal system
- **Localization**: Separate columns for Indonesian translations

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL
- XAMPP/LARAGON (recommended for Windows)

### Installation Steps

1. **Clone Repository**
```bash
git clone https://github.com/tzy000000n/E-Commerce-PEMWEB-UAP-2025_ardiona.git
cd E-Commerce-PEMWEB-UAP-2025_ardiona
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Configuration**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_commerce_uap
DB_USERNAME=root
DB_PASSWORD=
```

5. **Database Migration & Seeding**
```bash
php artisan migrate:fresh --seed
```

6. **Install Frontend Dependencies**
```bash
npm install
```

7. **Asset Compilation**
```bash
npm run dev
# or for production
npm run build
```

8. **Start Development Server**
```bash
php artisan serve
```

**Access the application**: `http://127.0.0.1:8000`

## 👤 Default Login Credentials

### Admin Account
- **Email**: admin@dksupplyco.com
- **Password**: password
- **Access**: Full system management

### Seller Accounts
- **Dion**: dion@dksupplyco.com / password
- **Kheiza**: kheiza@dksupplyco.com / password
- **Access**: Store and product management

### Customer Account
- **Email**: customer@dksupplyco.com
- **Password**: password
- **Access**: Shopping and wallet features

## 🌟 Key Features Detail

### Complete Multi-Language Implementation
- **Real-time Language Switching**: Content changes instantly without page reload
- **Database-Level Localization**: Separate columns for Indonesian translations
- **Comprehensive Coverage**: All UI elements, product descriptions, and user interactions
- **Session Persistence**: Language preference maintained across browsing session
- **Flag-based Switcher**: Intuitive country flag interface for language selection

### Multi-Language System
- **Default Language**: Indonesian (id)
- **Alternative**: English (en)
- **Implementation**: Session-based locale switching with fully localized content
- **Product Descriptions**: Dynamic language switching for all product content (short & long descriptions)
- **UI Elements**: Flag-based language switcher in navbar with country flags
- **Login Button**: Localized "Login untuk Membeli" (Indonesian) / "Login to Purchase" (English)
- **Complete Localization**: All buttons, labels, and content adapt to selected language

### Hero Section
- **Video Support**: MP4 autoplay with fallback to image
- **Overlay Text**: "DK" branding with "SUPPLY CO." tagline
- **Responsive**: Full viewport height (100vh)
- **Visibility**: White text with shadows for video compatibility

### Navigation System
- **Dynamic Styling**: Transparent on home, white on other pages
- **Search Integration**: Expandable search bar
- **Language Switcher**: Indonesia & English flags
- **Scroll Effect**: Changes to solid white at 50px scroll

### Product Management
- **Image Handling**: Local asset paths with `asset()` helper
- **Dual Language Support**: Complete English & Indonesian descriptions
- **Dynamic Localization**: Real-time description switching based on session language
- **Database Structure**: Separate columns for each language (description_id, short_description_id)
- **Stock Display**: Plain text format (no emojis or backgrounds)
- **Categories**: 5 main categories distributed across both stores
- **Store Distribution**: Each store has products in all 5 categories for balanced inventory

## 📱 Responsive Design

### Mobile-First Approach
- **Breakpoints**: Tailwind CSS responsive utilities
- **Navigation**: Collapsible mobile menu
- **Product Grid**: Adaptive columns (1-2-3-4)
- **Forms**: Single-column layout for mobile

### Desktop Enhancements
- **Hero Video**: Full-screen video background
- **Product Grid**: Multi-column layout
- **Admin Interface**: Comprehensive dashboard
- **Search**: Expanded search functionality

## 🔒 Security Features

### Authentication & Authorization
- **Role-Based Access**: Admin, Seller, Customer roles
- **Middleware Protection**: Route-level access control
- **Email Verification**: Account verification system
- **Password Security**: Bcrypt hashing

### Data Protection
- **CSRF Protection**: Laravel built-in CSRF tokens
- **SQL Injection Prevention**: Eloquent ORM
- **XSS Protection**: Blade template escaping
- **Input Validation**: Form request validation

## 📊 Database Schema

### Core Tables
- **users**: User management with roles
- **stores**: Multi-seller store information
- **product_categories**: 5 main categories
- **products**: 15 premium products
- **product_images**: Image management
- **transactions**: Order tracking
- **transaction_details**: Order line items
- **user_balances**: Wallet system
- **store_balances**: Seller earnings

## 🚀 Recent Updates (December 2025)

### ✅ Completed Features
- **Complete Multi-Language Support**: Full Indonesian and English localization
- **Dynamic Product Descriptions**: Real-time language switching for all content
- **Balanced Product Distribution**: 15 products evenly distributed across both stores
- **Enhanced User Experience**: Localized buttons and interface elements
- **Database Optimization**: Dual-language column structure
- **Asset Pipeline**: Modern Vite build system implementation

### 🎯 Future Enhancements

#### Planned Features
- **Payment Gateway Integration**: Multiple payment methods (Midtrans, DANA, OVO)
- **Advanced Search**: Filters and sorting options with autocomplete
- **Wishlist System**: Save favorite products with user accounts
- **Enhanced Review System**: Photo reviews and verified purchase badges
- **Inventory Alerts**: Real-time low stock notifications
- **Analytics Dashboard**: Comprehensive sales and performance metrics

#### Technical Improvements
- **API Development**: RESTful API for mobile app integration
- **Caching System**: Redis implementation for improved performance
- **Image Optimization**: Automatic image compression and WebP conversion
- **SEO Optimization**: Meta tags, structured data, and sitemap generation
- **Progressive Web App**: PWA features for mobile experience

## 👨‍💻 Development Team

### Founders & Developers
- **Dion**: Co-founder, Full-stack Developer
- **Kheiza**: Co-founder, Frontend Specialist

### Contact Information
- **GitHub**: [tzy000000n](https://github.com/tzy000000n)
- **Email**: ardionamaulana@gmail.com
- **Project Repository**: [E-Commerce-PEMWEB-UAP-2025_ardiona](https://github.com/tzy000000n/E-Commerce-PEMWEB-UAP-2025_ardiona)

## 📄 License

This project is developed for educational purposes as part of Web Programming Final Project (UAP) 2025.

---

**DK Supply Co.** - *Premium Streetwear Collection*  
*Est. by Dion & Kheiza*