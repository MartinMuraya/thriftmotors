# ThriftMotors - Premium Car Marketplace

A modern, production-ready car marketplace web application built with Laravel, Blade, Tailwind CSS, and Alpine.js.

## 🎯 Features

### Public Website
- **Homepage** with hero section, featured cars, hot deals, and recently added listings
- **Car Listings** with advanced filtering (brand, price, year, fuel type, transmission)
- **Smart Sorting** (latest, price low-to-high, price high-to-low, oldest)
- **Car Details Page** with image gallery, full specifications, and seller information
- **WhatsApp Integration** for direct seller contact with pre-filled messages
- **Phone Call Button** for immediate contact
- **Inquiry Form** to capture customer interest

### Admin Dashboard
- **Secure Authentication** with admin-only access
- **Car Management**:
  - Create, edit, delete car listings
  - Upload multiple images per listing
  - Set featured and hot deal flags
  - Activate/deactivate listings
- **Lead Management**:
  - View all customer inquiries
  - Track read/unread status
  - Direct contact options (email, phone, WhatsApp)
- **Dashboard Analytics**:
  - Total cars and active cars count
  - Inquiry statistics
  - Recent activity overview

## 🗄️ Database Schema

### Tables
- `users` - Admin users
- `brands` - Car brands
- `fuel_types` - Fuel type options
- `transmissions` - Transmission types
- `cars` - Car listings
- `car_images` - Multiple images per car
- `inquiries` - Customer inquiries/leads

## 🚀 Installation

### Prerequisites
- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- Node.js & npm (for building assets)

### Setup Steps

1. **Clone/Extract the project**
   ```bash
   cd thriftmotors
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment file**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database** in `.env`:
   ```
   DB_DATABASE=thriftmotors
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build frontend assets**
   ```bash
   npm run build
   ```

7. **Start the application**
   ```bash
   php artisan serve
   ```

8. **Access the application**
   - Frontend: http://localhost:8000
   - Admin: http://localhost:8000/admin/
   - Login: admin@thriftmotors.com / password

## 📁 Project Structure

```
thriftmotors/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── CarController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── CarController.php
│   │   │       └── InquiryController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Brand.php
│   │   ├── FuelType.php
│   │   ├── Transmission.php
│   │   ├── Car.php
│   │   ├── CarImage.php
│   │   └── Inquiry.php
│   └── Services/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php (Public layout)
│       │   └── admin.blade.php (Admin layout)
│       ├── components/
│       │   ├── car-card.blade.php
│       │   └── form components
│       ├── pages/
│       │   ├── home.blade.php
│       │   ├── listings.blade.php
│       │   └── car-detail.blade.php
│       └── admin/
│           ├── dashboard.blade.php
│           ├── cars/
│           │   ├── index.blade.php
│           │   ├── create.blade.php
│           │   ├── edit.blade.php
│           │   └── show.blade.php
│           └── inquiries/
│               ├── index.blade.php
│               └── show.blade.php
├── routes/
│   └── web.php
├── public/
│   └── images/cars/
├── composer.json
└── README.md
```

## 🔐 Security Features

- **CSRF Protection** on all forms
- **Input Validation** using Form Requests
- **Admin Middleware** for protected routes
- **Secure File Uploads** with validation
- **Password Hashing** for user authentication
- **SQL Injection Prevention** via Eloquent ORM

## 🎨 Frontend Technologies

- **Tailwind CSS** - Modern, utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript for interactivity
- **Responsive Design** - Mobile-first approach
- **Font Awesome** - Icons for UI elements

## 🛠️ Customization

### Adding New Features

1. **Create a new model**: `php artisan make:model YourModel -m`
2. **Create a controller**: `php artisan make:controller YourController`
3. **Create form requests**: `php artisan make:request YourRequest`
4. **Create views** in `resources/views/`
5. **Add routes** in `routes/web.php`

### Styling

All styling uses Tailwind CSS utility classes. Custom styles can be added in `resources/css/app.css` and compiled via `npm run build`.

## 🚀 Performance Optimization

- **Image Optimization** - Store images in `public/storage/`
- **Pagination** - 12 cars per page on listings
- **Eager Loading** - Uses Eloquent relationships to avoid N+1 queries
- **Indexing** - Database indexes on frequently queried columns
- **Caching** - Can be implemented for brand/fuel type lists

## 🌐 WhatsApp Integration

The app includes WhatsApp click-to-chat functionality:
- Pre-filled messages with car details
- Automatic phone number formatting
- Direct opening of WhatsApp Web/App

## 📱 Responsive Design

- Mobile-first CSS approach
- Optimized for all screen sizes
- Touch-friendly buttons and forms

## 🔄 Future Enhancements

- User account system for saving favorites
- Advanced analytics dashboard
- Email notifications for inquiries
- API for mobile app integration
- Payment integration for featured listings
- Review and ratings system

## 📝 License

MIT License - feel free to use this project for your own purposes.

## 🤝 Support

For issues or questions, refer to the Laravel documentation at https://laravel.com/docs

---

Built with ❤️ using Laravel, Blade, Tailwind CSS, and Alpine.js
