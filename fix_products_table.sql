-- Quick Fix: Create Products Table
-- Run this in phpMyAdmin if products table is missing

USE merenciano_db;

-- Drop table if exists (to avoid errors)
DROP TABLE IF EXISTS `products`;

-- Create products table
CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_user_id_foreign` (`user_id`),
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample products
INSERT INTO `products` (`user_id`, `name`, `description`, `price`, `quantity`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 'High-performance laptop for students', 45000.00, 10, 'Electronics', NOW(), NOW()),
(1, 'Notebook', 'College-ruled notebook', 50.00, 100, 'Books', NOW(), NOW()),
(1, 'Backpack', 'Durable school backpack', 1200.00, 25, 'Clothing', NOW(), NOW());

-- Add migration record if not exists
INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
('2025_01_01_000004_create_products_table', 1);
