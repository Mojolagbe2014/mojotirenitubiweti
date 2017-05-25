-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 04:37 AM
-- Server version: 5.6.31
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `train2bewealthy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_registered` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `username`, `password`, `role`, `date_registered`) VALUES
(1, 'Mojolagbe Jamiu', 'mojolagbe@gmail.com', 'Babatunde', 'ae2b1fca515949e5d54fb22b8ed95575', 'Sub-Admin', '2015-08-20'),
(2, 'Administrator', 'admin@train2bewealthy.com', 'Admin', 'ae2b1fca515949e5d54fb22b8ed95575', 'Admin', '2015-11-23'),
(3, 'TIMCA', 'info4timca@gmail.com', 'TIMCA', 'ae2b1fca515949e5d54fb22b8ed95575', 'Sub-Admin', '2016-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL,
  `name` varchar(600) NOT NULL,
  `short_name` varchar(200) NOT NULL,
  `category` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `code` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `media` varchar(600) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_registered` date NOT NULL,
  `image` varchar(300) NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `currency` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `short_name`, `category`, `start_date`, `end_date`, `code`, `description`, `media`, `amount`, `status`, `date_registered`, `image`, `featured`, `currency`) VALUES
(1, 'The Joy of Business', 'Analysing Financial Statements', '1', '2016-04-19', '2016-04-21', '', '<p>Your Financial Analysis course takes you through the &ldquo;step-by-step&rdquo; of financial statements interpretation.</p>\r\n\r\n<p>Participants will gain clear insight into the techniques that investors, creditors, bankers and other analysts use to evaluate organisations. Using basic excel, participants will learn how to evaluate current operations as well as anticipate future corporate performance. Everyone on this programme will leave better equipped to make decisions that can positively impact the fortune of their organisation.</p>\r\n', '328121_.doc', '88509', 1, '2016-01-21', '307645_.png', 0, 'CAD'),
(2, 'Accessing Fifth Dimension', 'Banking Operations Course', '1', '2016-04-04', '2016-04-06', '', '<p>Your Financial Analysis course takes you through the &ldquo;step-by-step&rdquo; of financial statements interpretation.</p>\r\n\r\n<p>Participants will gain clear insight into the techniques that investors, creditors, bankers and other analysts use to evaluate organisations. Using basic excel, participants will learn how to evaluate current operations as well as anticipate future corporate performance. Everyone on this programme will leave better equipped to make decisions that can positively impact the fortune of their organisation.</p>\r\n', '555540_.pdf', '88500', 1, '2016-01-21', '236313_.png', 1, 'CAD'),
(12, 'When Love Hurts', '', '1', '0000-00-00', '0000-00-00', '', '<p>Your Financial Analysis course takes you through the &ldquo;step-by-step&rdquo; of financial statements interpretation.</p>\r\n\r\n<p>Participants will gain clear insight into the techniques that investors, creditors, bankers and other analysts use to evaluate organisations. Using basic excel, participants will learn how to evaluate current operations as well as anticipate future corporate performance. Everyone on this programme will leave better equipped to make decisions that can positively impact the fortune of their organisation.</p>\r\n', '946498_.docx', '10', 1, '2017-05-17', '121022_.png', 0, 'CAD'),
(13, 'The World of Happy Pear', '', '1', '0000-00-00', '0000-00-00', '', '<p>Your Financial Analysis course takes you through the &ldquo;step-by-step&rdquo; of financial statements interpretation.</p>\r\n\r\n<p>Participants will gain clear insight into the techniques that investors, creditors, bankers and other analysts use to evaluate organisations. Using basic excel, participants will learn how to evaluate current operations as well as anticipate future corporate performance. Everyone on this programme will leave better equipped to make decisions that can positively impact the fortune of their organisation.</p>\r\n', '197072_.pdf', '890', 1, '2017-05-17', '911752_.png', 0, 'CAD');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL,
  `name` varchar(600) NOT NULL,
  `short_name` varchar(200) NOT NULL,
  `category` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `code` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `media` varchar(600) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_registered` date NOT NULL,
  `image` varchar(300) NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `currency` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `short_name`, `category`, `start_date`, `end_date`, `code`, `description`, `media`, `amount`, `status`, `date_registered`, `image`, `featured`, `currency`) VALUES
