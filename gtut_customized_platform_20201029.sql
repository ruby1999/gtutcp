-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2020 年 10 月 29 日 05:15
-- 伺服器版本： 5.7.29-0ubuntu0.18.04.1
-- PHP 版本： 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `gtut_customized_platform`
--

-- --------------------------------------------------------

--
-- 資料表結構 `categories`
--

CREATE TABLE `categories` (
  `id` int(50) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, '前端特效', 'fronted', 0, '2020-09-25 05:36:45', '2020-09-25 05:36:45'),
(2, '報表', 'report', 0, '2020-09-25 05:36:45', '2020-09-25 05:36:45'),
(3, '預約', 'reservation', 0, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(4, '篩選', 'filter', 0, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(5, '表單', 'form', 0, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(6, 'QA', 'QA', 0, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(7, '串接', 'connect', 0, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(8, '企業專區', 'enterprise', 0, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(9, '客戶資料蒐集', 'storedata', 0, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(10, '系統', 'system', 0, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(11, '其他', 'other', 0, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(12, '社會責任', 'CSR', 8, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(13, '投資人專區', 'investment', 8, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(14, '問答', 'radio', 9, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(15, '問卷', 'paper', 9, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(16, '進銷存', 'PSR', 10, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(17, '會計', 'AC', 10, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(18, '拆勤', 'DS', 10, '2020-09-25 05:41:16', '2020-09-25 05:41:16'),
(19, '行銷', 'marketing', 0, '2020-09-25 06:30:48', '2020-09-25 06:30:48');

-- --------------------------------------------------------

--
-- 資料表結構 `category_content`
--

CREATE TABLE `category_content` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `category_content`
--

INSERT INTO `category_content` (`id`, `category_id`, `content_id`) VALUES
(31, 1, 31),
(32, 1, 32),
(33, 1, 33),
(34, 1, 34),
(35, 2, 35),
(36, 3, 36),
(37, 3, 37),
(38, 4, 38),
(39, 4, 39),
(40, 4, 40),
(41, 4, 41),
(26, 5, 26),
(27, 5, 27),
(28, 5, 28),
(29, 5, 29),
(30, 5, 30),
(9, 6, 9),
(10, 6, 10),
(16, 7, 16),
(23, 11, 23),
(24, 11, 24),
(25, 11, 25),
(2, 12, 2),
(3, 12, 3),
(6, 13, 6),
(7, 13, 7),
(8, 13, 8),
(5, 14, 5),
(1, 15, 1),
(4, 15, 4),
(17, 16, 17),
(18, 16, 18),
(19, 16, 19),
(22, 17, 22),
(11, 18, 11),
(12, 18, 12),
(13, 18, 13),
(14, 18, 14),
(15, 18, 15),
(20, 18, 20),
(21, 18, 21);

-- --------------------------------------------------------

--
-- 資料表結構 `content`
--

CREATE TABLE `content` (
  `id` int(50) NOT NULL,
  `category_id` int(50) NOT NULL,
  `company` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `system` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `content`
--

INSERT INTO `content` (`id`, `category_id`, `company`, `name`, `description`, `url`, `system`, `created_at`, `updated_at`) VALUES
(1, 15, '天妮絲', '適合產品推薦', '填問卷，推薦商品', 'https://www.tenllis.com.tw/survey', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(2, 12, '東聯', '互動表單\n(了解企業社會責任)', '全Radio Button表單填寫 \n為使利害關係人更加了解東聯對於社會責任的各種作法，並使社會責任報告能夠與利害關係人達成有效的溝通，請您協助意見的回饋與建議，協助我們了解您所關注的議題，作為報告書資訊揭露的主要參考。', 'https://www.oucc.com.tw/csr-99-page470', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(3, 12, '東聯', '互動表單\n(了解企業社會責任)', '1.10題互動式問答，幫助使用者了解東聯的企業社會責任、事蹟\n2.後台可設置更改題目欄位與對錯，\n3.填寫完畢後可顯示【測試時間】【分數】  ', 'https://www.oucc.com.tw/survey', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(4, 15, '東聯', '互動表單\n(了解企業社會責任)', '全Radio Button表單填寫 \n為使利害關係人更加了解東聯對於社會責任的各種作法，並使社會責任報告能夠與利害關係人達成有效的溝通，請您協助意見的回饋與建議，協助我們了解您所關注的議題，作為報告書資訊揭露的主要參考。', 'https://www.oucc.com.tw/csr-99-page470', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(5, 14, '東聯', '互動表單\n(了解企業社會責任)', '1.10題互動式問答，幫助使用者了解東聯的企業社會責任、事蹟\n2.後台可設置更改題目欄位與對錯，\n3.填寫完畢後可顯示【測試時間】【分數】  ', 'https://www.oucc.com.tw/survey', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(6, 13, '千如電機', '投資人專區', '1.各季可上傳PDF\n2.營業額設定', 'https://www.atec-group.com/extrabold', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(7, 13, '千如電機', '投資人專區', '1.上架PDF\n2.顯示表格\n3.連結yahoo股市\n4.連結公開資訊觀測站\n5.連結公開資訊觀測站', 'https://www.atec-group.com/extrabold', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(8, 13, '東聯', '投資人專區', '客製化欄位、表格、上傳PDF', 'https://www.oucc.com.tw/investor', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(9, 6, '千如電機', '問答頁面', '問答頁面', 'https://www.atec-group.com/frequently-asked-questions', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(10, 6, '歐得葆 ', '問答頁面', '問答專欄', 'https://www.oderbau.com.tw/faq-event', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(11, 18, '歐得葆 ', '客戶評價輪播', '客戶評價輪播', 'https://www.oderbau.com.tw/', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(12, 18, '歐得葆 ', '填寫產品評價文', '顧客填寫產品體驗文及上傳產品照片', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(13, 18, '歐得葆 ', '填寫參觀體驗文', '顧客填寫參觀體驗文', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(14, 18, '歐得葆 ', '會員生日賀卡', '會員生日時寄送生日賀卡', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(15, 18, '歐得葆 ', '預購活動', '1.可設時間倒數\n2.可切換彈跳訊息\n3.達成人數目標設定\n7.內頁BANENR 可改影片\n8.活動需加入會員提醒\n9.會員登入後自動帶入基本資料\n10.訂購流程相關頁面  --> 請設計部提供版型\n11.查詢訂購頁面\n12.訂購確認以簡訊及mail 通知\n13.預告下次活動BANENR 或訊息', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(16, 7, '歐得葆 ', '簡訊串接', '1.串接中華電信簡訊\n2.後台設定不同的表單，回覆不同的簡訊內容\n\n預約參觀\n預約量身訂做\n活動預購\nVIP註冊表單', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(17, 16, '靜蘊', '商品安全總庫存警示', '1.可設定各項產品的安全庫存量\n2.在後台主頁顯示商品安全總庫存警示、商品安全庫存警示', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(18, 16, '靜蘊', '進銷存系統', '1.進貨管理\n2.調貨管理\n3.庫存查詢\n4.庫存管理\n5.領料管理', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(19, 16, '西服先生', '進銷存系統', '', 'https://www.mr-suit.com.tw/admin/customers/4980', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(20, 18, '靜蘊', '排班', '1.員工排班、申請休假\n2.審核休假申請', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(21, 18, '靜蘊', '考勤管理', '1.考勤管理 (打卡上下班)', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(22, 17, '靜蘊', '會計記帳', '1.會計記帳(轉帳傳票)\n2.自訂會計科目\n3.零用金計算', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(23, 11, '愛麗絲', '首頁導向產品頁面', '預設首頁為熱門產品頁', 'https://www.alicefurniture.com.tw/', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(24, 11, '靜蘊', '客製化快捷鍵(路徑)', '後台客製化捷徑按鈕，快速連結至新增會員、課程預約、快速結帳', '-', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(25, 11, '裕群\n寧豪', '依瀏覽器語言自動更換網頁語系', '依瀏覽器語言自動更換網頁語系\n(參考PPT)', 'https://www.sprracing.com.tw/', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(26, 5, '歐得葆 ', '預約參觀顯示分店', '1.依分店顯示地圖\n頁面', 'https://www.oderbau.com.tw/visit-request', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(27, 5, '千如電機', '聯絡表單支援上傳檔案', '產品諮詢(可上傳表單)', 'https://www.atec-group.com/contact', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(28, 5, '東聯', '聯絡表單支援上傳檔案', '人事履歷表(上傳人事資料表)', 'https://www.oucc.com.tw/personal-resume', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(29, 5, '東聯', '依各部門設定寄送聯絡表單資訊', '可依所選的聯絡部門類別，寄信給該部門聯絡人', 'https://www.oucc.com.tw/contact', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(30, 5, '東聯', '下載檔案前填寫表單', '1.下載檔案前須先填寫聯絡表單\n2.填寫完畢後，連動聯絡表單的部門欄位，寄信給該部門聯絡人', 'https://www.oucc.com.tw/eg-products', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(31, 1, '千如電機', '時間軸', '時間軸顯示企業沿革、重要事件', 'https://www.atec-group.com/about-73-page88', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(32, 1, '壓克力競賽', '倒數計時器', '四階段的倒數計時器介面\n(開始報名、報名截止、公布入圍名單、頒獎典禮)', 'http://contest-acrylicap.gtut.work/2021', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(33, 1, '愛麗絲', '內頁Banner輪播圖片', '內頁預設Banner功能增加輪播功能', 'https://www.alicefurniture.com.tw/aboutus', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(34, 1, '得祐', '產品圖放大功能', '1.使用同一張產品圖片,依據滑鼠框框進行右側局部放大功能 \n2.此套件支援手機板(如按著手機上產品圖片會直接進行放大)', 'https://www.evercomtech.com/', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(35, 2, '靜蘊', '報表管理', '1.個人業績報表\n2.門市業績報表\n3.業績排名表\n4.課程點數使用報表\n5.營收報表\n6.進貨報表\n7.調貨報表\n8.零用金報表', 'http://ivyspa.ikema.com.tw/admin/appointments', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(36, 3, '靜蘊', '美容課程預約', '1.前台課程預約\n2.後台顯示預約資料\n3.後台點擊日曆可以新增預約', 'http://ivyspa.ikema.com.tw/admin/appointments', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(37, 3, '小叮噹', '滑雪預約、報名', '1.教練課程預約\n2.自滑預約\n3.夜滑包場\n4.租借雪具\n5.Qrcode報到', 'http://ivyspa.ikema.com.tw/admin/appointments', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(38, 4, '千如電機', '客製化搜尋', '1.依類別下拉式篩選\n2.文字搜尋欄輸入部分產品編號\n3.產品型號關鍵字推薦', 'https://www.atec-group.com/search-products', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(39, 4, '千如電機', '客製化搜尋', '1.依類別(Category)、子類別(Categories)、類型(Type)下拉式篩選\n2.篩選規格，不同產品規格參數，設定最大值及', 'https://www.atec-group.com/search-products-by-spec', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(40, 4, '揚明光學', '客製化搜尋', '1.依標籤搜尋商品\n2.顯示有該標籤的類別', 'https://www.youngoptics.com/', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00'),
(41, 4, '久大橡膠', '首頁新增品牌篩選', '首頁可篩選品牌&搜尋產品', 'http://jodarubber.gtut.work/', '快易購', '2020-09-25 06:30:00', '2020-09-25 06:30:00');

-- --------------------------------------------------------

--
-- 資料表結構 `content_tag`
--

CREATE TABLE `content_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `category_content`
--
ALTER TABLE `category_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_content_id` (`category_id`,`content_id`),
  ADD KEY `content_id` (`content_id`);

--
-- 資料表索引 `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_cat_id` (`category_id`);

--
-- 資料表索引 `content_tag`
--
ALTER TABLE `content_tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unique` (`content_id`,`tag_id`),
  ADD UNIQUE KEY `id` (`id`,`content_id`,`tag_id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- 資料表索引 `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `category_content`
--
ALTER TABLE `category_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `content`
--
ALTER TABLE `content`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `content_tag`
--
ALTER TABLE `content_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `category_content`
--
ALTER TABLE `category_content`
  ADD CONSTRAINT `category_content_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_content_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
