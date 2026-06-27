# ItzRenzo Dev Website - AI Coding Agent Instructions

## Project Overview
This is a **Laravel 12** application (PHP 8.2+) configured for Windows/XAMPP development. It's a **Minecraft developer portfolio website** showcasing server setups, configurations, and development skills using **Tailwind CSS v4** with Vite for asset compilation.

## Architecture & Stack
- **Framework**: Laravel 12 with modern streamlined configuration (`bootstrap/app.php`)
- **Frontend**: Tailwind CSS v4 (via `@tailwindcss/vite` plugin), Vite 6, no JavaScript framework
- **Database**: SQLite by default (`config/database.php` line 20) - stores projects and portfolio data
- **PHP Server**: XAMPP on Windows (PowerShell environment)
- **Testing**: PHPUnit 11.5
- **Dev Tools**: Laravel Pail (logs), Laravel Pint (code style), Laravel Sail (Docker alternative)

## Portfolio Structure
### Database Models
- **Project Model** (`app/Models/Project.php`): Stores Minecraft server setups
  - Fields: title, slug, description, category, image_url, external_url, tags (JSON), featured, display_order, emoji
  - Scope: `featured()` for filtering featured projects
  - Factory: `ProjectFactory` generates sample data

### Routes & Controllers
- **HomeController** (`app/Http/Controllers/HomeController.php`): Main portfolio page
  - Fetches featured projects
  - Passes statistics to view

### Views
- **Layout**: `resources/views/layouts/app.blade.php` - Main layout with navigation, footer, social links
- **Home**: `resources/views/home.blade.php` - Portfolio sections:
  1. Hero section with animated introduction
  2. Featured projects grid with hover effects
  3. Skills & certifications (Frontend, Backend, Tools, Certifications)
  4. Contact section with social links

## Critical Development Workflows

### Starting Development Server
Use the **custom Composer script** for full development environment:
```bash
composer dev
```
This concurrently runs: PHP dev server, queue worker, Pail logs viewer, and Vite HMR on ports 8000 (server), Vite default.

**Individual commands** (Windows PowerShell):
```powershell
php artisan serve          # Dev server at http://127.0.0.1:8000
npm run dev               # Vite HMR for assets
php artisan queue:listen  # Queue worker
php artisan pail          # Real-time log viewer
```

### Asset Compilation
- **Development**: `npm run dev` (Vite HMR with hot reload)
- **Production**: `npm run build` (minified assets to `public/build/`)
- **Config**: `vite.config.js` - builds `resources/css/app.css` and `resources/js/app.js`

### Database Management
```bash
php artisan migrate:fresh --seed  # Reset database and seed with sample projects
php artisan db:seed               # Seed projects only
```

### Testing
```bash
composer test              # Runs config:clear + artisan test
php artisan test          # Direct PHPUnit execution
php artisan test --filter ExampleTest  # Specific test
```

### Code Quality
```bash
./vendor/bin/pint         # Laravel Pint code formatter (auto-fix)
./vendor/bin/pint --test  # Check style without changes
```

## Project-Specific Conventions

### Tailwind CSS v4 Patterns
- **Configuration**: In `resources/css/app.css` using `@theme` directive (not `tailwind.config.js`)
- **Custom theme**: Font family set to 'Instrument Sans' (line 9-10 of `app.css`)
- **Content sources**: Defined via `@source` directives in CSS (vendor pagination, storage views, blade templates)
- **Usage**: Utility-first approach with extensive inline classes
- **Dark theme**: Default dark background (#0a0a0a) with emerald/cyan gradient accents
- **Animations**: Custom fade-in animations defined in CSS, smooth scrolling enabled

### Blade Templates
- **Component syntax**: Uses `<x-layouts.app>` component syntax with `$slot` insertion
- **Dark mode**: Default dark theme (no light mode toggle currently)
- **Vite directive**: `@vite(['resources/css/app.css', 'resources/js/app.js'])` loads assets
- **Gradient text**: Uses `bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent`

### Portfolio Content Patterns
- **Project Cards**: Display emoji, title, description, category badge, tags, and external link
- **Featured Projects**: Use `Project::featured()->get()` scope
- **Emojis**: Each project has an emoji icon (🌱, ⚔️, 🏰, 🛏️, 🔪, 🧭, ⌚, 🎮)
- **Social Links**: Discord, YouTube, GitHub, BuiltByBit integrated in footer and contact section

### Routing & Structure
- **Web routes**: Defined in `routes/web.php` (HomeController@index as root)
- **API routes**: Not configured (streamlined Laravel 12 approach)
- **Controllers**: Extend `App\Http\Controllers\Controller` base class
- **Models**: Use `App\Models` namespace (PSR-4 autoload)

### Database
- **Default**: SQLite at `database/database.sqlite`
- **Migrations**: Projects table in `database/migrations/2025_11_09_161510_create_projects_table.php`
- **Seeders**: `DatabaseSeeder.php` creates 6 featured + 6 additional projects
- **Factories**: `ProjectFactory.php` for testing data

### Configuration
- **Streamlined approach**: Laravel 12 uses `bootstrap/app.php` for routing/middleware/exceptions
- **Service providers**: Only `AppServiceProvider` by default (empty implementation)
- **Environment**: Managed via `.env` (copy from `.env.example` for new setup)

## Key Files & Their Purpose
- `bootstrap/app.php` - Application bootstrapping (replaces old `app/Http/Kernel.php`)
- `routes/web.php` - Web route definitions (HomeController)
- `resources/views/home.blade.php` - Main portfolio page
- `resources/views/layouts/app.blade.php` - Layout with navigation and footer
- `resources/css/app.css` - Tailwind v4 configuration, custom animations, global styles
- `app/Models/Project.php` - Project model with featured scope
- `database/seeders/DatabaseSeeder.php` - Sample Minecraft projects
- `composer.json` scripts - Custom `dev` and `test` commands
- `vite.config.js` - Asset bundling with Laravel plugin + Tailwind plugin

## Windows/XAMPP Specifics
- **PHP Binary**: Accessible via `php` command (ensure XAMPP PHP in PATH)
- **Artisan**: Execute with `php artisan` prefix on Windows
- **NPM**: Use `npm` (not `pnpm` or `yarn`) per `package.json`
- **Shell**: PowerShell commands use `;` for command chaining

## Common Patterns to Follow
1. **Controllers**: Place in `app/Http/Controllers/`, extend `Controller` base class
2. **Models**: Place in `app/Models/`, extend `Illuminate\Database\Eloquent\Model`
3. **Views**: Blade templates in `resources/views/` with `.blade.php` extension
4. **Layouts**: Use component syntax `<x-layouts.app>` with `$slot` for content
5. **Assets**: JavaScript in `resources/js/`, CSS in `resources/css/`
6. **Migrations**: Use `php artisan make:migration` - timestamps follow `0001_01_01_000000_` pattern
7. **Tests**: Feature tests in `tests/Feature/`, Unit tests in `tests/Unit/`
8. **Project Data**: Add new projects via seeder or factory, include emoji, category, tags

## Quick Reference
- **Laravel Version**: 12.x (latest major release)
- **PHP Requirement**: ^8.2
- **Package Manager**: Composer for PHP, npm for JavaScript
- **Ports**: 8000 (PHP server), 5173 (Vite HMR)
- **Database File**: `database/database.sqlite` (create if missing)
- **Color Scheme**: Dark (#0a0a0a background) with emerald-cyan gradients
- **Font**: Instrument Sans from Bunny Fonts
