-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2016 at 02:42 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traintoinvest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_registered` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `username`, `password`, `role`, `date_registered`) VALUES
(1, 'Mojolagbe Jamiu', 'mojolagbe@gmail.com', 'Babatunde', 'ae2b1fca515949e5d54fb22b8ed95575', 'Sub-Admin', '2015-08-20'),
(2, 'Administrator', 'admin@train2invest.com', 'Admin', 'ae2b1fca515949e5d54fb22b8ed95575', 'Admin', '2015-11-23'),
(3, 'TIMCA', 'info4timca@gmail.com', 'TIMCA', 'ae2b1fca515949e5d54fb22b8ed95575', 'Sub-Admin', '2016-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `course_brochure`
--

DROP TABLE IF EXISTS `course_brochure`;
CREATE TABLE IF NOT EXISTS `course_brochure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `document` varchar(900) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
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

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL,
  `date_time` varchar(300) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
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

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(700) NOT NULL,
  `answer` text NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `question` (`question`)
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

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(300) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`, `status`, `date_added`) VALUES
(1, 'Nigerians students studying in Malaysia envoy', 'Al Jazeera English released its first Facebook Messenger Bot today. It took us two weeks to build it. This includes researching the current news bots, gathering requirements, develop the bot, and performing some user testing.<br />\r\nThe development team was Omran Abazid and Alaa Batayneh.<br />\r\nThe idea behind the bot is simple, in a nutshell, we deliver the right news at the right time by allowing users to choose the type of news they are interested in. Users can decide how often they want to receive breaking news articles, when to receive them, and when to stop receiving them.<br />\r\nFrom the beginning we decided to integrate Facebook&rsquo;s Instant Articles into the bot in order to keep it modular.', '484659_nigerians_students_studying_in_malaysia_envoy.jpg', 1, '2016-09-01 00:08:21'),
(2, 'Independence anniversary of Malaysia', '<p><span style="color: rgb(29, 33, 41); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">Saudi Arabia is intensifying efforts to shrink the highest budget deficit among the world&rsquo;s biggest 20 economies, aiming to cancel more than $20 billion of projects and slash ministry budgets by a quarter, people familiar with the matter said.</span><br style="line-height: 20.8px;" />\r\n<br style="color: rgb(29, 33, 41); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;" />\r\n<span style="color: rgb(29, 33, 41); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">The government is reviewing thousands of projects valued at about 260 billion riyals ($69 billion) and may cancel a third of them, three people said, asking not to be identified as the discussions are private. The measures would impact the budget for several years, according to two of the people.<br />\r\n<br />\r\nRead more:&nbsp;</span><br />\r\n<span style="line-height: 20.8px;">http://www.bloomberg.com/news/articles/2016-09-06/saudi-arabia-said-to-weigh-canceling-20-billion-of-projects</span><br />\r\n<span style="background-color:rgb(241, 241, 241); color:rgb(13, 13, 13); font-family:quattrocento sans,sans-serif; font-size:15px"><img alt="" src="http://localhost/mojotirenitoinfesiti/media/gallery/1.png" style="width: 157px; height: 103px;" /></span><br />\r\n<br />\r\n<span style="background-color:rgb(241, 241, 241); color:rgb(13, 13, 13); font-family:quattrocento sans,sans-serif; font-size:15px">Read more at: http://www.vanguardngr.com/2016/08/13000-nigerians-students-studying-malaysia-envoy/</span></p>\r\n', '762503_independence_anniversary_of_malaysia.png', 1, '2016-09-01 00:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `name` varchar(200) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`name`, `value`) VALUES
('ABOUT_US_CONTENT', '<div class="col-lg-6"><strong class="strong-logo ">TRAIN<strong class="h2-red">2</strong>INVEST INC.</strong><span> is a privately-owned Canadian-based investment education corporation.</span><br />\r\n<br />\r\n<span>The Founder &amp; Principal behind the company is Jonathan Chandran whose academic qualifications include finance &amp; accountancy from Universities of London,UK and New York,USA and who has extensive experience in international banking (London, UK; New York, USA; Sydney, Australia; Singapore etc..) as well as having joint responsibility for mananging Can.$1 billion with a securities firm in Canada</span><br />\r\n<br />\r\n<span>Since 2004, <strong class="strong-logo">TRAIN<strong class="h2-red">2</strong>INVEST</strong> has trained thousands of families across Canada. The next generation has developed a skill set that can never be learned at university.</span><br />\r\n<br />\r\n<span>We hope you will become part of this family.</span></div>\r\n\r\n<div class="col-lg-6"><span>The <strong class="strong-logo">TRAIN<strong class="h2-red">2</strong>INVEST</strong> program is a comprehensive learning process designed to radically change the concept of wealth managment. No longer should you give your hard-earned money to a person who is less well-off than you - just because he wears a suit &amp; talks like a politician1</span><br />\r\n<br />\r\n<span>CAPITAL PRESERVATION and WEALTH ACCUMULATION is the cornerstone of the <strong class="strong-logo">TRAIN<strong class="h2-red">2</strong>INVEST</strong> program.</span><br />\r\n<br />\r\n<span>The course has been designed that DOES NOT require PhD in finance... a complex subject is broken down to bite-sized pieces. Realizing that no two people study/understand concepts the same way, it is structured in such a way that an individual studies at their own pace!</span><br />\r\n<br />\r\n<span>That&#39;s why we <span class="h2-red">TEACH</span>...<span class="h2-red">TRAIN</span>...<span class="h2-red">COACH:</span> You are NOT alone!</span><br />\r\n<span>Invest for yourself BUT not by yourself!</span><br />\r\n<a class="toggle-read" href="#">Read More</a></div>\r\n'),
('ABOUT_US_INTRO', 'In one sentence - we <span class="h2-red">TEACH</span>...<span class="h2-red">TRAIN</span>...<span class="h2-red">COACH</span> individuals &amp; families to learn to invest directly in the Toronto Stock Exchange i.e. directly buy and sell shares<br />\r\n(known as Self-Directed Investors)'),
('ABOUT_US_READ_MORE', '<div class="col-lg-6">\r\n<h4>What is the Cost?</h4>\r\n<br />\r\n<span>Let&#39;s deal with a concept called VALUE!</span><br />\r\n<br />\r\n<span>Which one of these cars is worth $60,000? (They are both cars that take you from A to B... except when you meet a MACH truck!).</span>\r\n\r\n<div class="row about-cars">\r\n<div class="col-lg-6 car2"><img alt="" src="images/car1.jpg" /></div>\r\n\r\n<div class="col-lg-6 car1"><img alt="" src="images/car2.jpg" /></div>\r\n</div>\r\n<br />\r\n<span>Now, here&#39;s what you need to do:</span><br />\r\n<span><strong>FIRST:</strong> calculate the COST that you are currently paying per year then multiply it 10 times.</span><br />\r\n<strong>SECOND:</strong><span> What if you earned 5% p.a. on the COST that you just gave away? How much would that amount to?</span><br />\r\n<strong>THIRD: </strong> <span>What did you recieve for the fee that you paid? (Do you know the MER &amp; management fee you paid?)</span></div>\r\n\r\n<div class="col-lg-6">\r\n<h4>THE PROGRAM: 6 Months</h4>\r\n<br />\r\n<span class="h2-red">Phase 1:</span><strong> TEACHING</strong><span> Sessions - 10 weekly classes on Fundamental; Technical &amp; Emotional Analysis.</span><br />\r\n<br />\r\n<span class="h2-red">Phase 2:</span><strong> TRAINING</strong><span> Sessions - Practicing with a DUMMY account to proved skills acquired under Phase 1. RTMA (Weekly Real-Time Market Analysis) Sessions ensuring that you are fully informed of Global &amp; Domestic events.</span><br />\r\n<br />\r\n<span class="h2-red">Phase 3:</span><strong> COACHING</strong><span> Sessions - Creation of a Portfolio with RRSP/TFSA etc; Advanced Technical Analysis Modules improving decision-making process with hands-on support.</span><br />\r\n<br />\r\n<span class="h2-red">NOTE: </span><span>All sessions are recorded &amp; available for viewing at your convenience.</span>\r\n\r\n<h4>TOOLS &amp; RESOURCES INCLUDED</h4>\r\n\r\n<ul>\r\n	<li><a href="#">Comprehensive course manual(pdf).</a></li>\r\n	<li><a href="#">Charting/Technical analysis software.</a></li>\r\n	<li><a href="#">News Letters (Monthly) &amp; Ad-hoc breaking news emails.</a></li>\r\n</ul>\r\n</div>\r\n'),
('ADDTHIS_SHARE_BUTTON', '<!-- Go to www.addthis.com/dashboard to customize your tools -->\r\n<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56a5fbdb49cbb5db" async="async"></script>\r\n'),
('ANALYTICS', '<script></script>'),
('COMPANY_ADDRESS', '<p><span style="background-color:rgb(255, 255, 255); color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">1-1660 Kenaston Blvd. Unit 70037 Winnipeg MB R3P 2H3 Canada</span></p>\r\n'),
('COMPANY_ADDRESS_GMAP', '<p><span style="background-color:rgb(255, 255, 255); color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">1-1660 Kenaston Blvd. Unit 70037 Winnipeg MB R3P 2H3 Canada</span></p>\r\n'),
('COMPANY_EMAIL', '<p><span style="background-color:rgb(255, 255, 255); color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">admin@train2invest.com</span></p>\r\n'),
('COMPANY_FAX', '<p><span style="color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">204-414-9164</span></p>\r\n'),
('COMPANY_HOTLINE', '<p><span style="color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">+1 204-414-9106</span></p>\r\n'),
('COMPANY_NAME', '<p>Train2Invest</p>\r\n'),
('COMPANY_NUMBERS', '<p><span style="color:rgb(17, 17, 17); font-family:roboto,sans-serif; font-size:16px">204-414-9106</span></p>\r\n'),
('COMPANY_OTHER_EMAILS', '<p><span style="background-color:rgb(245, 245, 245); font-family:open sans,sans-serif; font-size:12px">admin@train2invest.com</span></p>\r\n'),
('CONTACT_US_VIDEO_HEIGHT', '<p>400</p>\r\n'),
('CONTACT_US_VIDEO_WIDTH', '<p>200</p>\r\n'),
('DRIBBBLE_LINK', '<p>https://dribbble.com/</p>\r\n'),
('FACEBOOK_ADMINS', '<p>0</p>\r\n'),
('FACEBOOK_APP_ID', '<p>0</p>\r\n'),
('FACEBOOK_LINK', '<p>https://www.facebook.com/Train2Invest</p>\r\n'),
('GOOGLEPLUS_LINK', '<p>https://www.plus.google.com/</p>\r\n'),
('LINKEDIN_LINK', '<p>https://www.linkedin.com/</p>\r\n'),
('PINTEREST_LINK', '<p>https://www.pinterest.com/</p>\r\n'),
('THE_PROGRAM', '<h2 class="section-title text-center wow fadeInDown">THE <strong class="strong-logo bigger-size">TRAIN<strong class="h2-red bigger-size">2</strong>INVEST</strong> PROGRAM</h2>\r\n\r\n<div class="col-md-12 col-lg-12 col-sm-12 text-center"><strong>TEACH, TRAIN, COACH</strong></div>\r\n&nbsp;\r\n\r\n<div class="col-md-12 col-lg-12 col-sm-12">\r\n<p><strong class="strong-logo">TRAIN<strong class="h2-red">2</strong>INVEST</strong><span> offers a COMPLETE SOLUTION in taking a novice investor to achieve a skill set that empowers them to trade with CONFIDENCE &amp; CONSISTENCY. Deliveringa step-by-step learning process that breaks down complex subject matter into manageable, bite-sized piece of information.</span></p>\r\n\r\n<p><strong class="strong-logo">TRAIN<strong class="h2-red">2</strong>INVEST</strong><span> is dedicated to helping investors excel at managing their own portfolios through a simple but complete, step-by-step education process. Our learning environment focuses on the developement of good strategies supported by solid, disciplined decision making criteria producing confident and capable investors.</span></p>\r\n\r\n<p><strong class="strong-logo">TRAIN<strong class="h2-red">2</strong>INVEST</strong><span> teaches,train &amp; coaches novice individuals/families and &#39;inconsistent&#39; experienced investors| to significantly reduce risk through knowledge (theory &amp; practical hands-on lectures), a structured investing/trading methodology(a trading plan), the use of powerful tools (charting software &amp; data feeds), and support groups (mentor &amp; coaches). It is a comprehensive approach to managing wealth productivity where synergies come from careful planning and the utilization of existing investment reserves in purposeful ways for the current and next generation(s).</span></p>\r\n</div>\r\n'),
('THE_PROGRAM_CONTENT_1', '<div class="row">\r\n\r\n                      <div class="col-md-6 col-lg-6 col-sm-12">\r\n                          <div class="panel panel-default">\r\n                              <div class="panel-heading">\r\n                                  <h4>Basic Requirements</h4>\r\n                              </div>\r\n                              <div class="panel-body" style="min-height:405px;">\r\n                                  <ul>\r\n\r\n\r\n                                    <h4>Core competencies achieved by our students include:</h4>\r\n                                    <li><a>Capital preservation</a></li>\r\n                                    <li><a>Risk management</a></li>\r\n                                    <li><a>Money managment</a></li>\r\n                                    <li><a>Strategic wealth management</a></li>\r\n                                    <li><a>Understanding trading psychology</a></li>\r\n                                    <li><a>Fundamental analysis</a></li>\r\n                                    <li><a>Technical Analysis</a></li>\r\n                                    <li><a>Understanding the impact of globalization and trading mechanics</a></li>\r\n                                  </ul>\r\n                              </div>\r\n                          </div>\r\n                      </div>\r\n                      <div class="col-md-6 col-lg-6 col-sm-12">\r\n                          <div class="panel panel-default">\r\n                              <div class="panel-heading">\r\n                                  <h4>Synopsis</h4>\r\n                              </div>\r\n                              <div class="panel-body" style="min-height:405px;">\r\n                                  <p>In its simplest form, TRAIN2INVEST teaches individuals to buy quality blue-chip stocks and generate small, consistent returns in reasonable time horizons. (PRINCIPLE: You never lose taking a profit â€“ however small!).</p>\r\n                                  <ul>\r\n                                    <h4>The Process ANSWERS the following questions:</h4>\r\n                                    <li><a>What quality stocks to buy?</a></li>\r\n                                    <li><a>When is the best time to buy?</a></li>\r\n                                    <li><a>When to sell?</a></li>\r\n                                    <li><a>How to control your emotions?</a></li>\r\n                                    <li><a>How to mitigate losses?</a></li>\r\n                                  </ul>\r\n                                  <p>The results of a well thought out strategy following these principles means that our students can create ongoing portfolio growth without taking unreasonable risks.</p>\r\n                              </div>\r\n                          </div>\r\n                      </div>\r\n                      </div>\r\n                  <!-- /.row -->'),
('THE_PROGRAM_CONTENT_2', '\r\n              <div class="row">\r\n\r\n                  <div class="col-md-offset-2 col-lg-offset-2 col-md-8 col-lg-8 col-sm-12">\r\n                      <div class="panel panel-default">\r\n                          <div class="panel-heading">\r\n                              <h4>Phase 1 â€“ Teaching (2.5 months)</h4>\r\n                          </div>\r\n                          <div class="panel-body min_height">\r\n\r\n                            <strong>Focuses on the foundational knowledge of the markets and decision making</strong>\r\n                            <table class="table">\r\n                              <thead class="thead-inverse">\r\n                                <tr>\r\n                                  <th>Module</th>\r\n                                  <th>Fundamental Analysis*</th>\r\n                                  <th>Technical Analysis*</th>\r\n                                </tr>\r\n                              </thead>\r\n                              <tbody>\r\n                                <tr>\r\n                                  <th scope="row">1</th>\r\n                                  <td>Financial Excellence </td>\r\n                                  <td>Technical Analysis</td>\r\n                                </tr>\r\n                                <tr>\r\n                                  <th scope="row">2</th>\r\n                                  <td> Economics & Geo-Politics</td>\r\n                                  <td> Technical indicators</td>\r\n                                </tr>\r\n                                <tr>\r\n                                  <th scope="row">3</th>\r\n                                  <td>External Events</td>\r\n                                  <td>Risk management</td>\r\n                                </tr>\r\n                                <tr>\r\n                                  <th scope="row">4</th>\r\n                                  <td>Fundamental Analysis</td>\r\n                                  <td>Investor Psychology</td>\r\n                                </tr>\r\n                                <tr>\r\n                                  <th scope="row">5</th>\r\n                                  <td>The Wealth Plan</td>\r\n                                  <td>The Trading Plan</td>\r\n                                </tr>\r\n                              </tbody>\r\n                            </table>\r\n                          </div>\r\n                      </div>\r\n                  </div>\r\n                  <div class="row">\r\n                  <div class="col-md-6 col-lg-6 col-sm-12 ">\r\n                      <div class="panel panel-default ">\r\n                          <div class="panel-heading">\r\n                              <h4>Phase 2â€“ Training (3.5 months)</h4>\r\n                          </div>\r\n                          <div class="panel-body pSameHeight">\r\n                            <strong>Focuses on the advanced knowledge of research, risk management, emotional management and money management</strong>\r\n                            <table class="table">\r\n                              <thead class="thead-inverse">\r\n                                <tr>\r\n                                  <th>Weekly Sessions</th>\r\n                                  <th>Twice Monthly Advanced Recorded Sessions</th>\r\n                                </tr>\r\n                              </thead>\r\n                              <tbody>\r\n                                <tr>\r\n\r\n                                  <td>Real-Time Market Analysis (RTMA) â€“ Focussing on events that will take place during the up-coming week: Trends; Challenges; Global Economic Events etc.</td>\r\n                                  <td>External Events â€“ impact of various market activities that impact specific sectors & probable suggestions to avoid pitfalls.</td>\r\n                                </tr>\r\n                              </tbody>\r\n                            </table>\r\n\r\n                          </div>\r\n                      </div>\r\n                  </div>\r\n                  <div class="col-md-6 col-lg-6 col-sm-12 " >\r\n                      <div class="panel panel-default  ">\r\n                          <div class="panel-heading">\r\n                              <h4>Phase 3â€“ Coaching (3.5 months)</h4>\r\n                          </div>\r\n                          <div class="panel-body pSameHeight">\r\n                            <table class="table">\r\n                              <thead class="thead-inverse">\r\n                                <tr>\r\n                                  <th></th>\r\n                                  <th><strong>Focuses on execution via ''Dummy Trading Accounts''</strong></th>\r\n                                </tr>\r\n                              </thead>\r\n                              <tbody>\r\n                                <tr>\r\n                                  <td scope="row">1</td>\r\n                                  <td>\r\n                                   Coach will go over your trading plan & review your paper trading records\r\n                                 </td>\r\n                               </tr>\r\n                               <tr>\r\n                                 <td scope="row">2</td>\r\n                                 <td>\r\n                                   How to set up trading account with your on-line broker.\r\n                                 </td>\r\n                               </tr>\r\n                               <tr>\r\n                                 <td scope="row">3</td>\r\n                                 <td>\r\n                                   How to access live data feeds from various web sites & to set up the parameters that was taught in the course.\r\n                                  </td>\r\n                                </tr>\r\n                              </tbody>\r\n                            </table>\r\n\r\n<!--\r\n                            <table >\r\n                            <tr>\r\n                            <td>Trading Plan/ Paper Trading record Review</td>\r\n                            <td><ol>\r\n                             <li>Coach will go over your trading plan & review your paper trading records</li>\r\n                             <li>How to set up trading account with your on-line broker.</li>\r\n                             <li>How to access live data feeds from various web sites & to set up the parameters that was taught in the course.</li>\r\n                            </ol>\r\n                            </td>\r\n                            </tr>\r\n                            </table> -->\r\n                          </div>\r\n                      </div>\r\n                  </div>\r\n                </div>\r\n                  </div>'),
('THE_PROGRAM_CONTENT_3', '\r\n              <div class="row">\r\n\r\n                  <div class="col-md-offset-2 col-lg-offset-2 col-md-8 col-lg-8 col-sm-12">\r\n                      <div class="panel panel-default">\r\n                          <div class="panel-heading">\r\n                              <h4>Phase 1 â€“ Teaching (2.5 months)</h4>\r\n                          </div>\r\n                          <div class="panel-body min_height">\r\n\r\n                            <strong>Focuses on the foundational knowledge of the markets and decision making</strong>\r\n                            <table class="table">\r\n                              <thead class="thead-inverse">\r\n                                <tr>\r\n                                  <th>Module</th>\r\n                                  <th>Fundamental Analysis*</th>\r\n                                  <th>Technical Analysis*</th>\r\n                                </tr>\r\n                              </thead>\r\n                              <tbody>\r\n                                <tr>\r\n                                  <th scope="row">1</th>\r\n                                  <td>Financial Excellence </td>\r\n                                  <td>Technical Analysis</td>\r\n                                </tr>\r\n                                <tr>\r\n                                  <th scope="row">2</th>\r\n                                  <td> Economics & Geo-Politics</td>\r\n                                  <td> Technical indicators</td>\r\n                                </tr>\r\n                                <tr>\r\n                                  <th scope="row">3</th>\r\n                                  <td>External Events</td>\r\n                                  <td>Risk management</td>\r\n                                </tr>\r\n                                <tr>\r\n                                  <th scope="row">4</th>\r\n                                  <td>Fundamental Analysis</td>\r\n                                  <td>Investor Psychology</td>\r\n                                </tr>\r\n                                <tr>\r\n                                  <th scope="row">5</th>\r\n                                  <td>The Wealth Plan</td>\r\n                                  <td>The Trading Plan</td>\r\n                                </tr>\r\n                              </tbody>\r\n                            </table>\r\n                          </div>\r\n                      </div>\r\n                  </div>\r\n                  <div class="row">\r\n                  <div class="col-md-6 col-lg-6 col-sm-12 ">\r\n                      <div class="panel panel-default ">\r\n                          <div class="panel-heading">\r\n                              <h4>Phase 2â€“ Training (3.5 months)</h4>\r\n                          </div>\r\n                          <div class="panel-body pSameHeight">\r\n                            <strong>Focuses on the advanced knowledge of research, risk management, emotional management and money management</strong>\r\n                            <table class="table">\r\n                              <thead class="thead-inverse">\r\n                                <tr>\r\n                                  <th>Weekly Sessions</th>\r\n                                  <th>Twice Monthly Advanced Recorded Sessions</th>\r\n                                </tr>\r\n                              </thead>\r\n                              <tbody>\r\n                                <tr>\r\n\r\n                                  <td>Real-Time Market Analysis (RTMA) â€“ Focussing on events that will take place during the up-coming week: Trends; Challenges; Global Economic Events etc.</td>\r\n                                  <td>External Events â€“ impact of various market activities that impact specific sectors & probable suggestions to avoid pitfalls.</td>\r\n                                </tr>\r\n                              </tbody>\r\n                            </table>\r\n\r\n                          </div>\r\n                      </div>\r\n                  </div>\r\n                  <div class="col-md-6 col-lg-6 col-sm-12 " >\r\n                      <div class="panel panel-default  ">\r\n                          <div class="panel-heading">\r\n                              <h4>Phase 3â€“ Coaching (3.5 months)</h4>\r\n                          </div>\r\n                          <div class="panel-body pSameHeight">\r\n                            <table class="table">\r\n                              <thead class="thead-inverse">\r\n                                <tr>\r\n                                  <th></th>\r\n                                  <th><strong>Focuses on execution via ''Dummy Trading Accounts''</strong></th>\r\n                                </tr>\r\n                              </thead>\r\n                              <tbody>\r\n                                <tr>\r\n                                  <td scope="row">1</td>\r\n                                  <td>\r\n                                   Coach will go over your trading plan & review your paper trading records\r\n                                 </td>\r\n                               </tr>\r\n                               <tr>\r\n                                 <td scope="row">2</td>\r\n                                 <td>\r\n                                   How to set up trading account with your on-line broker.\r\n                                 </td>\r\n                               </tr>\r\n                               <tr>\r\n                                 <td scope="row">3</td>\r\n                                 <td>\r\n                                   How to access live data feeds from various web sites & to set up the parameters that was taught in the course.\r\n                                  </td>\r\n                                </tr>\r\n                              </tbody>\r\n                            </table>\r\n\r\n<!--\r\n                            <table >\r\n                            <tr>\r\n                            <td>Trading Plan/ Paper Trading record Review</td>\r\n                            <td><ol>\r\n                             <li>Coach will go over your trading plan & review your paper trading records</li>\r\n                             <li>How to set up trading account with your on-line broker.</li>\r\n                             <li>How to access live data feeds from various web sites & to set up the parameters that was taught in the course.</li>\r\n                            </ol>\r\n                            </td>\r\n                            </tr>\r\n                            </table> -->\r\n                          </div>\r\n                      </div>\r\n                  </div>\r\n                </div>\r\n                  </div>\r\n              <!-- /.row -->'),
('THE_PROGRAM_MENU_1', '<p>BASIC REQUIREMENTS</p>\r\n'),
('THE_PROGRAM_MENU_2', '<p>PROGRAM PHASES</p>\r\n'),
('THE_PROGRAM_MENU_3', '<p>OUTLINE</p>\r\n'),
('TOTAL_DISPLAYABLE_TESTIMONIAL', '50'),
('TWITTER_ID', '<p>0</p>\r\n'),
('TWITTER_LINK', '<p>https://twitter.com/</p>\r\n'),
('WELCOME_MESSAGE', '<div class="col-lg-6"><strong class="strong-logo">TRAIN<strong class="h2-red">2</strong>INVEST</strong><span> is attempting to transform Canadian families in the arena of wealth building and more importantly wealth management! Think about this:</span>\r\n\r\n<h3>WHO TAUGHT US WEALTH MANAGEMENT?</h3>\r\n\r\n<h3><span>Did we learn about managing wealth:</span></h3>\r\n\r\n<ul>\r\n	<li><a href="#">From School?</a></li>\r\n	<li><a href="#">From Parents?</a></li>\r\n	<li><a href="#">From Friends?</a></li>\r\n	<li><a href="#">From Books/Seminars?</a></li>\r\n	<li><a href="#">From Universities/Colleges?</a></li>\r\n</ul>\r\n<strong>Answer: </strong><span>Usually through OSMOSIS - from a combination of the above <strong>OR</strong> more likely through <strong>TRIAL &amp; ERROR.</strong></span></div>\r\n\r\n<div class="col-lg-6"><strong>WHAT IF:</strong><br />\r\n<span>You had a personal TEACHER, TRAINER and a COACH that taught you and continues to mentor you on how to manage your savings(incl. PRSP/TFSA etc) so that has your money was working for you!</span><br />\r\n<br />\r\n<span>OK...too old...don&#39;t know math...too busy. These are ALL excuses!</span><br />\r\n<br />\r\n<span>The <strong class="strong-logo">TRAIN<strong class="h2-red">2</strong>INVEST</strong> strategy ensures that a person with Grade 12 education or someone with 10 years of working experience(street smarts) is able not only to comprehend investment concepts but who can execute them within 6 months!</span><br />\r\n<br />\r\n<span>How can we be sure?? We have thousands of clients just like you!</span><br />\r\n<a href="#testimonial">Check out our testimonials!</a></div>\r\n'),
('YOUTUBE_LINK', '<p>https://www.youtube.com/</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(300) NOT NULL,
  `orders` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `content`, `image`, `orders`, `status`) VALUES
(1, 'The Power to Prosper!', 'We want you to share more than your eye color to the next generation.\r\nThink about it: What is the more important thing that you can pass on to the next generation?\r\n<br><br>\r\nWEALTH MANAGEMENT', '271991_the-power-to-prosper.jpg', 1, 1),
(2, 'You are not alone', 'We have a team to support you!\r\nYou are Family!', '936692_you-are-not-alone.jpg', 2, 1),
(3, 'THE SEASONS OF LIFE TIME', 'THE SEASONS OF LIFE is the CURRENCY of life & PROCRASTINATION is the thief of TIME', '189978_the-seasons-of-life-time.jpg', 3, 1),
(4, 'A GOODMAN LEAVES AN', 'INHERITANCE TO HIS CHILDREN''s CHILDREN', '199591_a-goodman-leaves-an.jpg', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

DROP TABLE IF EXISTS `testimonial`;
CREATE TABLE IF NOT EXISTS `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `author` varchar(500) NOT NULL,
  `image` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL,
  `company` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `company`) VALUES
(1, 'Kaiste Ventures Limited', 'info@kaisteventures.com', ''),
(3, 'Mojolagbe', 'mojolagbe@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `video` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
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

DROP TABLE IF EXISTS `webpage`;
CREATE TABLE IF NOT EXISTS `webpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(700) NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webpage`
--

INSERT INTO `webpage` (`id`, `name`, `title`, `description`, `keywords`) VALUES
(1, 'home', 'Home', 'We are attempting to transform Canadian families in the arena of wealth building and more importantly wealth management', 'wealth, building, train, management, transform');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
