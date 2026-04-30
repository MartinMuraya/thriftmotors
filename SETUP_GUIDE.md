# ThriftMotors - Setup & Configuration Guide

## Quick Start

### 1. Initial Setup

```bash
# Navigate to project directory
cd thriftmotors

# Copy environment file
copy .env.example .env

# Generate app key
php artisan key:generate
```

### 2. Database Configuration

Edit `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=thriftmotors
DB_USERNAME=root
DB_PASSWORD=
```

Create database:
```bash
# MySQL
mysql -u root -p
CREATE DATABASE thriftmotors;
```

### 3. Install Dependencies

```bash
# PHP dependencies
composer install

# Node dependencies
npm install
```

### 4. Database Migrations & Seeders

```bash
# Run migrations
php artisan migrate

# Seed sample data
php artisan db:seed
```

### 5. Build Frontend Assets

```bash
# Development build (with Vite)
npm run dev

# Production build
npm run build
```

### 6. Start the Server

```bash
# Using Laravel's built-in server
php artisan serve

# Default URL: http://localhost:8000
```

---

## Admin Login Credentials

After running the seeder:

- **Email**: admin@thriftmotors.com
- **Password**: password

Admin Dashboard: `http://localhost:8000/admin/`

---

## Directory Structure & Key Files

### Models (`app/Models/`)
- `User.php` - Admin users
- `Brand.php` - Car brands
- `FuelType.php` - Fuel types
- `Transmission.php` - Transmission types
- `Car.php` - Main car listing model
- `CarImage.php` - Car images
- `Inquiry.php` - Customer inquiries

### Controllers (`app/Http/Controllers/`)
- `HomeController.php` - Homepage
- `CarController.php` - Public car pages
- `Admin/DashboardController.php` - Admin dashboard
- `Admin/CarController.php` - Admin car management
- `Admin/InquiryController.php` - Manage inquiries

### Views (`resources/views/`)
- `layouts/app.blade.php` - Public layout
- `layouts/admin.blade.php` - Admin layout
- `pages/` - Public pages (home, listings, details)
- `admin/` - Admin pages

### Routes (`routes/web.php`)
- Public routes (no authentication required)
- Admin routes (require authentication & admin status)

---

## Common Commands

```bash
# Clear cache
php artisan cache:clear

# Clear config cache
php artisan config:cache

# View available routes
php artisan route:list

# Create a new model
php artisan make:model YourModel -m

# Create a new controller
php artisan make:controller YourController -r

# Create a new form request
php artisan make:request YourRequest

# Generate fresh database
php artisan migrate:fresh --seed
```

---

## Customization

### Adding a New Car Brand

1. Go to Admin Dashboard
2. Navigate to "Manage Cars"
3. When creating/editing, select from existing brands
4. To add new brands, use the seeder or add manually via database

### Styling

All styling uses Tailwind CSS. Modify:
- `tailwind.config.js` - Tailwind configuration
- `resources/css/app.css` - Custom CSS styles

### Modifying the Homepage

Edit: `resources/views/pages/home.blade.php`

### Changing Contact Methods

Edit contact links in:
- `resources/views/pages/car-detail.blade.php`
- Car models in `CarController`

---

## File Uploads

Car images are stored in `public/storage/cars/`. 

To make storage public (if not already):
```bash
php artisan storage:link
```

---

## Environment Variables

Important `.env` settings:

```env
# Application
APP_NAME="ThriftMotors"
APP_URL=http://localhost:8000
APP_DEBUG=true (set to false in production)

# Database
DB_DATABASE=thriftmotors
DB_USERNAME=root

# Mail (for inquiries)
MAIL_MAILER=log (use log for development)
```

---

## Security Checklist

Before deploying to production:

- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Generate new `APP_KEY`
- [ ] Configure proper database credentials
- [ ] Set up HTTPS
- [ ] Configure mail service for notifications
- [ ] Set up proper file permissions
- [ ] Enable CSRF protection (already enabled)
- [ ] Use strong admin password
- [ ] Backup database regularly

---

## Troubleshooting

### 500 Error
- Check storage permissions: `chmod -R 775 storage/ bootstrap/`
- Clear cache: `php artisan cache:clear`
- Check `.env` configuration

### Database Connection Failed
- Verify MySQL is running
- Check `.env` database credentials
- Ensure database exists

### Images Not Showing
- Run: `php artisan storage:link`
- Check image file permissions

### Assets Not Loading
- Run: `npm run dev` (for development)
- Run: `npm run build` (for production)
- Clear browser cache

---

## Performance Tips

1. **Caching**: Implement caching for brands and fuel types
   ```php
   $brands = Cache::remember('brands', 60*24, function() {
       return Brand::all();
   });
   ```

2. **Database Indexing**: Already configured in migrations

3. **Image Optimization**: Consider using image optimization package

4. **Pagination**: Already implemented on listings (12 per page)

5. **Lazy Loading**: Images in listings can be lazy-loaded

---

## API Integration (Future)

The application structure is designed to easily add an API:

```bash
# Generate API routes
php artisan make:controller Api/CarController --api

# Use same models and requests
```

---

## Support & Documentation

- Laravel Documentation: https://laravel.com/docs
- Tailwind CSS: https://tailwindcss.com/docs
- Alpine.js: https://alpinejs.dev/
- Blade Templating: https://laravel.com/docs/blade

---

## License

MIT License

---

Built with Laravel, Blade, Tailwind CSS, and Alpine.js
