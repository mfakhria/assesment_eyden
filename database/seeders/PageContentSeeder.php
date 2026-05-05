<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            ['brand_name', 'text', 'Travel'],
            ['nav_home', 'text', 'Home'],
            ['nav_tours', 'text', 'Our Tours'],
            ['nav_reviews', 'text', 'Reviews'],
            ['nav_contact', 'text', 'Contact Us'],
            ['eyebrow', 'text', 'The vacation you deserve is closer than you think 😍'],
            ['hero_title', 'text', 'Life is short and the world is Wide! 🌴'],
            ['location', 'text', 'Manali, India'],
            ['date', 'text', '26 Oct 2022'],
            ['return_date', 'text', '12 Nov 2022'],
            ['values_label', 'text', 'What We Serve'],
            ['values_title', 'text', 'Top Values For You 🔥'],
            ['values_text', 'text', 'Try a variety of benefits when using our services.'],
            ['choice_title', 'text', 'Lot Of Choices'],
            ['choice_text', 'text', 'Total 460+ destinations that we work with.'],
            ['guide_title', 'text', 'Best Tour Guide'],
            ['guide_text', 'text', 'Our tour guide with 15+ years of experience.'],
            ['booking_title', 'text', 'Easy Booking'],
            ['booking_text', 'text', 'With an easy and fast ticket purchase process.'],
            ['main_image', 'image', '/assets/images/gunung-optimized.webp'],
            ['side_image', 'image', '/assets/images/pantai-optimized.webp'],
            ['camera_icon', 'image', 'https://api.iconify.design/noto/camera.svg'],
            ['plane_icon', 'image', 'https://api.iconify.design/noto/airplane.svg'],
        ];

        foreach ($contents as [$key, $type, $value]) {
            PageContent::updateOrCreate(
                ['content_key' => $key],
                ['content_type' => $type, 'content_value' => $value],
            );
        }
    }
}
