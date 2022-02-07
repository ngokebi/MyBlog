-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 10:31 AM
-- Server version: 8.0.25
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `username` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `addedby` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datetime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `admin_name`, `addedby`, `datetime`) VALUES
(2, 'abcc', 'a', 'abcc', 'Ngozi', 'August 27, 2020 01:14:16 pm'),
(3, 'Ngkebi', 'Dell_2020', 'Ikeaba Ngozichukwuka I', 'abcc', 'September 02, 2020 08:28:52 am');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datetime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(1, 'Home', 'Ngozi', 'August 24, 2020 10:36:44 am'),
(2, 'Sport', 'Ngozi', 'August 24, 2020 10:36:48 am');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `approvedby` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int NOT NULL,
  `datetime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `name`, `email`, `comment`, `approvedby`, `status`, `post_id`, `datetime`) VALUES
(7, 'Ikeaba Ngozichukwuka I', 'kebidegozi@gmail.com', 'good', 'abcc', 'ON', 3, 'September 03, 2020 10:03:28 am'),
(8, 'Ikeaba Ngozichukwuka I', 'kebidegozi@gmail.com', 'not good ', 'abcc', 'ON', 3, 'September 03, 2020 10:03:36 am');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int NOT NULL,
  `post_title` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_image` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_author` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_keyword` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_content` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datetime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `category`, `post_image`, `post_author`, `post_keyword`, `post_content`, `datetime`) VALUES
(1, 'New Era in Madrid', 'Home', '31539.jpg', 'Hugo Cerezo', 'post author', '<p class=\"m_241386247923015020gmail-yiv5739441557msonormal\" style=\"box-sizing: inherit; margin: 0px 0px 15px; color: #5d5d5d; font-family: \'Open Sans\', sans-serif; font-size: 15px; background-color: #ffffff;\">Incorporated under the Company and Allied Matters Act of 1990 on February 16, 2016, Harmony Glass Factory Nigeria Limited (the company) is an ultra-modern float glass manufacturing company jointly owned by Harmony Business Associates (Nigeria) Limited (HBA), a company in technical partnership with China Triumph International Engineering Company Limited (CTIEC) (97.5%) and Ondo State Government (2.5%). To actualize the HGFL investment plan, HBA put together a&nbsp;well-structured project in terms of committed equity.</p>\r\n<p class=\"m_241386247923015020gmail-yiv5739441557msonormal\" style=\"box-sizing: inherit; margin: 0px 0px 15px; color: #5d5d5d; font-family: \'Open Sans\', sans-serif; font-size: 15px; background-color: #ffffff;\">The float glass company with a daily melting capacity of 500 metric tons upon commissioning shall produce various sizes and shades of float glass sheets to&nbsp;<span lang=\"RU\" style=\"box-sizing: inherit;\">GB 11614-2009</span><span lang=\"RU\" style=\"box-sizing: inherit;\">&nbsp;</span>standards for domestic, regional and international markets leveraging on the experience and global outreach of its core technical and commercial partners using CTIEC&rsquo;s complete set of mature core technology with unique characteristic and superior performance-price ratio.</p>', 'August 25, 2020 02:29:39 pm'),
(2, 'Zidane\'s comeback ', 'Sport', '98787.jpg', 'Page Financials', 'post', '<p class=\"m_241386247923015020gmail-yiv5739441557msonormal\" style=\"box-sizing: inherit; margin: 0px 0px 15px; color: #5d5d5d; font-family: \'Open Sans\', sans-serif; font-size: 15px; background-color: #ffffff;\">Incorporated under the Company and Allied Matters Act of 1990 on February 16, 2016, Harmony Glass Factory Nigeria Limited (the company) is an ultra-modern float glass manufacturing company jointly owned by Harmony Business Associates (Nigeria) Limited (HBA), a company in technical partnership with China Triumph International Engineering Company Limited (CTIEC) (97.5%) and Ondo State Government (2.5%). To actualize the HGFL investment plan, HBA put together a&nbsp;well-structured project in terms of committed equity.</p>\r\n<p class=\"m_241386247923015020gmail-yiv5739441557msonormal\" style=\"box-sizing: inherit; margin: 0px 0px 15px; color: #5d5d5d; font-family: \'Open Sans\', sans-serif; font-size: 15px; background-color: #ffffff;\">The float glass company with a daily melting capacity of 500 metric tons upon commissioning shall produce various sizes and shades of float glass sheets to&nbsp;<span lang=\"RU\" style=\"box-sizing: inherit;\">GB 11614-2009</span><span lang=\"RU\" style=\"box-sizing: inherit;\">&nbsp;</span>standards for domestic, regional and international markets leveraging on the experience and global outreach of its core technical and commercial partners using CTIEC&rsquo;s complete set of mature core technology with unique characteristic and superior performance-price ratio.</p>', 'August 25, 2020 02:29:59 pm'),
(3, 'Experts break down all the evidence and tally up the strongest points for and against impeaching the US President', 'News', '200368.jpg', 'Panos Kostopoulos', 'real madrid, hazard, Eden, madrid, sport, lastest', '<p class=\"m_241386247923015020gmail-yiv5739441557msonormal\" style=\"box-sizing: inherit; margin: 0px 0px 15px; color: #5d5d5d; font-family: \'Open Sans\', sans-serif; font-size: 15px; background-color: #ffffff;\">Incorporated under the Company and Allied Matters Act of 1990 on February 16, 2016, Harmony Glass Factory Nigeria Limited (the company) is an ultra-modern float glass manufacturing company jointly owned by Harmony Business Associates (Nigeria) Limited (HBA), a company in technical partnership with China Triumph International Engineering Company Limited (CTIEC) (97.5%) and Ondo State Government (2.5%). To actualize the HGFL investment plan, HBA put together a&nbsp;well-structured project in terms of committed equity.</p>\r\n<p class=\"m_241386247923015020gmail-yiv5739441557msonormal\" style=\"box-sizing: inherit; margin: 0px 0px 15px; color: #5d5d5d; font-family: \'Open Sans\', sans-serif; font-size: 15px; background-color: #ffffff;\">The float glass company with a daily melting capacity of 500 metric tons upon commissioning shall produce various sizes and shades of float glass sheets to&nbsp;<span lang=\"RU\" style=\"box-sizing: inherit;\">GB 11614-2009</span><span lang=\"RU\" style=\"box-sizing: inherit;\">&nbsp;</span>standards for domestic, regional and international markets leveraging on the experience and global outreach of its core technical and commercial partners using CTIEC&rsquo;s complete set of mature core technology with unique characteristic and superior performance-price ratio.</p>', 'August 25, 2020 02:30:23 pm'),
(4, 'New Era', 'Sport', '15982155936053.jpg', 'Ngozi Ikeaba', 'post', '<p><span class=\"capital-letter\">B</span>arcelona\'s club offices played host to a meeting between <strong>Jorge Messi and Josep Maria Bartomeu </strong>on Wednesday afternoon as discussions went on for two hours before coming to the conclusion that the Blaugrana will not negotiate for the sale of <strong>Lionel Messi</strong>.</p>\r\n<p>They have claimed that in public and internally and the player\'s position remains the same; that he wishes to leave the club, and so the chess game continues.</p>\r\n<p>The highly-anticipated meeting took place on the same day that Messi\'s father and representative arrived from Rosario and also saw <strong>Javier Bordas</strong>, a Barcelona director, and <strong>Rodrigo Messi</strong>, the player\'s brother and advisor, attend.</p>\r\n<p>The two parties are still some way away from any agreement despite the lengthy talks which were held.</p>\r\n<p>Despite that, the meeting was not a tense occasion and they will keep in touch with more talks a possibility in the near future.</p>\r\n<p><strong>Bartomeu </strong>insists that the release clause in the deal expires on June 10, meaning that <strong>Messi </strong>is under contract and should return to training, which he is yet to do.</p>\r\n<p>The club president also repeated that they would not negotiate the sale of Messi under any circumstance as he forms a key part of their sporting project and is under contract.</p>\r\n<p>From Messi\'s side, they point to the burofax which was sent making clear his desire to leave and taking advantage of the clause in spirit, allowing him to leave for free.</p>\r\n<p>When he arrived at the club\'s training ground, Jorge already made it clear that he would see it as \'very difficult\' for <strong>Lionel to stay at Barcelona</strong>.</p>\r\n<p>This means that there is no real movement in the situation with both sides remaining stubborn in their point of view.</p>\r\n<p>The next step could be that <strong>Messi </strong>comes out to speak publicly for the first time, or <strong>Barcelona </strong>could threaten to fine him if he continues to miss training.</p>\r\n<p>The most extreme possibility is that <strong>Messi departs Barcelona </strong>and leaves it up to the courts to decide, but that is unlikely given that neither Lionel nor the club are interested in the legal complications of such a decision.</p>\r\n<p>Eight days have now passed since the situation became clear when Messi sent a burofax to the club expressing his belief that he could leave, and since then he has not turned up to undergo tests or train.</p>\r\n<p>He remains consistent in his belief that the burofax was correct that he could leave for free and a judge would agree, but no club has been brave enough to enter this legal chaos despite interest from <strong>Manchester City and Paris Saint-Germain</strong>.</p>\r\n<p>At the Camp Nou, they felt that <strong>Bartomeu </strong>was the cause and he offered to resign if <strong>Messi </strong>stayed but their position has not changed beyond that, with a vote of no confidence from members underway.</p>\r\n<p>Right now, nobody can guess how this battle will end, but either way one side will have to back down.</p>', 'September 03, 2020 10:53:10 am'),
(5, 'Zidane\'s comeback ', 'Home', '15971727716680.jpg', 'Ngozi Ikeaba', 'real madrid, hazard, Eden, madrid, sport, lastest', '<p><span style=\"font-family: \'book antiqua\', palatino, serif;\"><span class=\"capital-letter\">B</span>arcelona\'s club offices played host to a meeting between <strong>Jorge Messi and Josep Maria Bartomeu </strong>on Wednesday afternoon as discussions went on for two hours before coming to the conclusion that the Blaugrana will not negotiate for the sale of <strong>Lionel Messi</strong>.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">They have claimed that in public and internally and the player\'s position remains the same; that he wishes to leave the club, and so the chess game continues.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">The highly-anticipated meeting took place on the same day that Messi\'s father and representative arrived from Rosario and also saw <strong>Javier Bordas</strong>, a Barcelona director, and <strong>Rodrigo Messi</strong>, the player\'s brother and advisor, attend.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">The two parties are still some way away from any agreement despite the lengthy talks which were held.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">Despite that, the meeting was not a tense occasion and they will keep in touch with more talks a possibility in the near future.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\"><strong>Bartomeu </strong>insists that the release clause in the deal expires on June 10, meaning that <strong>Messi </strong>is under contract and should return to training, which he is yet to do.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">The club president also repeated that they would not negotiate the sale of Messi under any circumstance as he forms a key part of their sporting project and is under contract.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">From Messi\'s side, they point to the burofax which was sent making clear his desire to leave and taking advantage of the clause in spirit, allowing him to leave for free.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">When he arrived at the club\'s training ground, Jorge already made it clear that he would see it as \'very difficult\' for <strong>Lionel to stay at Barcelona</strong>.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">This means that there is no real movement in the situation with both sides remaining stubborn in their point of view.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">The next step could be that <strong>Messi </strong>comes out to speak publicly for the first time, or <strong>Barcelona </strong>could threaten to fine him if he continues to miss training. </span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">The most extreme possibility is that <strong>Messi departs Barcelona </strong>and leaves it up to the courts to decide, but that is unlikely given that neither Lionel nor the club are interested in the legal complications of such a decision.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">Eight days have now passed since the situation became clear when Messi sent a burofax to the club expressing his belief that he could leave, and since then he has not turned up to undergo tests or train.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">He remains consistent in his belief that the burofax was correct that he could leave for free and a judge would agree, but no club has been brave enough to enter this legal chaos despite interest from <strong>Manchester City and Paris Saint-Germain</strong>.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">At the Camp Nou, they felt that <strong>Bartomeu </strong>was the cause and he offered to resign if <strong>Messi </strong>stayed but their position has not changed beyond that, with a vote of no confidence from members underway.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">Right now, nobody can guess how this battle will end, but either way one side will have to back down.</span></p>', 'September 03, 2020 10:58:59 am'),
(6, 'Experts break down all the evidence and tally up the strongest points for and against impeaching the US President', 'Sport', '98769.jpg', 'Hugo Cerezo', 'sport, lastest', '<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\"><span class=\"capital-letter\">B</span>arcelona\'s club offices played host to a meeting between <strong>Jorge Messi and Josep Maria Bartomeu </strong>on Wednesday afternoon as discussions went on for two hours before coming to the conclusion that the Blaugrana will not negotiate for the sale of <strong>Lionel Messi</strong>.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">They have claimed that in public and internally and the player\'s position remains the same; that he wishes to leave the club, and so the chess game continues.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">The highly-anticipated meeting took place on the same day that Messi\'s father and representative arrived from Rosario and also saw <strong>Javier Bordas</strong>, a Barcelona director, and <strong>Rodrigo Messi</strong>, the player\'s brother and advisor, attend.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">The two parties are still some way away from any agreement despite the lengthy talks which were held.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Despite that, the meeting was not a tense occasion and they will keep in touch with more talks a possibility in the near future.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\"><strong>Bartomeu </strong>insists that the release clause in the deal expires on June 10, meaning that <strong>Messi </strong>is under contract and should return to training, which he is yet to do.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">The club president also repeated that they would not negotiate the sale of Messi under any circumstance as he forms a key part of their sporting project and is under contract.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">From Messi\'s side, they point to the burofax which was sent making clear his desire to leave and taking advantage of the clause in spirit, allowing him to leave for free.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">When he arrived at the club\'s training ground, Jorge already made it clear that he would see it as \'very difficult\' for <strong>Lionel to stay at Barcelona</strong>.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">This means that there is no real movement in the situation with both sides remaining stubborn in their point of view.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">The next step could be that <strong>Messi </strong>comes out to speak publicly for the first time, or <strong>Barcelona </strong>could threaten to fine him if he continues to miss training. </span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">The most extreme possibility is that <strong>Messi departs Barcelona </strong>and leaves it up to the courts to decide, but that is unlikely given that neither Lionel nor the club are interested in the legal complications of such a decision.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Eight days have now passed since the situation became clear when Messi sent a burofax to the club expressing his belief that he could leave, and since then he has not turned up to undergo tests or train.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">He remains consistent in his belief that the burofax was correct that he could leave for free and a judge would agree, but no club has been brave enough to enter this legal chaos despite interest from <strong>Manchester City and Paris Saint-Germain</strong>.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">At the Camp Nou, they felt that <strong>Bartomeu </strong>was the cause and he offered to resign if <strong>Messi </strong>stayed but their position has not changed beyond that, with a vote of no confidence from members underway.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Right now, nobody can guess how this battle will end, but either way one side will have to back down.</span></p>', 'September 03, 2020 11:00:09 am');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign_Relation` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