(1, 'Analysing Financial Statement', 'Analysing Financial Statements', '1', '2016-04-19', '2016-04-21', '', '<p>Your Financial Analysis course takes you through the &ldquo;step-by-step&rdquo; of financial statements interpretation.</p>\r\n\r\n<p>Participants will gain clear insight into the techniques that investors, creditors, bankers and other analysts use to evaluate organisations. Using basic excel, participants will learn how to evaluate current operations as well as anticipate future corporate performance. Everyone on this programme will leave better equipped to make decisions that can positively impact the fortune of their organisation</p>\r\n\r\n<p><strong>LEARNING OBJECTIVES:</strong></p>\r\n\r\n<p>Participants will:</p>\r\n\r\n<p>&bull; Possess deeper understanding of the relationships among the three major financial statements</p>\r\n\r\n<p>&bull; Understand how business decisions affect interrelationship among items of the statement</p>\r\n\r\n<p>&bull; Identify business operations which drives movements in financial statements</p>\r\n\r\n<p>&bull; Apply financial ratios to analyze trends, competitors, and future economic decisions</p>\r\n\r\n<p>&bull; Utilize spread sheet tols and techniques in analyzing financial statements</p>\r\n\r\n<p><strong>LEARNING CONTENTS:</strong></p>\r\n\r\n<p>&bull; The Financial statements</p>\r\n\r\n<p>&bull; Profit and cash flow statements</p>\r\n\r\n<p>&bull; Ratio analysis</p>\r\n\r\n<p>&bull; Interpretation of accounts</p>\r\n\r\n<p>&bull; Addressing potential problems revealed in financial statements</p>\r\n\r\n<p>&bull; Benchmarking business performance</p>\r\n\r\n<p>&bull; Financial information databases</p>\r\n\r\n<p>&bull; Budgets and forecasts</p>\r\n\r\n<p>&bull; The lenders perspectives of financial statements</p>\r\n\r\n<p>&bull; Applying spreadsheets in comparisons of divisions, business units and entire companies</p>\r\n', '328121_.doc', '88509', 1, '2016-01-21', '776512_.jpg', 0, 'CAD'),
(2, 'Banking Operations Course', 'Banking Operations Course', '1', '2016-04-04', '2016-04-06', '', '<p>Understanding banking operations is a key requirement for all entry level staff of financial institutions.</p>\r\n\r\n<p>This course on basic banking operations has been designed to provide participants with the knowledge and skills required for effectively processing banking transactions. They will also learn the control measures in order to eliminate losses.</p>\r\n\r\n<p><strong>LEARNING OBJECTIVES:</strong></p>\r\n\r\n<p>Participants will:</p>\r\n\r\n<p>&bull; Understand the intermediation roles of banks and other financial institutions</p>\r\n\r\n<p>&bull; Understand banking operations terminologies to build self confidence and professionalism</p>\r\n\r\n<p>&bull; Process banking transactions without errors and losses</p>\r\n\r\n<p>&bull; Understand the various banking products - their features and benefits to customers</p>\r\n\r\n<p>&bull; Understand banking operations control systems</p>\r\n\r\n<p>&bull; Appreciate their roles in working with other departments of the organisation for effective customer service delivery</p>\r\n\r\n<p><strong>LEARNING CONTENTS:</strong></p>\r\n\r\n<p>&bull; The business of banking</p>\r\n\r\n<p>&bull; Accounts opening functions</p>\r\n\r\n<p>&bull; Basic accounting for cash operations</p>\r\n\r\n<p>&bull; Cash and teller operations</p>\r\n\r\n<p>&bull; Money market products and processing</p>\r\n\r\n<p>&bull; CBN clearing and clearing regulations</p>\r\n\r\n<p>&bull; Income and expenses processing</p>\r\n\r\n<p>&bull; Government revenue collection services</p>\r\n\r\n<p>&bull; Introduction to international trade; Bills for collection, and letters of credit</p>\r\n\r\n<p>&bull; Computer operations in banking services</p>\r\n\r\n<p>&bull; Anti money laundering and know your customer</p>\r\n', '555540_.pdf', '88500', 0, '2016-01-21', '233736_.jpg', 1, 'CAD'),
(12, 'Business Strategy', '', '1', '0000-00-00', '0000-00-00', '', 'Business StrategyBusiness StrategyBusiness StrategyBusiness StrategyBusiness StrategyBusiness StrategyBusiness Strategy', '946498_.docx', '10', 1, '2017-05-17', '291815_.jpg', 0, 'CAD');

-- --------------------------------------------------------

--
-- Table structure for table `course_brochure`
--

