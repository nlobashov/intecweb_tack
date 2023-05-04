SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `test_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `test_db`;

CREATE TABLE `product` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_trans` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `small_text` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `big_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product` (`id`, `name`, `name_trans`, `price`, `small_text`, `big_text`, `user_id`) VALUES
(1, 'Смартфон Xiaomi 12 Lite 8/128GB черный', 'Smartphone Xiaomi 12 Lite 8/128GB Black', '34990.00', 'Smartphone Xiaomi 12 Lite 8', 'Бесспорный шедевр как для фанатов технологий, так и для поклонников моды. Xiaomi 12 Lite - стильный аксессуар и визитная карточка фэшн-адептов. Свободно выражайте себя, вдохновляйте и вдохновляйтесь.', 1),
(2, 'Смартфон Xiaomi Redmi Note 11s 6/128GB синие сумерки', 'Smartphone Xiaomi Redmi Note 11s 6/128GB Blue', '19900.00', 'Xiaomi Redmi Note 11s 6/128GB', 'Redmi Note 11S — это абсолютно новая конструкция с плоской рамкой в минималистичном стиле, которая обеспечивает впечатляющий внешний вид, а также удобно лежит в руке.', 1),
(3, 'Смартфон Xiaomi Redmi 9C NFC 4/128GB зеленый', 'Smartphone Xiaomi Redmi 9C NFC 4/128GB Green', '9900.00', 'Xiaomi Redmi 9C NFC 4/128GB', 'Большой дисплей обеспечивает ощущение полного погружения в виртуальный мир. Специальная технология обеспечивает защиту глаз от синего излучения, что позволяет снизить нагрузку на них.', 5),
(6, 'Смартфон Apple iPhone 12 256GB фиолетовый', 'Smartphone Apple iPhone 12 256GB Purple', '87900.00', 'Apple iPhone 12 256GB', 'A14 Bionic, самый быстрый процессор iPhone. Дисплей OLED от края до края. И Ночной режим на всех камерах.', 4),
(12, 'Смартфон Samsung Galaxy S23 Ultra 12/256Gb зеленый', 'Smartphone Samsung Galaxy S23 Ultra 12/256Gb Green', '109800.00', 'Возвращение выдающегося', 'Возвращение выдающегося дизайна с одним важным отличием - использованием переработанных и экологически чистых материалов. При создании этого смартфона мы использовали переработанное стекло и натуральные красители для окрашивания алюминиевой рамки.', 5),
(70, 'Смартфон HONOR 70 8/256GB полночный черный', 'Smartphone HONOR 70 8/256GB Black night', '45990.00', 'HONOR 70 8/256GB Black', 'HONOR 70 имеет симметрично загнутые края передней и задней панели, благодаря чему смартфон удобно лежит в руке. Камера смартфона выполнена в виде двух симметричных кругов с эффектом свечения.', 10);


ALTER TABLE `product`
  ADD PRIMARY KEY (`id`,`user_id`);
COMMIT;