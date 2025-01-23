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
-- テーブルの構造 `taville_table`
--

CREATE TABLE `taville_table` (
  `id` int NOT NULL,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pref` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `url` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stars` int NOT NULL,
  `images` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `date` datetime NOT NULL,
  `uid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `taville_table`
--

INSERT INTO `taville_table` (`id`, `name`, `pref`, `url`, `stars`, `images`, `comment`, `date`, `uid`) VALUES
(1, 'ザ・ワンファイブ仙台', '宮城県', 'https://onefivehotels.co.jp/hotels/theonefivesendai', 4, '20250110000816sendai_room06_01-1.jpg', 'アメニティなどは必要最低限でとてもシンプルだが、価格がとてもリーズナブルで嬉しい！', '2024-12-19 23:15:20', 1),
(2, '横浜ロイヤルパークホテル', '神奈川県', 'https://www.yrph.com/', 4, '20241219232851img_deluxe_twin02.webp', 'ランドマークタワーの中にあるので、子供達のお昼寝中にパパとママが交代で買い物に出かけられるのが嬉しいポイント。\r\nホテルから八景島シーパラダイスなどへバスも出ているため小さいお子様との移動も安心。', '2024-12-19 23:28:51', 2),
(4, 'ホテル京阪 ユニバーサル・タワー', '大阪府', 'https://www.hotelkeihan.co.jp/tower/', 5, '20241219233159img_top01.jpg', 'ユニバーサルシティ駅を出てすぐなのでアクセスが楽！\r\nかわいい内装は子供も大喜び！\r\n靴を脱いで上がれるお部屋ででゆっくりくつろげる。\r\n部屋が広い。', '2024-12-19 23:31:59', 3),
(5, 'HOTEL MAZARIUM', '岩手県', 'https://hotelmazarium.com/', 4, '20241219233415special_premium-twin_photo_01.jpg', '盛岡バスセンターの中にあるホテル。\r\n部屋にはシャワールームしかないが、本格的なフィンランド式サウナを備えた大浴場があり子供と楽しめる。\r\nおむつ着用の乳幼児は浴槽を利用出来ないが、ベビーバスの貸し出しもあり。\r\n大浴場のドライヤーはReFaやdysonなど数種類設置されており、色々試すことができるのも楽しい。', '2024-12-19 23:34:15', 1),
(6, 'ホテルドリームゲート舞浜', '千葉県', 'https://www.hdgm.jp/', 5, '20241219233537family4_1000-500.jpg', '舞浜駅直結のホテルの為、ディズニランド・ディズニーシーへのアクセスが抜群に良い！\r\nリーズナブルにディズニーを楽しみたい方にオススメ。\r\n入浴剤の種類が豊富に用意されているのが嬉しい。\r\n靴を脱げるお部屋は子供と一緒でも気を使わずくつろげる。\r\nチェックイン前・チェックイン後どちらも無料でコインロッカーを使用出来るところもポイント。', '2024-12-19 23:35:37', 2),
(7, 'ヴィラフォンテーヌ グランド 東京有明', '東京都', 'https://www.hvf.jp/ariake-grand/', 3, '20241219233714img_11.jpg', '子供と泊まるなら和洋室がオススメ。\r\n有明ガーデンへの連絡通路がありショッピングも楽しめる。\r\n東京駅方面など無料巡回バスが運行されている。', '2024-12-19 23:37:14', 3),
(8, 'ホテルピエナ神戸', '兵庫県', 'https://www.piena.co.jp/', 4, '20241219233812img_royal_twin02.jpg', '独立したバスと広いお部屋が嬉しい。\r\n観光地へのアクセスも良い。', '2024-12-19 23:38:12', 1),
(9, 'リーガロイヤルホテル京都', '京都府', 'https://www.rihga.co.jp/kyoto', 5, '20241219235640kyoto-stay-room-regular-jwroom.webp', '和洋室なら小さいお子様と一緒でも安心！\r\n京都駅からの送迎バスもあり移動も楽に出来る。', '2024-12-19 23:56:40', 2);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `taville_table`
--
ALTER TABLE `taville_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `taville_table`
--
ALTER TABLE `taville_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