CREATE TABLE IF NOT EXISTS `course_brochure` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `document` varchar(900) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_brochure`
--

INSERT INTO `course_brochure` (`id`, `name`, `document`) VALUES
(1, '2015 Open Programme Guide', '382596_2015_open_programme_guide.pdf'),
(2, 'Christlink Tester', '474826_christlink.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL,
  `date_time` varchar(300) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `description`, `location`, `image`, `date_time`, `status`, `date_added`) VALUES
(1, 'Website Launch', '<p><span style="color:rgb(92, 101, 102); font-family:open sans; font-size:14px">The website was redesigned by <a href="http://kaisteventures.com">Kaiste Ventures Limited.</a></span></p>\r\n', 'Ketu, Lagos, Nigeria', '574060_website_launch.jpg', '2016/03/25 20:00', 1, '2015-11-13 13:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(700) NOT NULL,
  `answer` text NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `date_added`) VALUES
(1, 'What happens if I am unable to attend a course and I have already paid?', 'Your payment will be withhold until you attend a course of the same amount.', '2016-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(300) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`, `status`, `date_added`) VALUES
(1, 'Why the need for Financial Seminars?', '<div>These news paper articles show&nbsp;that most Canadians are living from pay-cheque to pay-cheque! Unfortunately, most of them are unable to dig themselves of this huge burden and continually see the entire family undergo a great amount of stress etc. &ndash; which can lead to children straying into drugs/alcohol; parents ending in divorce etc.<br />\r\n&nbsp;</div>\r\n\r\n<div style="text-align: center;"><span style="color:#FF0000;"><strong>FUNDAMENTAL TRUTH:&nbsp;</strong></span></div>\r\n\r\n<div style="text-align: center;"><span style="color:#FF0000;">Every member of a family MUST have a solid work ethic.</span></div>\r\n\r\n<div style="text-align: center;"><span style="color:#FF0000;"><em>&ldquo;Diligent hands will rule, but laziness ends in forced labor.&rdquo; (Proverbs 12:24)</em></span><br />\r\n&nbsp;</div>\r\n', '121825_why_the_need_for_financial_seminars.png', 1, '2016-09-01 00:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_record`
--

CREATE TABLE IF NOT EXISTS `purchase_record` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(110) NOT NULL,
  `course` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `currency` varchar(25) NOT NULL,
  `method` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL,
  `date_purchased` varchar(100) NOT NULL,
  `item_type` varchar(90) NOT NULL,
  `mode` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_record`
--

INSERT INTO `purchase_record` (`id`, `transaction_id`, `course`, `user`, `amount`, `currency`, `method`, `state`, `date_purchased`, `item_type`, `mode`) VALUES
(1, 'PAY-4C980664G9746924VKYN4YVY', 27, 2, '70', 'GBP', 'Mobile Payment', 0, '2015-10-12T15:05:59Z', 'course', 'full'),
(2, 'PAY-6EE27081H00589237KYN5TGA', 1, 5, '299', 'GBP', 'Mobile Payment', 0, '2015-10-12T16:02:32Z', 'category', 'full'),
(3, 'PAY-5VR872536N509570NKYN5XXY', 2, 2, '299', 'GBP', 'Mobile Payment', 0, '2015-10-12T16:12:15Z', 'category', 'full'),
(4, 'PAY-34M64771TN704364FKYOEPFY', 28, 2, '1', 'GBP', 'Mobile Payment', 0, '2015-10-12T23:51:51Z', 'course', 'full'),
(10, 'YHD98432', 1, 3, '900', 'NGN', 'Manual Log', 0, '2015/11/09 15:15', 'category', 'installment'),
(11, 'YHD9843289', 2, 3, '900', 'NGN', 'Manual Log', 0, '2015/11/16 11:02', 'category', 'full'),
(12, 'YHD9843288', 2, 3, '900', 'NGN', 'Manual Log', 0, '2015/11/10 11:04', 'course', 'full'),
(13, 'HJ2342342', 3, 3, '900', 'NGN', 'Manual Log', 0, '2015/11/09 15:15', 'category', 'full'),
(14, 'YHJ2342342', 1, 3, '900', 'NGN', 'Manual Log', 0, '2015/11/30 11:07', 'category', 'installment');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `name` varchar(200) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`name`, `value`) VALUES
('ABOUT_US', 'In one sentence - we&nbsp;<span class="h2-red">TEACH</span>...<span class="h2-red">TRAIN</span>...<span class="h2-red">COACH</span>&nbsp;individuals &amp; families to learn to invest directly in the Toronto Stock Exchange i.e. directly buy and sell shares<br />\r\n(known as Self-Directed Investors)'),
('ADDTHIS_SHARE_BUTTON', '<!-- Go to www.addthis.com/dashboard to customize your tools -->\r\n<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56a5fbdb49cbb5db" async="async"></script>\r\n'),
('ANALYTICS', '<script></script>'),
('BOOKS_PER_PAGE', '4'),
('COMPANY_ADDRESS', '<p><span style="background-color:rgb(255, 255, 255); color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">1-1660 Kenaston Blvd. Unit 70037 Winnipeg MB R3P 2H3 Canada</span></p>\r\n'),
('COMPANY_ADDRESS_GMAP', '<p><span style="background-color:rgb(255, 255, 255); color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">1-1660 Kenaston Blvd. Unit 70037 Winnipeg MB R3P 2H3 Canada</span></p>\r\n'),
('COMPANY_EMAIL', '<p><span style="background-color:rgb(255, 255, 255); color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">admin@train2bewealthy.com</span></p>\r\n'),
('COMPANY_FAX', '<p><span style="color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">204-414-9164</span></p>\r\n'),
('COMPANY_HOTLINE', '<p><span style="color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">+1 204-414-9106</span></p>\r\n'),
('COMPANY_NAME', '<p>Train2BeWealthy</p>\r\n'),
('COMPANY_NUMBERS', '<p><span style="color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">204-414-9106</span></p>\r\n'),
('COMPANY_OTHER_EMAILS', '<p><span style="background-color:rgb(245, 245, 245); font-family:open sans,sans-serif; font-size:12px">chandran@mymts.net</span></p>\r\n'),
('CONTACT_US_VIDEO_HEIGHT', '<p>400</p>\r\n'),
('CONTACT_US_VIDEO_WIDTH', '<p>200</p>\r\n'),
('DRIBBBLE_LINK', '<p>https://dribbble.com/</p>\r\n'),
('FACEBOOK_ADMINS', '<p>0</p>\r\n'),
('FACEBOOK_APP_ID', '<p>0</p>\r\n'),
('FACEBOOK_LINK', '<p>https://www.facebook.com/financialexcellence2017/</p>\r\n'),
('GOOGLEPLUS_LINK', '<p>https://www.plus.google.com/</p>\r\n'),
('LINKEDIN_LINK', '<p>https://www.linkedin.com/</p>\r\n'),
('PINTEREST_LINK', '<p>https://www.pinterest.com/</p>\r\n'),
('THE_PROGRAM', '<p class="section-title wow fadeInDown"><span style="color:#0000FF;">The majority of such seminars put a <strong>&lsquo;BURDEN&rsquo; </strong>on the individual or family.</span> <span style="color:#FF0000;">What we call these seminars the <strong>&ldquo;Nickel &amp; Dime&rdquo;</strong> strategy.</span><br />\n&nbsp;<br />\nBasically, there is an attempt at &lsquo;Behavior Modification&rsquo; i.e. you are to CUT costs to a bare minimum that at the end of the day, you are to make such sacrifices that it would appear that your lifestyle will just be one step above the homeless!<br />\n&nbsp;<br />\nExample:<br />\n<em>How To Live The Good Life On A Shoestring Budget</em><br />\n<em>I have learned that you can live a healthy and posh lifestyle on a shoestring budget. You just need to be smart with the resources you have. A little humility goes a long way, too.</em><br />\n&nbsp;<br />\n<strong><em>Below are my top 9 tips to live well on a shoestring budget:</em></strong><br />\n&nbsp;<br />\n<strong><em>1. Find a financial plan that works for you and stick to it.</em></strong><br />\n<em>I&#39;ve followed&nbsp;Dave Ramsey&#39;s financial budgeting plan&nbsp;for the past 15 years actually. It&#39;s a 7-Step Plan that helps you save, budget, eliminate all debt and create a financial life that equates to financial stability regardless of your salary. It&#39;s clear, simple, and the steps are followed in order, it allows you to live well on any budget.</em><br />\n&nbsp;<br />\n<strong><em>2. Negotiate at the farmer&#39;s market.</em></strong><br />\n<em>You can eat&nbsp;organic produce&nbsp;and other healthy foods on a shoestring budget! Promise! If you&#39;re near any farmer&#39;s markets, stroll in toward the end of the day when they&#39;re packing up. Tell them you have a small budget, but it&#39;s important to you that you nourish your body with organic greens and fruits. And then ask them if they&#39;d be willing to sell any of what&#39;s left over at a negotiated rate. It&#39;s worked for me.</em><br />\n&nbsp;<br />\n<strong><em>3. Learn how to eat well on a budget.</em></strong><br />\n<em>Another resource I found to be helpful was&nbsp;Eco-Vegan Gal. In a series of short, internet videos, she explains how to eat easy, cheap and healthy vegan meals. I followed her tips and have found that I now eat better on a budget (less than $250/month) that I did when I had an unlimited budget. Other resources I like include&nbsp;Balanced Babe, articles that I found along the way&nbsp;like this one</em><a href="http://www.huffingtonpost.com/l-susan-zhang/5-ways-to-eat-healthy-on-a-budget_b_4855317.html," target="_blank"><em>,</em></a><em>&nbsp;and simply having conversations with plant-based food bloggers to brainstorm how to eat on a budget.</em><br />\n&nbsp;<br />\n<strong><em>4. Find ways to exercise and relax in nature.</em></strong><br />\n<em>Do you live near hiking trails or a beach? Grab your loved ones and spend a day hiking or lying on the sand reading a great book. If you want to have a romantic evening with your special someone, purchase an inexpensive bottle of wine. Grab a blanket and go sit at your favorite park to sip and chat. If you have a bike, you can cycle for miles to explore new neighborhoods.</em><br />\n&nbsp;<br />\n<strong><em>5. Join meetup groups!</em></strong><br />\n<em>They often host free events where you can mingle and have a blast! You can go to&nbsp;MeetUp.com&nbsp;and browse any activity that you like! I also did a very simple google search of &quot;Free Events in Chicago&quot; and turned up a treasure trove of fun things like group picnics in the park, 5K runs without a sign-up fee and amazing book clubs. You can still enjoy your surroundings without spending a penny!</em><br />\n&nbsp;<br />\n<strong><em>6. Let your friends know about your new financial limits.</em></strong><br />\n<em>If you can afford to go to restaurants, order an appetizer or split an entree with a friend who you&#39;ve already informed of your budget. It&#39;s a lot cheaper than getting your own meal. When you travel, stay with friends instead of shelling out for a hotel room.</em><br />\n&nbsp;<br />\n<strong><em>7. Shop at thrift stores or high-end clothing swaps.</em></strong><br />\n<em>You can look the part without paying for it! Shop at outlet stores or consignment shops. Another tip: wait until the end of each season, when the sales are out of this world! Learn to live with a few quality basics in your wardrobe that you can transition from day to night with a simple accessory or even makeup change.</em><br />\n&nbsp;<br />\n<strong><em>8. Focus on accessorizing rather than buying new outfits.</em></strong><br />\n<em>You&#39;d be amazed what a brightly-hued scarf can do for a basic t-shirt and skirt.</em><br />\n&nbsp;<br />\n<strong><em>9. Work hard.</em></strong><br />\n<em>I have humbled myself in ways that have shocked even me. And you know what? It feels really good. If your budget is not providing the lifestyle you want, consider projects for people in your community. You can tell them that you have a small budget and would love some extra &quot;shoe money.&quot; Offer to babysit, dog walk, organize closets, clean their home, etc. And lastly, if this is option is available to you, try to get a better-paying job. </em><br />\n&nbsp;<br />\n<em>There are countless ways to live a healthy and amazing lifestyle on a small budget! Give them a try and what you might find is that your life is much richer then when you had an abundance of money.</em> [REALLY?]<br />\n&nbsp;<br />\n<strong><span style="color:#FF0000;">READ THE ABOVE CAREFULLY &amp; YOU MIGHT AS WELL LIVE WITH THE VINOS IN A ROOMING HOUSE! </span><span style="color:#0000FF;">THIS JUST DOES NOT WORK!</span></strong><br />\nIt&rsquo;s not about &lsquo;BEHAVIOR MODIFICATION&rsquo;.<br />\n&nbsp;<br />\nIt&rsquo;s a about a &ldquo;MIND-SET&rdquo; that creates what we call &lsquo;STINKING THINKING&rdquo;!<br />\n&nbsp;<br />\nWhat causes people to become &ldquo;wage slaves&rdquo;?&nbsp;&nbsp;<br />\n<br />\nTRADITION!<br />\n<a href="https://www.youtube.com/watch?v=kDtabTufxao">https://www.youtube.com/watch?v=kDtabTufxao</a><br />\n&nbsp; &nbsp;&nbsp;</p>\n\n<p class="section-title wow fadeInDown" style="text-align: center;"><img alt="" src="http://train2bwealthy.com/media/gallery/chain.png" /><br />\n<img alt="" src="http://train2bwealthy.com/media/gallery/item1.png" style="width: 895px; height: 668px;" /><br />\n<img alt="" src="http://train2bwealthy.com/media/gallery/item2.png" style="width: 913px; height: 564px;" /></p>\n\n<p class="section-title wow fadeInDown">Why are some people wealthy?</p>\n\n<ol>\n	<li>Were they born into a wealthy family (silver spoon)?</li>\n	<li>Were they super intelligent (Einstein)?</li>\n	<li>Were they just plain lucky (649 winner)?</li>\n	<li>Were they selling drugs (Hell Angels member)?</li>\n</ol>\nWhile its true that some have become wealthy by some of the above reasons BUT these represent a very small portion of the wealthy. The majority of those who become wealthy have some special things going for them.<br />\n<br />\nThe wealthy have been <u>TRAINED</u> to\n\n<ol>\n	<li>Have a <strong>DISCIPLINED MIND</strong> &ndash; they excel in EDUCATIONAL pursuits i.e. most have higher degrees</li>\n	<li>Have a <strong>SOLID WORK ETHIC</strong> &ndash; they sacrifice instant gratification for future benefits i.e. they treat life like a business.</li>\n	<li>Have a <strong>MIND-SET</strong> that focuses on building wealth &ndash; they have a game plan of saving and investing i.e. ensuring that their money works for them</li>\n</ol>\nThomas J Stanley who wrote about the &ldquo;MILLIONAIRE&rsquo;s MIND&rdquo; makes the following statement:<br />\n&nbsp;<br />\n<em>&ldquo;Based on in-depth interviews with numerous MILLIONAIRES, the study found that the following factors were vital to their financial successes:</em>\n\n<ul style="list-style-type: circle; margin-left: 40px;">\n	<li><em>INTERGRITY &ndash; honesty in all relationships</em></li>\n	<li><em>DISCIPLINE &ndash; self-control in every area of your life</em></li>\n	<li><em>SOCIAL SKILLS &ndash; friendly relationship will people</em></li>\n	<li><em>HARD WORK &ndash; a willingness to work harder than most people</em></li>\n	<li><em>SPOUSE &ndash; a supportive spouse &ldquo;</em></li>\n</ul>\n&nbsp;<br />\nNOTE: The FIRST FOUR are dependent on you i.e. you have some control over them BUT you may not have control over the fifth &ndash; the spouse!<br />\n&nbsp;<br />\nTHIS SEMINAR WILL TEACH YOU 2 THINGS:\n<ol style="list-style-type:upper-roman;">\n	<li>TO THINK LIKE THE WEALTHY!</li>\n	<li>PROVIDES &ldquo;BUSINESS OPPORTUNITIES&rdquo; WITH DO NOT REQUIRE:</li>\n</ol>\n\n<ol style="list-style-type: lower-alpha; margin-left: 240px;">\n	<li>Huge CAPITAL infusion and/or</li>\n	<li>Massive TIME consumption</li>\n</ol>\n'),
('TOTAL_DISPLAYABLE_TESTIMONIAL', '2'),
('TWITTER_ID', '<p>0</p>\r\n'),
('WELCOME_CONTENT_1', 'As soon as<span style="color:#FF0000;"> INCOME = EXPENDITURE</span>, the individual (or family) is headed for <span style="color:#FF0000;">BANKRUPTCY!</span> <em><span style="color:#0000FF;">They are ONE crisis away from disaster.&nbsp;</span></em><br>\r\n&nbsp;'),
('WELCOME_CONTENT_2', 'At this point, <span style="color:#FF0000;">FEAR RULES </span>&amp; all other options are blinded.&nbsp;They are stuck in a job where they will put up with all kinds of situations â€“ possible abusive bosses; working late hours without additional pay; taking on extra work loads aimed at pleasing the boss/employer (hoping they will be looked on favourably if a slow down occurs). Etc.&nbsp;<br>\r\nHowever, there some people â€“ despite their financial condition â€“ tend to keep their jobs for a number of reasons e.g for the. job-title (Vice-President); the job dfescrition defines them (Auditor) etc.&nbsp;Low self-steem!<br>\r\n&nbsp;'),
('WELCOME_CONTENT_3', 'At this point, <span style="color:#FF0000;">FEAR RULES </span>&amp; all other options are blinded.&nbsp;They are stuck in a job where they will put up with all kinds of situations â€“ possible abusive bosses; working late hours without additional pay; taking on extra work loads aimed at pleasing the boss/employer (hoping they will be looked on favourably if a slow down occurs). Etc.&nbsp;<br>\r\nHowever, there some people â€“ despite their financial condition â€“ tend to keep their jobs for a number of reasons e.g for the. job-title (Vice-President); the job dfescrition defines them (Auditor) etc.&nbsp;Low self-steem!<br>\r\n&nbsp;'),
('WELCOME_CONTENT_4', '<span style="color:#0000FF;">TRAIN2B</span><span style="color:#FF0000;">WEALTHY</span> has put together a program called FINANCIAL EXCELLENCE seminars to assist individuals/families to get out of the Salary Salve Syndrome by:\r\n<ul style="list-style-type:circle;">\r\n	<li>Creating additional Cash Flow AND</li>\r\n	<li>Building Long-Term Wealth</li>\r\n</ul>\r\n<br>\r\nFor details CLICK on THE PROGRAM tab<br>\r\n&nbsp;'),
('WELCOME_MENU_1', 'Truth'),
('WELCOME_MENU_2', 'Result'),
('WELCOME_MENU_3', 'Debt'),
('WELCOME_MENU_4', 'Solution'),
('WELCOME_MESSAGE', '<div><span style="font-size:16px;"><strong>FACT:</strong></span> The majority of Canadians are living from pay-check to pay-check!<br />\r\n<br />\r\n<span style="font-size:16px;"><strong>REASON</strong>: </span>A MIND-SET called &nbsp;&quot;<span style="color:#FF0000;">The </span><span style="color:#0000FF;">S</span><span style="color:#FF0000;">alary </span><span style="color:#0000FF;">S</span><span style="color:#FF0000;">lave </span><span style="color:#0000FF;">S</span><span style="color:#FF0000;">yndrome&quot;.<br />\r\n&nbsp;</span><br />\r\n<strong><span style="color:#0000CD;">MONEY</span> is a <span style="color:#FF0000;">TOOL</span>, a <span style="color:#FF0000;">TRIAL</span> and a <span style="color:#FF0000;">TEST</span>.</strong><br />\r\n<br />\r\nTo expose a person&rsquo;s true character, give them access to large sums of money. <span style="color:#FF0000;">Money reveals the heart and the quality of character.</span><br />\r\nHOWEVER, money is a necessity -&nbsp; it is necessary for life and required for living.<br />\r\n<br />\r\nMoney explains everything:<br />\r\n&nbsp;</div>\r\n\r\n<ul style="list-style-type: circle; margin-left: 40px;">\r\n	<li>The POOR want it.</li>\r\n	<li>The RICH horde it.</li>\r\n	<li>It controls those who cannot control it.</li>\r\n	<li>It destroys those who love it.</li>\r\n	<li>The average man works for it.</li>\r\n	<li>The Wise man makes it work for him.</li>\r\n</ul>\r\n\r\n<div>&nbsp;<br />\r\nAll human beings have a unique set of principles they live by and that is why money means different things to different people.<br />\r\n<br />\r\n<em><span style="color:#0000CD;">Money takes on what ever significance you give it</span>.</em><br />\r\n<br />\r\nTaking the time to identify your values will help you understand what is actually important about money to you.&nbsp; Because you are a creature of emotion, what you do is an extension what is important to you &ndash; <span style="color:#FF0000;">the heart of every matter is the heart of the matter</span> &ndash; <span style="color:#FF0000;"><em>For out of the abundance of his heart, his mouth speaks: King Solomon.</em></span><br />\r\n<br />\r\nNot two persons are exactly alike. Neither are the principles they choose to live by. But all live from the heart. This is precisely why you must take time to understand what is most important to you about money.<br />\r\n<br />\r\nWealth isn&rsquo;t about money only. Wealth is a <span style="color:#FF0000;">GIFT</span> &ndash; you should safeguard it; nurture it; and share it productively. Everyone and each family has its own beliefs and unique circumstances relating to wealth management.<br />\r\n<br />\r\nWhat is the &lsquo;<span style="color:#FF0000;">S</span>alary <span style="color:#FF0000;">S</span>lave <span style="color:#FF0000;">S</span>yndrome&rsquo;?&nbsp;<br />\r\n&nbsp;<br />\r\n<span style="color:#FF0000;">A SLAVE TO WAGES!</span><br />\r\n<br />\r\nThe gist of this phenomena is that an individual (or both spouses) get to a point in their life where <span style="color:#0000FF;"><u><em>IF THEY DO NOT</em></u></span> receive the income that they currently are getting - they will end up in BANKRUPTCY!&nbsp;</div>\r\n'),
('YOUTUBE_LINK', '<p>https://www.youtube.com/</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(400) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(300) NOT NULL,
  `orders` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `content`, `image`, `orders`, `status`) VALUES
(1, 'Attend our FINANCIAL EXCELLENCE SEMINARS', 'You have the POWER <strong>Power</strong>  To Prosper', '', 1, 1),
(2, 'Destroying DEBT through Financial Excellence', 'Teach a man to fish &amp; he will become an independent contributing citizen!', '', 2, 1),
(3, 'Money is a TOOL, a TRIAL and a TEST', 'A paradigm shift - reset the Salary Slave Syndrome Mind-set!', '', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE IF NOT EXISTS `testimonial` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(500) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `content`, `author`, `image`) VALUES
(1, 'I generated $ 5,315.75 in gains on the two stocksthis month [January 2015] or about 6.5%! I do rely on your support and your information. It gives me confidence and keeps me grounded. I''m sitting with cash and some shares which are paying good dividends and I do not mind sitting on them. All in all, I am set to beat last year''s return of 53%. Thank you very much.', 'JW, Thunder Bay, ONT', ''),
(2, 'Quite an outstanding experience. I had no knowledge of stock trading and was very fearful. They were very, very patient with me and hand held me until my first few trades. I continue to subscribe to their extended support membership after the initial Couse as find great help in their RTMA sessions. For example, I bought SW at $ 43 and sold for $ 47 within 10 days! Take the course, you won''t regret it.', 'E.R. Selkirk, MB', ''),
(3, 'We as a family have been clients since 2006 and I have learnt so much it is quite unbelievable that my husband & I have been so successful. For example, I was taught to trade ENB and this month I made more than $50,000 when it took a spike to $65 per share. Our children have really benefitted from this program and I am sure that when they have saved enough they will do well. I highly recommend them.', 'L.S., Portage la Prairie, MB', ''),
(4, 'Personal Experience\r\nGoal was to have the course paid for by Christmas of this year [2007]. This has happened. Goal is to have made 30% compounded in the first year. At this moment it is at 21.3%. Extrapolation is dangerous, but this equates to over 40% on an annual basis. Goal was to have at least 90% profitable trades. This is at 96% at the moment [98 of 102 trades].Thank you, Jonathan. Thank you Train2Invest!', 'G.L. Steinbach, MB', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `book` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `category` int(11) NOT NULL,
  `date_purchased` date NOT NULL,
  `card_holder` varchar(100) NOT NULL,
  `card_number` varchar(40) NOT NULL,
  `expiry_date` varchar(10) NOT NULL,
  `card_cvc` int(11) NOT NULL,
  `buyer_name` varchar(160) NOT NULL,
  `buyer_email` varchar(200) NOT NULL,
  `buyer_phone` varchar(15) NOT NULL,
  `buyer_address` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `transaction_id`, `book`, `units`, `amount`, `currency`, `category`, `date_purchased`, `card_holder`, `card_number`, `expiry_date`, `card_cvc`, `buyer_name`, `buyer_email`, `buyer_phone`, `buyer_address`, `status`) VALUES
(1, 'PAY879373773737', 1, 1, 100, 'CAD', 1, '2017-05-26', 'Terms Prldd', '8948847487474', '11/22', 336, 'JAMIU MOJOLAGBE', 'mojolagbe@gmail.com', '204 848498383', '67 Chancellor Cir, Winnipeg, Manitoba, Canada', 0),
(2, 'PAY-568229930', 2, 1, 88500, 'CAD', 1, '2017-05-24', 'Jamiu', '1222222', '12/23', 132, 'Jamiu', 'mojolagbe@gmail.com', '2048697315', '125 Augusta Dr', 0),
(3, 'PAY-641914993', 1, 1, 88509, 'CAD', 1, '2017-05-24', 'Jamiu', '12', '12/12', 234, 'Jamiu', 'mojolagm@myumanitoba.ca', '2048697315', '125 Augusta Dr', 0),
(4, 'PAY-574049830', 12, 1, 10, 'CAD', 1, '2017-05-24', 'Jamiu', '133333333', '12/23', 332, 'Jamiu', 'mojolagbe@gmail.com', '2048697315', '125 Augusta Dr', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL,
  `company` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `company`) VALUES
(1, 'Jamiu Mojolagbe', 'mojolagbe@gmail.com', ''),
(2, 'Jonathan Chandran', 'jchandran@train2invest.com', ''),
(3, 'Len furlong', 'Ljpp_44@hotmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `video` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `name`, `description`, `video`) VALUES
(1, 'HOME_VIDEO_ONE', 'Home page video one', '842099_home_video_one.mp4'),
(2, 'HOME_VIDEO_TWO', 'Home page video two', '798566_home_video_two.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `webpage`
--

CREATE TABLE IF NOT EXISTS `webpage` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(700) NOT NULL,
  `keywords` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webpage`
--

INSERT INTO `webpage` (`id`, `name`, `title`, `description`, `keywords`) VALUES
(1, 'home', 'Home', 'We are attempting to transform Canadian families in the arena of wealth building and more importantly wealth management', 'wealth, building, train, management, transform');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `evt_st_dat_end_dat` (`name`,`start_date`,`end_date`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `evt_st_dat_end_dat` (`name`,`start_date`,`end_date`);

--
-- Indexes for table `course_brochure`
--
ALTER TABLE `course_brochure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `question` (`question`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_record`
--
ALTER TABLE `purchase_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `webpage`
--
ALTER TABLE `webpage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `course_brochure`
--
ALTER TABLE `course_brochure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase_record`
--
ALTER TABLE `purchase_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `webpage`
--
ALTER TABLE `webpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
