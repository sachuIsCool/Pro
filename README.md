# Laravel + Google Maps Places API: Restaurants by City

Simple Laravel-style app structure that fetches and displays 10 restaurants for a user-entered city using the Google Maps Places API.

## Features
- City input form (Blade)
- Server-side API call to Google Places Text Search
- Displays restaurant Name, Address, Rating
- Minimal UI, clean code

## Tech
- Laravel 11 (PHP 8.2+)
- Blade templates
- Guzzle (HTTP client)
- Google Maps Places API

## Setup (Full Laravel project)
1. Create a Laravel app (if you haven't):
   ```bash
   composer create-project laravel/laravel restaurants-by-city
   cd restaurants-by-city
   composer require guzzlehttp/guzzle
   ```
2. Copy the files from this folder into the corresponding paths in your Laravel app.
3. Add your Google API key to `.env`:
   ```
   GOOGLE_MAPS_API_KEY=your_google_api_key_here
   ```
4. Ensure `config/services.php` has the `google.maps_api_key` mapping as shown below.
5. Run the app:
   ```bash
   php artisan serve
   ```

## Google API
- Enable: Places API (and Maps JavaScript API if you later add maps)
- Get API key: Google Cloud Console
- Restrict key to your app/domain if deploying

## Deploy (bonus)
- Render: PHP/Laravel native build
- Set `APP_KEY` and `GOOGLE_MAPS_API_KEY` in host environment

## Files Included Here
- `routes/web.php`
- `app/Http/Controllers/RestaurantController.php`
- `app/Services/GooglePlacesService.php`
- `resources/views/restaurants/index.blade.php`
- `config/services.php` (google section)
- `.env.example`


