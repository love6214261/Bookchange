-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-08-22 14:21:18
-- 伺服器版本: 5.7.9
-- PHP 版本： 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `secondhandbookstore`
--

-- --------------------------------------------------------

--
-- 資料表結構 `allbook`
--

DROP TABLE IF EXISTS `allbook`;
CREATE TABLE IF NOT EXISTS `allbook` (
  `id_book` int(11) NOT NULL AUTO_INCREMENT,
  `bookclass` char(20) NOT NULL COMMENT '類別',
  `name` char(30) NOT NULL COMMENT '書名',
  `ISBN` char(13) NOT NULL,
  `author` char(30) NOT NULL COMMENT '作者',
  `postdate` date NOT NULL COMMENT '出版日期',
  `price` char(5) NOT NULL COMMENT '價格',
  `publishingHouse` char(30) NOT NULL COMMENT '出版社',
  `id_buyer` int(11) NOT NULL,
  `book_picture` varchar(20) NOT NULL,
  PRIMARY KEY (`id_book`),
  KEY `id_seller` (`id_buyer`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `allbook`
--

INSERT INTO `allbook` (`id_book`, `bookclass`, `name`, `ISBN`, `author`, `postdate`, `price`, `publishingHouse`, `id_buyer`, `book_picture`) VALUES
(1, '資訊電機學院', '酥酥的作業系統', '123465789998', '酥酥', '2016-07-20', '1450', '酥酥出版社', 1234, 'OM.jpg'),
(20, '文學院', '約談的藝術', '4567891231233', '昆堃', '2016-07-08', '5487', '昆堃的異想世界', 1, 'picture_1.jpg'),
(21, '文學院', 'php', '123465789000', 'MCheng', '2016-07-07', '100', 'MCheng', 1, 'kfs.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_class` enum('electric','management','language','engineering','earth','science','hakka','health','others') NOT NULL COMMENT '類別',
  `book_name` varchar(120) DEFAULT NULL COMMENT '書名',
  `book_isbn` char(13) NOT NULL,
  `book_author` varchar(120) DEFAULT NULL COMMENT '作者',
  `book_postdate` date DEFAULT NULL COMMENT '出版日期',
  `book_price` int(5) DEFAULT NULL COMMENT '價格',
  `book_publishinghouse` varchar(120) DEFAULT NULL COMMENT '出版社',
  `member_id` int(11) NOT NULL,
  `book_picture` varchar(300) DEFAULT NULL,
  `book_condition` enum('接近全新','保存極佳','保存良好','尚可接受') NOT NULL COMMENT '書況',
  `book_time` datetime NOT NULL,
  `book_twoprice` int(5) NOT NULL,
  `book_upcondition` enum('上架中','交易中','下架','交易結束','評價中','交易成功','交易失敗') NOT NULL,
  `book_rentOrNot` enum('是','否') NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `book`
--

INSERT INTO `book` (`book_id`, `book_class`, `book_name`, `book_isbn`, `book_author`, `book_postdate`, `book_price`, `book_publishinghouse`, `member_id`, `book_picture`, `book_condition`, `book_time`, `book_twoprice`, `book_upcondition`, `book_rentOrNot`) VALUES
(20, 'management', '約談的藝術', '4567891231233', '昆堃', '2016-07-08', 5487, '昆堃的異想世界', 2, 'picture_1.jpg', '接近全新', '2016-07-08 00:00:00', 0, '交易中', '是'),
(21, 'management', 'php', '123465789000', 'MCheng', '2016-07-07', 100, 'MCheng', 2, 'kfs.jpg', '接近全新', '2016-07-08 00:00:00', 0, '交易中', '是'),
(40, 'management', '酥酥的作業系統', '123465789998', '酥酥', '2016-07-20', 1450, '酥酥出版社', 3, 'OM.jpg', '接近全新', '2016-07-08 00:00:00', 0, '交易中', '是'),
(115, 'management', '約談的藝術', '4567891231233', '昆堃', NULL, 5487, '昆堃的異想世界', 5, 'picture_1.jpg', '接近全新', '2016-08-18 01:32:09', 13, '交易成功', '是'),
(116, 'management', 'php', '123465789000', 'MCheng', NULL, 100, 'MCheng', 2, 'kfs.jpg', '保存極佳', '2016-08-18 01:56:10', 500, '上架中', '是'),
(117, 'electric', 'php', '123465789000', 'MCheng', NULL, 100, 'MCheng', 5, 'kfs.jpg', '保存極佳', '2016-08-18 01:56:48', 500, '上架中', '否'),
(118, 'science', '酥酥的作業系統', '123465789998', '酥酥', NULL, 1450, '酥酥出版社', 2, 'OM.jpg', '接近全新', '2016-08-18 01:58:07', 600, '交易中', '是'),
(119, 'management', '酥酥的作業系統', '123465789998', '酥酥', NULL, 1450, '酥酥出版社', 5, 'OM.jpg', '接近全新', '2016-08-18 02:07:58', 500, '交易中', '是'),
(120, 'management', '酥酥的作業系統', '123465789998', '酥酥', NULL, 1450, '酥酥出版社', 5, 'OM.jpg', '接近全新', '2016-08-18 02:08:51', 500, '評價中', '是'),
(121, 'management', '酥酥的作業系統', '123465789998', '酥酥', NULL, 1450, '酥酥出版社', 5, 'OM.jpg', '接近全新', '2016-08-18 02:09:28', 4580, '評價中', '是'),
(122, 'electric', '酥酥的作業系統', '123465789998', '酥酥', NULL, 1450, '酥酥出版社', 2, 'OM.jpg', '接近全新', '2016-08-18 02:18:05', 200, '上架中', '是'),
(123, 'management', '酥酥的作業系統', '123465789998', '酥酥', NULL, 1450, '酥酥出版社', 2, 'OM.jpg', '接近全新', '2016-08-18 02:19:30', 200, '評價中', '是'),
(124, 'management', 'php', '123465789000', 'MCheng', NULL, 100, 'MCheng', 5, 'kfs.jpg', '尚可接受', '2016-08-19 11:39:59', 300, '評價中', '否'),
(125, 'management', '酥酥的作業系統', '123465789998', '酥酥', NULL, 1450, '酥酥出版社', 5, 'OM.jpg', '接近全新', '2016-08-22 04:03:53', 90, '交易成功', '是');

-- --------------------------------------------------------

--
-- 資料表結構 `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `chat_time` datetime NOT NULL COMMENT '發言時間',
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_content` text NOT NULL COMMENT '發言內容',
  `member_id` int(11) DEFAULT NULL COMMENT '說話的會員是誰',
  `book_id` int(11) DEFAULT NULL,
  `chat_buyerRead` tinyint(1) NOT NULL DEFAULT '1',
  `chat_sellerRead` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`chat_id`),
  KEY `member_id` (`member_id`),
  KEY `trade_id` (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `chat`
--

INSERT INTO `chat` (`chat_time`, `chat_id`, `chat_content`, `member_id`, `book_id`, `chat_buyerRead`, `chat_sellerRead`) VALUES
('2016-08-19 11:44:37', 149, '啥阿', 2, 124, 1, 1),
('2016-08-19 11:44:30', 148, '你好喔', 2, 124, 1, 1),
('2016-08-19 11:44:03', 147, '你好', 5, 124, 1, 1),
('2016-08-19 11:33:35', 146, 'WJY', 2, 119, 1, 1),
('2016-08-19 11:33:22', 145, 'EHYEKFF', 2, 119, 1, 1),
('2016-08-19 11:33:01', 144, '事實勝於雄辯', 5, 119, 1, 1),
('2016-08-19 11:32:02', 143, '您好', 2, 119, 1, 1),
('2016-08-19 11:30:09', 142, 'HAY', 5, 119, 1, 1),
('2016-08-19 11:45:00', 150, '我是資管三審還玲', 5, 124, 1, 1),
('2016-08-19 11:45:58', 151, '測試', 2, 124, 1, 1),
('2016-08-19 11:46:38', 152, '好怪 喔', 5, 124, 1, 1),
('2016-08-19 11:47:16', 153, '進行剩餘人數留言測試', 2, 124, 1, 1),
('2016-08-19 11:47:44', 154, '進行以毒測試', 5, 124, 1, 1),
('2016-08-19 11:55:44', 155, '排山倒海', 2, 124, 1, 1),
('2016-08-19 11:56:05', 156, '嗨', 2, 124, 1, 1),
('2016-08-20 12:02:40', 157, '你好~', 5, 124, 1, 1),
('2016-08-20 12:04:49', 158, '再行測試', 2, 124, 1, 1),
('2016-08-20 12:05:17', 159, '哀', 5, 124, 1, 1),
('2016-08-22 12:27:48', 160, '8/22在次測試對話未讀', 2, 119, 1, 1),
('2016-08-22 12:28:00', 161, 'AGAIN\n', 2, 119, 1, 1),
('2016-08-22 12:47:02', 163, '現在進行測試', 2, 118, 0, 1),
('2016-08-22 01:19:17', 164, '哈囉囉', 2, 118, 0, 1),
('2016-08-22 01:22:19', 165, '我是一串很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長的話', 2, 118, 0, 1),
('2016-08-22 01:22:32', 166, '你好你好你好你好你好你好你好你好你好', 2, 118, 0, 1),
('2016-08-22 03:12:50', 167, '我是JJ林俊傑', 6, 121, 1, 1),
('2016-08-22 03:13:20', 168, '唱歌給你聽好不好~~~~', 6, 121, 1, 1),
('2016-08-22 04:06:46', 169, '我是一串很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長...我是一串很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長...我是一串很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長...我是一串很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長很長...的對話\r\n', 6, 125, 1, 1),
('2016-08-22 04:07:34', 170, 'JJJJJJJJJJJJJJJJJJJJJJJJJJJ', 6, 125, 1, 1),
('2016-08-22 04:15:39', 171, '來一次', 6, 125, 1, 1),
('2016-08-22 04:15:41', 172, '', 6, 125, 1, 1),
('2016-08-22 06:04:08', 173, '測試囉!!!!!!!', 6, 125, 1, 1),
('2016-08-22 06:07:08', 174, '說話啊 ㄚㄚㄚㄚㄚ', 6, 125, 1, 1),
('2016-08-22 06:12:51', 175, '聽到囉!', 5, 125, 1, 1),
('2016-08-22 06:14:39', 176, '來買書', 6, 125, 1, 1),
('2016-08-22 06:15:07', 177, '嗨', 6, 125, 1, 1),
('2016-08-22 06:15:16', 178, '來了來了', 5, 125, 1, 1),
('2016-08-22 06:15:26', 179, '從山坡上', 6, 125, 1, 1),
('2016-08-22 06:15:36', 180, '輕輕地溜下來~', 5, 125, 1, 1),
('2016-08-22 06:17:02', 181, '嗚嗚嗚嗚嗚嗚嗚嗚', 6, 125, 1, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `evaluation_id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluation_score` float NOT NULL COMMENT '評分',
  `evaluation_date` datetime NOT NULL COMMENT '評價日期',
  `evaluation_condition` enum('正常完成','正常取消','異常取消:面交放鳥、不回復訊息','其他取消原因') NOT NULL,
  `evaluation_advise` char(100) DEFAULT NULL COMMENT '評價建議',
  `member_id` int(11) DEFAULT NULL COMMENT '被評價的人',
  `trade_id` int(11) DEFAULT NULL,
  `evaluation_evaluator` int(11) NOT NULL,
  `evaluation_read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`evaluation_id`),
  KEY `id_buyer` (`member_id`),
  KEY `id_trade` (`trade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `evaluation_score`, `evaluation_date`, `evaluation_condition`, `evaluation_advise`, `member_id`, `trade_id`, `evaluation_evaluator`, `evaluation_read`) VALUES
(86, 10, '2016-08-18 01:44:25', '正常完成', 'GOOD', 5, 82, 2, 0),
(87, 9.5, '2016-08-18 01:54:41', '正常完成', '很快', 2, 82, 5, 0),
(89, 10, '2016-08-18 11:31:10', '正常完成', '123', 2, 83, 5, 0),
(91, 8.5, '2016-08-20 12:21:48', '正常完成', '我覺得很讚阿', 5, 86, 2, 0),
(92, 10, '2016-08-22 06:18:00', '正常完成', '我覺得很半', 6, 89, 5, 0),
(93, 10, '2016-08-22 06:18:56', '正常完成', '很半', 5, 89, 6, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `illegal`
--

DROP TABLE IF EXISTS `illegal`;
CREATE TABLE IF NOT EXISTS `illegal` (
  `illegal_id` int(11) NOT NULL AUTO_INCREMENT,
  `illegal_reason` char(100) NOT NULL COMMENT '違規原因',
  `trade_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`illegal_id`),
  KEY `id_buyer` (`member_id`),
  KEY `id_trade` (`trade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_account` char(10) NOT NULL,
  `member_password` char(15) NOT NULL COMMENT '密碼',
  `member_name` char(15) NOT NULL COMMENT '買家名稱',
  `member_school` enum('中央大學') NOT NULL COMMENT '學校',
  `member_class` enum('管理學院','資訊電機學院','文學院','工學院','地球科學學院','理學院','客家學院','生醫理工學院','其他學院') NOT NULL,
  `member_department` varchar(20) NOT NULL COMMENT '科系',
  `member_email1` char(50) NOT NULL COMMENT '學校email',
  `member_email2` char(50) DEFAULT NULL,
  `member_activated` int(1) NOT NULL COMMENT '判斷驗證(0or1)',
  `member_score` float NOT NULL,
  `member_tradeNum` int(255) NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `member_id` (`member_id`),
  KEY `member_id_2` (`member_id`),
  KEY `member_id_3` (`member_id`),
  KEY `member_account` (`member_account`),
  KEY `member_id_4` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `member`
--

INSERT INTO `member` (`member_id`, `member_account`, `member_password`, `member_name`, `member_school`, `member_class`, `member_department`, `member_email1`, `member_email2`, `member_activated`, `member_score`, `member_tradeNum`) VALUES
(2, '102403536', 'ciu199669', '沈涵羚', '中央大學', '管理學院', '資管三B', '102403536', '910159', 1, 9.83333, 8),
(3, '102403537', 'ciu199559', 'sherry', '中央大學', '管理學院', 'MIX', '102403536', '0', 1, 0, 0),
(4, '102444444', '1508', '葛蘭', '中央大學', '管理學院', '三年二班', '1010274', '1010274', 1, 0, 0),
(5, '1234', '1234', '1234', '中央大學', '管理學院', 'MIT', '#@uiwydoqw', '#@lkjwdldw', 1, 9.5, 5),
(6, '102403527', '123', 'JJ', '中央大學', '管理學院', '資管系', '102403527@cc.ncu.edu.tw', 'primerosehuang@gmail.com', 1, 10, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `problem`
--

DROP TABLE IF EXISTS `problem`;
CREATE TABLE IF NOT EXISTS `problem` (
  `problem_id` int(11) NOT NULL AUTO_INCREMENT,
  `problem_subject` char(50) NOT NULL,
  `problem_body` text NOT NULL,
  `problem_category` char(10) NOT NULL,
  `problem_email` char(50) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`problem_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `rent`
--

DROP TABLE IF EXISTS `rent`;
CREATE TABLE IF NOT EXISTS `rent` (
  `rent_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `search`
--

DROP TABLE IF EXISTS `search`;
CREATE TABLE IF NOT EXISTS `search` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `search_isbn` int(13) NOT NULL,
  PRIMARY KEY (`search_id`),
  KEY `search_isbn` (`search_isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `trace`
--

DROP TABLE IF EXISTS `trace`;
CREATE TABLE IF NOT EXISTS `trace` (
  `trace_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`trace_id`),
  KEY `member_id` (`member_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `trace`
--

INSERT INTO `trace` (`trace_id`, `member_id`, `book_id`) VALUES
(1, 2, 115),
(3, 5, 122);

-- --------------------------------------------------------

--
-- 資料表結構 `trade`
--

DROP TABLE IF EXISTS `trade`;
CREATE TABLE IF NOT EXISTS `trade` (
  `trade_id` int(11) NOT NULL AUTO_INCREMENT,
  `trade_condition` enum('交易中','交易成功','交易失敗','評價中') DEFAULT NULL COMMENT '交易狀態',
  `trade_start` datetime DEFAULT NULL COMMENT '交易成立時間',
  `trade_end` datetime DEFAULT NULL,
  `trade_rentOrBuy` enum('rent','buy','null','') NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`trade_id`),
  KEY `id_buyer` (`buyer_id`),
  KEY `id_seller` (`seller_id`),
  KEY `id_book` (`book_id`),
  KEY `id_trade` (`trade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `trade`
--

INSERT INTO `trade` (`trade_id`, `trade_condition`, `trade_start`, `trade_end`, `trade_rentOrBuy`, `buyer_id`, `seller_id`, `book_id`) VALUES
(82, '交易成功', '2016-08-18 01:36:54', '2016-08-23 01:36:54', 'buy', 2, 5, 115),
(83, '評價中', '2016-08-18 02:11:55', '2016-08-23 02:11:55', 'buy', 2, 5, 120),
(84, '交易中', '2016-08-18 09:33:07', '2016-08-23 21:33:07', 'buy', 2, 5, 119),
(85, '評價中', '2016-08-18 11:17:54', '2016-08-23 23:17:54', 'buy', 5, 2, 123),
(86, '評價中', '2016-08-19 11:42:12', '2016-08-24 23:42:12', 'buy', 2, 5, 124),
(87, '交易中', '2016-08-22 12:39:56', '2016-08-27 00:39:56', 'buy', 5, 2, 118),
(88, '評價中', '2016-08-22 03:11:52', '2016-08-27 15:11:52', 'buy', 6, 5, 121),
(89, '交易成功', '2016-08-22 04:04:55', '2016-08-27 16:04:55', 'buy', 6, 5, 125);

-- --------------------------------------------------------

--
-- 資料表結構 `waitlist`
--

DROP TABLE IF EXISTS `waitlist`;
CREATE TABLE IF NOT EXISTS `waitlist` (
  `waitlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `waitlist_dealtime` enum('14','30','120','365','0') NOT NULL,
  `waitlist_RorB` enum('rent','buy') NOT NULL,
  PRIMARY KEY (`waitlist_id`),
  KEY `id_trade` (`book_id`),
  KEY `id_buyer` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `waitlist`
--

INSERT INTO `waitlist` (`waitlist_id`, `book_id`, `member_id`, `waitlist_dealtime`, `waitlist_RorB`) VALUES
(60, 115, 2, '0', 'buy'),
(61, 120, 2, '0', 'buy'),
(62, 119, 5, '0', 'buy'),
(63, 123, 5, '0', 'buy'),
(64, 124, 2, '0', 'buy'),
(65, 118, 5, '0', 'buy'),
(66, 121, 6, '0', 'buy'),
(67, 125, 6, '0', 'buy');

-- --------------------------------------------------------

--
-- 資料表結構 `wishpool`
--

DROP TABLE IF EXISTS `wishpool`;
CREATE TABLE IF NOT EXISTS `wishpool` (
  `wishpool_id` int(11) NOT NULL AUTO_INCREMENT,
  `wishpool_bookname` varchar(120) NOT NULL COMMENT '許願書名',
  `wishpool_author` varchar(120) NOT NULL COMMENT '許願書作者',
  `wishpool_isbn` char(13) NOT NULL,
  `wishpool_condition` enum('接近全新','保存極佳','保存良好','尚可接受') NOT NULL COMMENT '許願書書況程度',
  `wishpool_willingprice` int(5) NOT NULL COMMENT '願意購入價格',
  `wishpool_publishinghouse` varchar(120) NOT NULL,
  `wishpool_date` date NOT NULL,
  `member_id` int(11) NOT NULL,
  `wishpool_matchCon` enum('match','unmatch') NOT NULL DEFAULT 'unmatch',
  PRIMARY KEY (`wishpool_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `wishpool`
--

INSERT INTO `wishpool` (`wishpool_id`, `wishpool_bookname`, `wishpool_author`, `wishpool_isbn`, `wishpool_condition`, `wishpool_willingprice`, `wishpool_publishinghouse`, `wishpool_date`, `member_id`, `wishpool_matchCon`) VALUES
(1, '稀珍的稀世珍寶', '稀珍', '229900011', '尚可接受', 1200, '稀珍的小屋', '2016-07-22', 0, 'unmatch'),
(2, '五個傻瓜', '傻瓜', '12344455', '尚可接受', 1234, '傻瓜出版社', '2016-07-05', 0, 'unmatch'),
(3, '西瓜偎大鞭', '西瓜', '1324656789', '接近全新', 500, '西瓜出版', '2016-08-18', 5, 'unmatch');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
