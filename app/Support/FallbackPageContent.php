<?php

namespace App\Support;

class FallbackPageContent
{
    public static function all(): array
    {
        return [
            'brand_name' => 'Travel',
            'nav_home' => 'Home',
            'nav_tours' => 'Our Tours',
            'nav_reviews' => 'Reviews',
            'nav_contact' => 'Contact Us',
            'eyebrow' => 'Connect the database first to load CMS content.',
            'hero_title' => 'Database connection required',
            'location' => 'No database connection',
            'date' => 'Not loaded',
            'return_date' => 'Not loaded',
            'values_label' => 'CMS Offline',
            'values_title' => 'Content is not loaded yet',
            'values_text' => 'Start MySQL and run migrations to show editable landing content.',
            'choice_title' => 'Database Required',
            'choice_text' => 'The page is visible, but CMS data cannot be read yet.',
            'guide_title' => 'Start MySQL',
            'guide_text' => 'Run docker compose up -d, then php artisan migrate --seed.',
            'booking_title' => 'Refresh Page',
            'booking_text' => 'After the database is connected, refresh this page.',
            'main_image' => '/assets/images/gunung-optimized.webp',
            'side_image' => '/assets/images/pantai-optimized.webp',
            'camera_icon' => 'https://api.iconify.design/noto/camera.svg',
            'plane_icon' => 'https://api.iconify.design/noto/airplane.svg',
        ];
    }
}
