-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2018 at 08:43 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `humanlib`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookdisplay`
--

CREATE TABLE `bookdisplay` (
  `displayId` int(4) NOT NULL,
  `title` varchar(100) NOT NULL,
  `chapters` varchar(500) NOT NULL,
  `time` varchar(50) NOT NULL,
  `timeBack` varchar(10) DEFAULT NULL,
  `available` varchar(5) NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookdisplay`
--

INSERT INTO `bookdisplay` (`displayId`, `title`, `chapters`, `time`, `timeBack`, `available`) VALUES
(1, 'Grief is My Day Job', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Helping Others with Grief</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> What if Iâ€™m the One Grieving?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Finding the Beauty in Grief</span></p>', '3pm-7pm', NULL, 'yes'),
(2, 'Becoming Jane', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> A Little Girl in Kenya</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Facing Cancer and ALS: Illness and Death</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> â€œAnd Music and Singing Shall Be My Refuge</span></p>', '4pm-7pm', NULL, 'yes'),
(4, 'Living with Bipolar Disorder', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> What the Heck is Bipolar Type 2?</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Suicide Risk?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Medication, Therapy and Self Care</span></p>', '1pm-4pm', NULL, 'yes'),
(5, 'But Where are You Really From?', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> You Grew in my Heart</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Where am I?</span></p>', '1pm-4pm', NULL, 'yes'),
(6, 'What is Normal Anyway?', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Disability Happens</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Still Me</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Resolving Differences</span></p>', '11am-7pm', NULL, 'yes'),
(7, 'Bisexual Catholic', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Most Common Misconception Others have of Me.</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Have you Ever Needed to Hide your Sexuality?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> What am I Learning About Myself Lately?</span></p>', '5pm-7pm', NULL, 'yes'),
(8, 'Want to change the same old routines? Become a FOB somewhere!', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Ready to Leave</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Everything is New. Every Moment is Learning. Everyday can be a Challenge.</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Learn About My Culture Again Through the Eyes of Other Cultures</span></p>', '5pm-7pm', NULL, 'yes'),
(9, '20 Something TBI Survivor', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> What Happened? How did you get a Traumatic Brain Injury?</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> How has College been Different for you Post Injury?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> In your Opinion, what the Difference Between Empathy and Sympathy?</span></p>', '11am - 7pm', NULL, 'yes'),
(10, 'He Who Grew Beyond the Shadows of his Fathers Suicide', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Homosexualtiy</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Suicide</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Interracial Same Sex Marriage</span></p>', '11am-1pm, 5pm-7pm', NULL, 'yes'),
(11, 'That\'s Not My Name', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Lost</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> I Wasnâ€™t Speaking</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Pages Turn</span></p>', '11am-7pm', NULL, 'yes'),
(12, 'Life After Loss: Death and Suicide', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Coping with the Unexpected Loss of My Familyâ€™s Matriarch. </span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Life After My Brotherâ€™s Suicide: Whoâ€™s to Blame?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Stigmaâ€™s and Changing Family Dynamics.</span></p>', '11am-1pm', NULL, 'yes'),
(13, 'Journey to Motherhood: A Homebirth Story', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Making a Different Choice</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Madelineâ€™s Birthday</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Postpartum &amp; Empowerment</span></p>', '1pm-4pm', NULL, 'yes'),
(14, 'The Keys and the Crossroads: Life of a High Priestess, Witch and Seeress', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> This isnâ€™t Hollywood: Fiction vs. Reality</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Daily Life, Belief &amp; Practices</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> That Time I Met Jesus</span></p>', '4pm-7pm', NULL, 'yes'),
(15, 'Rape & PTSD', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Rape, Court &amp; School</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> PTSD &amp; My Double Life</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> The Road to Reconnection</span></p>', '11am-1pm', NULL, 'yes'),
(16, 'Fat, Black, Scientist', '<p>Chapter 1. A "Blerd" When a Blerd Wasn\\\'t A Thing</p><p>Chapter 2. Seeking: Role Model</p><p>Chapter 3. Delayed Creativity</p>', '5pm-7pm', NULL, 'yes'),
(17, 'The People Next Door', '', '5pm-7pm', NULL, 'yes'),
(18, 'There Are No Words', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Tinny Inner Adult</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Not Your Mamaâ€™s Librarian</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Libraryhooker: Queen of Crafts</span></p>', '1pm-5pm', NULL, 'yes'),
(19, 'Addict', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Hopeless</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Selfish</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Worthless</span></p>', '3pm-7pm', NULL, 'yes'),
(20, 'Muslim in America', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> My Hijab, My Crown</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Life as a First Generation Palestinian-American </span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Traveling as a Muslim</span></p>', '3pm-7pm', NULL, 'yes'),
(21, 'American Born Muslim', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Pick the Pepperoni Off the Pizza</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> September 11, 2001 </span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Leaving Faith Behind</span></p>', '11am-7pm', NULL, 'yes'),
(22, 'Living After Losing...My Husband, My Weight and Sometimes My Mind', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Being a Young Widowed Mom is Extremely Exhausting </span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Weight Loss Surgery is Exceedingly Difficult </span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Mental Illness is Not a Punch Line</span></p>', '11am-7pm', NULL, 'yes'),
(23, 'Finding Harmony', '', '11am-7pm', NULL, 'yes'),
(24, 'Always Being Comfortable in the Crossroads', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Perspectives from a Frist Generation Mexican/British Daughter and Student</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Pansexualtiy? Or Just Dating Who You Connect With</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Adult Caretaking: The Surprising Experience of Helping My Father</span></p>', '11am-3pm', NULL, 'yes'),
(25, 'The Double Life Of a Young Illegal Immigrant', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> What was it like growing up without a legal status? What were the implications for a young person?</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Why didnâ€™t you feel like you could tell anyone the truth?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> How did you come out to those around you? What happened then?</span></p>', '5pm-7pm', NULL, 'yes'),
(26, 'Young, Female', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> How Physical Assault made me Realize I was Black in the Sixth Grade</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> From First Generation College Graduate to Young, Black Adjunct Professor</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> The Realities of Black Silence</span></p>', '11am-2pm', NULL, 'yes'),
(27, 'They\'re Here, They\'re Queer', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Religion &amp; Being Queer</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Forming an Identity</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Out Loud &amp; Proud</span></p>', '5pm-7pm', NULL, 'yes'),
(28, 'From India to Indiana', '', '12pm-3pm', NULL, 'yes'),
(29, 'I  Know Why The Caged Bird Does Not Sing', '', '', NULL, 'yes'),
(30, 'Overcoming Adversity', '', '', NULL, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `bookinfo`
--

CREATE TABLE `bookinfo` (
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `displayId` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookinfo`
--

INSERT INTO `bookinfo` (`firstName`, `lastName`, `password`, `email`, `displayId`) VALUES
('', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookId` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `story` text NOT NULL,
  `chapters` text NOT NULL,
  `available` varchar(3) NOT NULL,
  `bookImage` varchar(300) NOT NULL,
  `timeBack` varchar(11) DEFAULT NULL,
  `alert` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookId`, `title`, `story`, `chapters`, `available`, `bookImage`, `timeBack`, `alert`) VALUES
(19, 'Grief is My Day Job', 'Death is something most people fear, but what if it was something you encountered every day? As an ICU/trauma nurse, I have witnessed countless families grieve. As a person, I have faced my own paralyzing grief.  Grief is a part of my every day, and seeing the beauty in it has become my day job.\r\n<br />Available 3-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Helping Others with Grief</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> What if Iâ€™m the One Grieving?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Finding the Beauty in Grief</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(18, 'Becoming Jane', 'Dealing with cancer (at age 34 I was diagnosed with breast cancer). Caregiving for a loved one with terminal illness and dealing with death (my husband died of ALS/Lou Gehrig\'s Disease in 2011).\r\n\r\n<br />Available 4-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> A Little Girl in Kenya</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Facing Cancer and ALS: Illness and Death</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> â€œAnd Music and Singing Shall Be My Refugeâ€</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(20, 'Living with Bipolar Disorder', 'This book has bipolar type 2 disorder.  She has been on many emotional roller coasters in her life, from the highest highs with boundless energy and limitless joy, to the lowest lows where death seems like a welcomed escape from the darkness.  Today she is stable and lives a mostly normal life.\r\n\r\n<br />Available 1-4pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> What the Heck is Bipolar Type 2?</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Suicide Risk?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Medication, Therapy and Self Care</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(21, 'But Where are You Really From?', 'I was born in "GuangZhou" China. At 9 months old I was adopted into a family from Logansport, IN. Being an Asian female who wants to work in media made me realize the lack of. I want to help Asians being represented more and represented correctly. \r\n<br />Available 1-4pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> You Grew in my Heart</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Where am I?</span></p>', 'yes', 'assets/images/books/wherefrom.jpg', NULL, 'no'),
(22, 'What is Normal Anyway?', 'Disability access and inclusion for in arts & culture (museums, theater, zoos, etc) Deaf History Cochlear implants Communication access for Deaf and hard of Disability access and inclusion for in arts & culture (museums, theater, zoos, etc); Deaf History; Cochlear implants Communication; and  Access for Deaf and hard of hearing people\r\n<br />Available 11-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Disability Happens</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Still Me</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Resolving Differences</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(23, 'Bisexual Catholic', 'This book grew up in rural Indiana surrounded by a large, conservative, Catholic family.  She loves to explore the food scene in Indianapolis, meditate or do extreme workouts to relieve stress, and travel to new places finding fashion forward items to add to her wardrobe. Because of unforeseen personal life events, this book understands such experiences as God sharing an ultimate grace with her: the gift of empathy.\r\n\r\n<br />Available 5-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Most Common Misconception Others have of Me.</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Have you Ever Needed to Hide your Sexuality?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> What am I Learning About Myself Lately?</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(24, 'Want to change the same old routines? Become a FOB somewhere!', 'Fresh off the boat. I am always curious about the world outside of my home island, Taiwan. Use teaching Mandarin as a chance to explore this supersized USA, and also somehow unexpectedly learn more about my native culture through the sparks from interacting with other cultures.\r\n<br />Available 5-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Ready to Leave</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Everything is New. Every Moment is Learning. Everyday can be a Challenge.</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Learn About My Culture Again Through the Eyes of Other Cultures</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(25, '20 Something TBI Survivor', 'At 19, I became a walking paradox - a neuroscience major with limited cognitive function, a language major unable to form the sentences that I had once so effortlessly composed, and a collegiate cross country runner who could barely find her balance. These inabilities can easily mold an identity, but so can the resilience, hope, and humility required to overcome them.\r\n<br />Available 11am - 7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> What Happened? How did you get a Traumatic Brain Injury?</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> How has College been Different for you Post Injury?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> In your Opinion, what the Difference Between Empathy and Sympathy?</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(26, 'He Who Grew Beyond the Shadows of his Fathers Suicide', 'Open this book and discover how one man found his identity in what might seem to be the darkest of places - his father\'s suicide. Uncover the trauma and drama that followed this man through his childhood but brought him into the light of understanding and forgiveness.\r\n<br />Available 11-1pm, 5-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Homosexualtiy</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Suicide</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Interracial Same Sex Marriage</span></p>', 'yes', 'assets/images/books/suicide.jpg', NULL, 'no'),
(27, 'Thatâ€™s Not My Name', 'Available 11-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Lost</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> I Wasnâ€™t Speaking</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Pages Turn</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(28, 'Life After Loss: Death and Suicide', 'One of eight kids, when this book\'s mother passed suddenly at 58 it shook the family to its core.  Two years later the youngest brother of the family took his own life at 21 with a gun. Learn more about, grief, suicide, blame and guilt and the reassurance of large family.\r\n<br />11-1pm\r\n', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Coping with the Unexpected Loss of My Familyâ€™s Matriarch. </span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Life After My Brotherâ€™s Suicide: Whoâ€™s to Blame?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Stigmaâ€™s and Changing Family Dynamics.</span></p>', 'yes', 'assets/images/study.png', NULL, 'no'),
(29, 'Journey to Motherhood: A Homebirth Story', 'Follow along with this first time mother, as she opens up about her controversial choice to forgo the standard medical model of care for her baby\'s birth and instead decides to birth at home under the close supervision of midwives.  \r\n<br />Available 1-4pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Making a Different Choice</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Madelineâ€™s Birthday</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Postpartum &amp; Empowerment</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(30, 'The Keys and the Crossroads: Life of a High Priestess, Witch and Seeress', 'Tamrha, a practicing Witch for 20 years, is an Ordained Priestess of Hekate and High Priestess of Novices of the Old Ways- IN. She has been trained in Norse Seidh and Trance Prophesy Regression. Born and raised on Long Island, NY she is a first generation Italian and German-American, and is currently immersing herself in work with Saints, her Ancestors and different schools of magic.\r\n<br />Available 4-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> This isnâ€™t Hollywood: Fiction vs. Reality</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Daily Life, Belief &amp; Practices</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> That Time I Met Jesus</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(31, 'Rape & PTSD', 'At 13, I was labeled with rape, then PTSD.  I tried to overcome those labels. I later learned how to identify with those labels.  I\'m now 31, and arguably have many more labels.  Let\'s put labels aside, and recognize whole people.  I, too, am still learning how to do this.\r\n<br />Available 11-1pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Rape, Court &amp; School</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> PTSD &amp; My Double Life</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> The Road to Reconnection</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(32, 'Fat, Black, Scientist', 'This book was born and raised here in Indianapolis and excelled in all subjects in school, but science seemed to be a natural fit. Though the aptitude for the sciences was there, a lack of role models probably hindered her progress to excellence. She now believes that can be what she needed years ago.\r\n<br />Available 5-7pm', '<p>Chapter 1. A "Blerd" When a Blerd Wasn\'t A Thing</p><p>Chapter 2. Seeking: Role Model</p><p>Chapter 3. Delayed Creativity</p>', 'yes', 'assets/images/', NULL, 'no'),
(33, 'The People Next Door', 'I have faced discrimination based on my sexuality. Being bisexual (now I consider myself pansexual, which wasn\'t around when I was younger), I\'ve gotten it from both sides. I have also faced discrimination as a transgender woman; before, during, and after transitioning. \r\n<br />Available 5-7pm', '<p><br></p>', 'yes', 'assets/images/', NULL, 'no'),
(34, 'There Are No Words', 'A 2010 graduate of IUPUI, have been working in libraries since 2002. Currently the Teen Programming Specialist at the Indianapolis Public Library, I am passionate about connecting teens with literature through fun programs. I love books, movies, music and most types of crafting. I am an enormous fan of Doctor Who and K-Dramas. Throughout my life I have had to fight stereotypes in both my personal life and at work. I\'ve been called too black and not black enough. I\'ve been told that I don\'t speak like a black person is supposed to. I\'ve been told that I speak and behave "too white". I\'ve been looked down on because I am a self-identifying nerd/geek who loves comic books, books, to create and other things considered nerdy. I decided a long time ago not to be defined by what others believe I should and should not be or do. I strive to be myself and if I\'m good enough for me, that should be just fine for everyone else.\r\n\r\n<br />Available 1-5pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Tinny Inner Adult</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Not Your Mamaâ€™s Librarian</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Libraryhooker: Queen of Crafts</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(35, 'Addict', 'My name is Lesly, and I\'m an addict. I\'m also a friend, girlfriend, daughter, and sister. Addiction is often portrayed full of stereotypes and misinformation. Very rarely do we get to see the other side, the life after drugs, the recovering addict. I am here to tell my story.    \r\n\r\n<br />Available 3-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Hopeless</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Selfish</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Worthless</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(36, 'Muslim in America', 'I am a proud Palestinian Muslim-American, but I am tired. Tired of having to speak up and defend fellow Muslim sisters and myself due to the negative stereotypical portrayal of Muslim women. I would hate to break it to you, but I love shattering stereotypes, for I am anything but oppressed.\r\n<br />Available 3-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> My Hijab, My Crown</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Life as a First Generation Palestinian-American </span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Traveling as a Muslim</span></p>', 'yes', 'assets/images/books/musliminameria.jpg', NULL, 'no'),
(37, 'American Born Muslim', 'Born in 1986 to Black American converts to Islam, Mahasin provides a unique perspective of what it was like to be black, Muslim and a woman in a pre and post 9/11 world.\r\n<br />Available 11-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Pick the Pepperoni Off the Pizza</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> September 11, 2001 </span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Leaving Faith Behind</span></p>', 'no', 'assets/images/books/americanbornmuslim.jpg', '10:50', 'no'),
(38, 'Living After Losing...My Husband, My Weight and Sometimes My Mind', 'My name is Emilie, and I\'m a hot young widowed mom.  I wasn\'t always a widow or a mom (or hot) but I\'m not even 40 yet, so I\'m still young! Three things in my life nearly killed me...and if it weren\'t for my son I might not even be here.\r\n<br />Available 11-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Being a Young Widowed Mom is Extremely Exhausting </span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Weight Loss Surgery is Exceedingly Difficult </span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Mental Illness is Not a Punch Line</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(39, 'Finding Harmony', 'I was born and raised in a devout Mormon family, and finally left the church in my 20\'s after I married. I\'m willing to answer any questions about growing up as the only Mormon family in our rural Indiana community, and what it takes to leave that religious organization. I\'m also a liberal agnostic and have been married to a conservative Christian for over 20 years, and can answer questions about finding happiness and common ground in a marriage of opposites.\r\n<br />Available 11-7pm', '<p><br></p>', 'yes', 'assets/images/harmony.jpg', NULL, 'no'),
(40, 'Always Being Comfortable in the Crossroads', 'Angela Murillo is a first-generation American and a first-generation college graduate who grew up in a working class immigrant family. Her mother is from Mexico City and her father\'s family is from England. Angela does not identify with any particular sexuality, instead has always dated who she finds a personal connection with. She identifies as an atheist, however, is very open to all faiths.  While in her early 30s, she took several years off work and school to be her father\'s caretaker and help him through the final stages of life. \r\n\r\n<br />Available 11-3pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Perspectives from a Frist Generation Mexican/British Daughter and Student</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Pansexualtiy? Or Just Dating Who You Connect With</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Adult Caretaking: The Surprising Experience of Helping My Father</span></p>', 'no', 'assets/images/books/crossroads.jpg', '10:50', 'no'),
(41, 'The Double Life Of a Young Illegal Immigrant', 'I was born in Mexico and immigrated to the US as a young child. Indiana is where I grew up, went to school, made friendships, and gained every right of passage. Growing up, those closest to me - teachers, acquaintances, friends, even significant others - had no idea that I was the \'illegal alien\' they heard of on the news. My perfectly maintained faÃ§ade, and the secret I would do anything to keep, would drive me to inexplicable extremes.\r\n<br />Available 5-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> What was it like growing up without a legal status? What were the implications for a young person?</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Why didnâ€™t you feel like you could tell anyone the truth?</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> How did you come out to those around you? What happened then?</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(42, 'Young, Female, ', 'I am thirty-something African American Library Manager who has taught collegiate courses in Intercultural Communication, Interracial Communication and International Popular Culture. Ask me anything and I\'ll tell you!\r\n<br />Available: 11-2pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> How Physical Assault made me Realize I was Black in the Sixth Grade</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> From First Generation College Graduate to Young, Black Adjunct Professor</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> The Realities of Black Silence</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(43, 'They\'re Here, They\'re Queer', 'Growing up, I always felt that something was wrong with me. It wasn\'t until I got older that I started to realize that the reason I felt so different, is because I am queer and trans, and I had never been taught anything about that identity, except for hearing that it was wrong to be gay from my family and church. It has been a long road, but I have learned so much about myself and now I am incredibly proud of my identity. \r\n<br />Available 5-7pm', '<p><strong style="color: black;">Chapter 1:</strong><span style="color: black;"> Religion &amp; Being Queer</span></p><p><strong style="color: black;">Chapter 2:</strong><span style="color: black;"> Forming an Identity</span></p><p><strong style="color: black;">Chapter 3:</strong><span style="color: black;"> Out Loud &amp; Proud</span></p>', 'yes', 'assets/images/', NULL, 'no'),
(47, 'From India to Indiana', ' have been a city-bred all my life, used to living amidst the chaos of a big and noisy city of India, my eyes not used to empty roads, stores closed before midnight. Moving to Manhattan just fueled my urban habits. Living right in the heart of New York City\r\n was an experience to itself. I could walk almost to every part of the city from midtown to downtown. Indianapolis has brought a change in my habits. Life has slowed down suddenly and I am kind of enjoying it.â€‹\r\n<br />Available 12-3pm', '<p>[object Object]</p>', 'yes', 'assets/images/books/toa.jpg', NULL, 'no'),
(50, 'I  Know Why The Caged Bird Does Not Sing', 'Her twin sons are raised and off to college. The time to focus on HER has come....and gone.\r\nA call from a neighbor an ocean away changes everything. \r\nOnce a successful entertainer, now on her way back to her childhood home to be a full time caregiver.\r\nREAD ME!!!!', '<ol><li>Only child of parents both born with Cerebral Palsy</li><li>Caregiver for handicapped parent</li><li>Recording Artist/TV Personality </li></ol>', 'yes', 'assets/images/', NULL, 'no'),
(49, 'Overcoming Adversity', 'As a survivor of the 1994 Rwandan Genocide against the Tutsi, the story of survival and forgiveness is truly inspiring. ', '<p>[object Object]</p>', 'yes', 'assets/images/', NULL, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `workerId` int(3) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `admin` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`workerId`, `firstName`, `lastName`, `email`, `password`, `admin`) VALUES
(1, 'Blake', 'Robertson', 'blaker1136@gmail.com', 'yoyoyo55', 'yes'),
(2, 'Alex', 'Smith', 'test@gmail.com', 'test', 'yes'),
(3, 'test', 'employee', 'test@test.com', 'test', 'yes'),
(9, 'testBoy', 'jimbo', 'phpuser@gmail.com', 'password', 'no'),
(8, 'Pam', 'Beasely', 'pam@dunder.com', 'password', 'yes'),
(7, 'Jim', 'Halpert', 'test5@gamil.com', 'wefwef', 'no'),
(12, 'April', 'Second', 'tfaas@iupui.edu', 'whatever', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookdisplay`
--
ALTER TABLE `bookdisplay`
  ADD PRIMARY KEY (`displayId`);

--
-- Indexes for table `bookinfo`
--
ALTER TABLE `bookinfo`
  ADD UNIQUE KEY `displayId` (`displayId`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookId`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`workerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookdisplay`
--
ALTER TABLE `bookdisplay`
  MODIFY `displayId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `workerId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
