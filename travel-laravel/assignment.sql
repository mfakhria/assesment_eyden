CREATE DATABASE IF NOT EXISTS travel_assignment CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE travel_assignment;

CREATE TABLE page_contents (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  content_key VARCHAR(255) NOT NULL UNIQUE,
  content_type ENUM('text','image') NOT NULL DEFAULT 'text',
  content_value TEXT NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL
);

INSERT INTO page_contents (content_key, content_type, content_value, created_at, updated_at) VALUES
('brand_name','text','Travel',NOW(),NOW()),
('nav_home','text','Home',NOW(),NOW()),
('nav_tours','text','Our Tours',NOW(),NOW()),
('nav_reviews','text','Reviews',NOW(),NOW()),
('nav_contact','text','Contact Us',NOW(),NOW()),
('eyebrow','text','The vacation you deserve is closer than you think 😍',NOW(),NOW()),
('hero_title','text','Life is short and the world is Wide! 🌴',NOW(),NOW()),
('location','text','Manali, India',NOW(),NOW()),
('date','text','26 Oct 2022',NOW(),NOW()),
('return_date','text','12 Nov 2022',NOW(),NOW()),
('values_label','text','What We Serve',NOW(),NOW()),
('values_title','text','Top Values For You 🔥',NOW(),NOW()),
('values_text','text','Try a variety of benefits when using our services.',NOW(),NOW()),
('choice_title','text','Lot Of Choices',NOW(),NOW()),
('choice_text','text','Total 460+ destinations that we work with.',NOW(),NOW()),
('guide_title','text','Best Tour Guide',NOW(),NOW()),
('guide_text','text','Our tour guide with 15+ years of experience.',NOW(),NOW()),
('booking_title','text','Easy Booking',NOW(),NOW()),
('booking_text','text','With an easy and fast ticket purchase process.',NOW(),NOW()),
('main_image','image','/assets/images/gunung-optimized.webp',NOW(),NOW()),
('side_image','image','/assets/images/pantai-optimized.webp',NOW(),NOW()),
('camera_icon','image','https://api.iconify.design/noto/camera.svg',NOW(),NOW()),
('plane_icon','image','https://api.iconify.design/noto/airplane.svg',NOW(),NOW())
ON DUPLICATE KEY UPDATE content_value = VALUES(content_value), content_type = VALUES(content_type), updated_at = NOW();
