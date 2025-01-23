-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql3104.db.sakura.ne.jp
-- 生成日時: 2025 年 1 月 10 日 01:00
-- サーバのバージョン： 8.0.40
-- PHP のバージョン: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `ichi-e_taville`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `array_table`
--

CREATE TABLE `array_table` (
  `id` int NOT NULL,
  `point` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `array_table`
--

INSERT INTO `array_table` (`id`, `point`) VALUES
(2, '小学生まで添い寝OK'),
(2, 'ベット幅110cm以上'),
(2, '駅近'),
(2, 'ショッピングセンター併設'),
(4, 'バス・トイレ別'),
(4, '靴を脱ぐお部屋'),
(4, '駅近'),
(4, 'ショッピングセンター併設'),
(5, 'バス・トイレ別'),
(5, '小学生まで添い寝OK'),
(5, 'ベット幅110cm以上'),
(5, '靴を脱ぐお部屋'),
(6, 'バス・トイレ別'),
(6, 'ベット幅110cm以上'),
(6, '靴を脱ぐお部屋'),
(6, '駅近'),
(6, 'ショッピングセンター併設'),
(7, 'バス・トイレ別'),
(7, '駅近'),
(7, 'ショッピングセンター併設'),
(8, 'バス・トイレ別'),
(8, 'ベット幅110cm以上'),
(9, 'バス・トイレ別'),
(9, 'ベット幅110cm以上'),
(9, '靴を脱ぐお部屋'),
(1, 'バス・トイレ別'),
(1, '小学生まで添い寝OK'),
(1, 'ベット幅110cm以上'),
(1, '駅近');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `array_table`
--
ALTER TABLE `array_table`
  ADD KEY `array_table_ibfk_1` (`id`);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `array_table`
--
ALTER TABLE `array_table`
  ADD CONSTRAINT `array_table_ibfk_1` FOREIGN KEY (`id`) REFERENCES `taville_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
