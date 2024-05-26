-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2024 at 11:03 AM
-- Server version: 10.6.14-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ourwebpr_deeksha`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty_data`
--

CREATE TABLE `faculty_data` (
  `id` int(11) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `region_id` varchar(255) DEFAULT NULL,
  `schools` varchar(255) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  `tsdate` date DEFAULT NULL,
  `tedate` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `creation_date` date DEFAULT curdate(),
  `applied_for_reallotment` enum('Yes','No') NOT NULL DEFAULT 'No',
  `reallotment_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_fill_data`
--

CREATE TABLE `faculty_fill_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `tsdate` date DEFAULT NULL,
  `tedate` date DEFAULT NULL,
  `schools` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `pcont` varchar(20) DEFAULT NULL,
  `tgtname` varchar(255) DEFAULT NULL,
  `tgtcont` varchar(20) DEFAULT NULL,
  `pgtname` varchar(255) DEFAULT NULL,
  `pgtcont` varchar(20) DEFAULT NULL,
  `school_status` varchar(255) DEFAULT NULL,
  `stream` varchar(255) DEFAULT NULL,
  `twelve` int(11) DEFAULT NULL,
  `topic_covered` varchar(255) DEFAULT NULL,
  `visit_remark` varchar(255) DEFAULT NULL,
  `data_collected` enum('Yes','No') DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo_path` varchar(255) NOT NULL,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `region_id` int(11) NOT NULL,
  `region_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `region_name`) VALUES
(1, 'Pilibhit Region'),
(2, 'Badaun Region'),
(3, 'Baheri and Kittcha Region'),
(4, 'Lakhimpur Khiri and Palia Region'),
(5, 'Fateganj Meerganj Region'),
(6, 'Nabab Ganj Region'),
(7, 'Bisalpur and Wajeer Ganj');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school_name`, `region_id`) VALUES
(1, 'BENHUR PUBLIC SCHOOL', 1),
(2, 'ST ALOYSIUS COLLEGE', 1),
(3, 'ISHER ACADEMY SR SECONDARY SCHOOL', 1),
(4, 'LITTLE ANGLES SCHOOL', 1),
(5, 'JAYCEES R I C PURANPUR', 1),
(6, 'ANGOORI DEVI COLLEGE', 1),
(7, 'CIRAUNJI LAL VIRENDRA PAL', 1),
(8, 'S G T B INTER COLLEGE', 1),
(9, 'CHAUDHARY NIHAL SINGH INTER COLLEGE', 1),
(10, 'GOVT H S S,TODARPUR', 1),
(11, 'KENDRIYA VIDHYALAYA', 1),
(12, 'N D INTER ROOPUR PILIBHIT', 1),
(13, 'SPRINGDALE COLLEGE', 1),
(14, 'VIRANGNA AVANTI BAI GIRLS INTER COLLEGE', 1),
(15, 'VIRANGNA AVANTIVAI PILIBHIT', 1),
(16, 'THE GREAT INTER COLLEGE,AMARIA', 1),
(17, 'ST JOSHAF CONVENT SCHOOL PURANPUR', 1),
(18, 'S V M INTER COLLEGE PURANPUR PILIBHIT', 1),
(19, 'OXFORD PUBLIC SCHOOL PALIA', 1),
(20, 'Doon international palia', 1),
(21, 'AKAL ACADEMY GOMTI KAJRI', 1),
(22, 'AKAL ACADEMY GOMTI GOMTIPUL', 1),
(23, 'DPUAL SCHOOL BADAUN', 2),
(24, 'BRB MODEL SCHOOL', 2),
(25, 'MAHARISHI V.MANDIR BADUAN', 2),
(26, 'BLOOMINGDALE', 2),
(27, 'MOTHER ATHENA', 2),
(28, 'RAJARAM', 2),
(29, 'NEHRU ADARSH INTER COLLEGE ALAPUR', 2),
(30, 'SANSKAR INTER COLLEGE DATAGANJ', 2),
(31, 'HOLY FAMILY AONLA', 2),
(32, 'CHACHA NEHRU BAL VIDYA MANDIR AONLA', 2),
(33, 'M V M BADAUN', 2),
(34, 'D R M I C ANJANI AONLA BLY', 2),
(35, 'COLUMBUS PUBLIC SCHOOL', 3),
(36, 'Mission Acdemy Baheri', 3),
(37, 'guru nanak inter', 3),
(38, 'mgm Inter', 3),
(39, 'susila tiwari Inter', 3),
(40, 'kesar inter', 3),
(41, 'dingra inter baheri', 3),
(42, 'LIONS ROHILA GADARPUR', 3),
(43, 'deepanjali Inter', 3),
(44, 'Assisi IC', 3),
(45, 'Beersheba Kicha', 3),
(46, 'Sheriya IC Baheri', 3),
(47, 'Nalanda Public School Kicha', 3),
(48, 'National Public School Baheri', 3),
(49, 'LBS Baheri', 3),
(50, 'GREEN FIELD ACD LAKHIMPUR', 4),
(51, 'ST DON BASCO COLLEGE LAKHIMPUR KHERI U P', 4),
(52, 'THE RENAISSANCE ACADEMY TILHAR', 4),
(53, 'B.S Public School', 4),
(54, 'Guru Teg Bahadur School', 4),
(55, 'Oxford Public School Palia', 4),
(56, 'Lucknow Public School Lakhimpur', 4),
(57, 'Fertilizer Inter Sahajhanpur', 4),
(58, 'MILTON ACADEMY RAMPUR', 5),
(59, 'Mother Athena Rampur', 5),
(60, 'SVM Meerganj', 5),
(61, 'Unique Model IC Fatehganj', 5),
(62, 'Shastri memorial inter college fatehganj', 5),
(63, 'Chandra shekhar azad inter college fatehganj', 5),
(64, 'DAYAWATI MODI ACADEMY', 5),
(65, 'ST MERRYS RAMPUR', 5),
(66, 'Brahma Devi Balika IC', 5),
(67, 'Tara girls inter college fatehganj', 5),
(68, 'Mother Athena Rampur', 5),
(69, 'Tulsidas kilachand inter college fatehganj', 5),
(70, 'SHRI H N DWIVEDI I C HAFIJGANJ', 5),
(71, 'Sant Mangalpuri IC meerganj', 5),
(72, 'Rajendra prasad IC meerganj', 5),
(73, 'DARBARI LAL SHARMA INTER COLLEGE,BAREILLY', 6),
(74, 'RAJA RAM GIRLS INTER COLLEGE', 6),
(75, 'R K INTER COLLEGE ASHOK NAGAR BLY', 6),
(76, 'RAJKIYA INTER COLLEGE', 6),
(77, 'Arya Putri GIC', 6),
(78, 'Khalsa Inter College', 6),
(79, 'F R ISLAMIA INTER COLLEGE', 6),
(80, 'A S I C, NAWABGANJ', 6),
(81, 'GOVT H S S PAROTHI NAWABGANJ', 6),
(82, 'L B S GIRLS INTER COLLEGE NAWABGANJ', 6),
(83, 'LALTA PRASAD SVM I C NAWABGANJ', 6),
(84, 'SHRI H N DWIVEDI I C HAFIJGANJ', 6),
(85, 'JESUS MERRY', 6),
(86, 'RP inter College', 6),
(87, 'SSt inter College senthal', 6),
(88, 'SSt inter College kweleriya', 6),
(89, 'Gulab Rai inter college Nawabganj', 6),
(90, 'D K INTER COLLEGE BAREILLY', 6),
(91, 'SKIC Nawabganj', 6),
(92, 'MISSION PUBLIC SCHOOL NAWABGANJ', 6),
(93, 'Somwati Inter College', 6),
(94, 'Attain Inter College', 6),
(95, 'Sanjay Inter College', 6),
(96, 'Bhagwati Inter College', 6),
(97, 'Kamla tulsi Inter Cllege', 6),
(98, 'M.L. Inter College Bisauli', 7),
(99, 'R.K. Inter College Bisauli', 7),
(100, 'RM inter college wajirganj', 7),
(101, 'MLR inter college Wajirganj', 7),
(102, 'Natthu lal Inter college', 7),
(103, 'Manoj Sainani IC', 7),
(104, 'S S V INTER COLLEGE,BISALPUR', 7),
(105, 'S R M I C BISALPUR', 7),
(106, 'Bharat inter College Bhojipura', 7),
(107, 'Adarsh Niketan Inter College Bhojipura', 7),
(108, 'D P P  INTER COLLEGE', 7),
(109, 'DROPADI DEVI SARASWATI VIDYA MANDIR', 7),
(110, 'Bharat Inter College', 7),
(114, 'Ysgsg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `usersss`
--

CREATE TABLE `usersss` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersss`
--

INSERT INTO `usersss` (`id`, `name`, `department`, `role`, `username`, `password`, `status`) VALUES
(1, 'Dr. Rekha Gangwar', 'ZOOLOGY DEPTT.', 'user', 'gangwar.rekha01@gmail.com', '12345678', 'active'),
(2, 'Dr. Monika Saxena', 'ZOOLOGY DEPTT.', 'user', 'monikasaxena2016@gmail.com', '12345678', 'active'),
(3, 'Ms. Farha Hussain', 'ZOOLOGY DEPTT.', 'user', 'farhahusain31@gmail.com', '12345678', 'active'),
(4, 'Mr. Chanchal Srivastava', 'ZOOLOGY DEPTT.', 'user', 'chanchalbest123@gmail.com', '12345678', 'active'),
(5, 'Dr. Manoj Joshi', 'BOTANY DEPTT.', 'user', 'manoj.joshi26@gmail.com', '12345678', 'active'),
(6, 'Ms. Somiya Ankita Massey', 'BOTANY DEPTT.', 'user', '906812483.sm@gmail.com', '12345678', 'active'),
(7, 'Ms. Nazia Qamar', 'BOTANY DEPTT.', 'user', 'naziaqamar91@gmail.com', '12345678', 'active'),
(8, 'Ms. Shilpa Chandravanshi', 'BOTANY DEPTT.', 'user', 'shilparajoot@gmail.com', '12345678', 'active'),
(9, 'Dr. Nisha Dinkar', 'BIOTECH.', 'user', 'nishadinkar@gmail.com', '12345678', 'active'),
(10, 'Dr. Mohd. Faheem Khan', 'BIOTECH.', 'user', 'faheemphd@gmail.com', '12345678', 'active'),
(11, 'Mr. Rakesh Kumar Sarkar', 'BIOTECH.', 'user', 'rsarkar271@gmail.com', '12345678', 'active'),
(12, 'Ms. Bushra Fatima', 'BIOTECH.', 'user', 'bushrafatima2807@gmail.com', '12345678', 'active'),
(13, 'Dr. Ajai Gupta', 'CHEMISTRY DEPTT.', 'user', 'ajaykcmt@gmail.com', '12345678', 'active'),
(14, 'Dr. Shalini Gupta', 'CHEMISTRY DEPTT.', 'user', 'shalinidr74@gmail.com', '12345678', 'active'),
(15, 'Mr. Gufran Ali', 'CHEMISTRY DEPTT.', 'user', 'gufranalimsc46@gmail.com', '12345678', 'active'),
(16, 'Dr. Amit Kumar Gupta', 'MATHS DEPTT.', 'user', 'guptaamit48@rediffmail.com', '12345678', 'active'),
(17, 'Mr. Brijesh Babu', 'MATHS DEPTT.', 'user', 'brijeshgangwar@gmail.com', '12345678', 'active'),
(18, 'Dr. Pawan Saxena', 'MATHS DEPTT.', 'user', 'saxenapawan78@gmail.com', '12345678', 'active'),
(19, 'Mr. Harshvardhan', 'MATHS DEPTT.', 'user', 'harshshakya243001@gmail.com', '12345678', 'active'),
(20, 'Mr. Rajit Kumar', 'MATHS DEPTT.', 'user', 'rajitmishra7318@gmail.com', '12345678', 'active'),
(21, 'Mr. Munish Kumar', 'PHYSICS DEPTT.', 'user', 'munish85physics@gmail.com', '12345678', 'active'),
(22, 'Mr. Dinesh Kumar', 'PHYSICS DEPTT.', 'user', 'dineshkr1502@gmial.com', '12345678', 'active'),
(23, 'Ms. Akanksha Gupta', 'PHYSICS DEPTT.', 'user', 'ag2305147@gnauk,cin', '12345678', 'active'),
(24, 'Mr. Kumar Pal Singh', 'PHYSICS DEPTT.', 'user', 'kumarpalsingh00@gmail.com', '12345678', 'active'),
(25, 'Mrs. Pragya Ritambhara', 'HOME SC. DEPTT.', 'user', 'pragyaritz21@gmail.com', '12345678', 'active'),
(26, 'Mrs. Shubhra Trivedi', 'HOME SC. DEPTT.', 'user', 'mrsshubhratrivedi@gmail.com', '12345678', 'active'),
(27, 'Ms. Jyotsana Sharma', 'HOME SC. DEPTT.', 'user', 'jt.Bareilly@gmail.com', '12345678', 'active'),
(28, 'Ms. Shyama Chouhan', 'HOME SC. DEPTT.', 'user', 'ayushichauhan1512@gmail.com', '12345678', 'active'),
(29, 'Dr. R.K. Singh', 'EDUCATION DEPTT.', 'user', 'rksinghkcmt@gmail.com', '12345678', 'active'),
(30, 'Mrs. Kalpana Katiyar', 'EDUCATION DEPTT.', 'user', 'kalpanajashwar007@gmail.com', '12345678', 'active'),
(31, 'Mr. S.S. Sharma', 'EDUCATION DEPTT.', 'user', 'shivss164@gmail.com', '12345678', 'active'),
(32, 'Mr. Om Pal Singh', 'EDUCATION DEPTT.', 'user', 'ompal610@gmail.com', '12345678', 'active'),
(33, 'Mrs. Savita Johari', 'EDUCATION DEPTT.', 'user', 'savita3333@gmail.com', '12345678', 'active'),
(34, 'Mr. Mohammad Javed', 'EDUCATION DEPTT.', 'user', 'mohdjavedjafri@gmail.com', '12345678', 'active'),
(35, 'Mrs. Rachna Singh', 'EDUCATION DEPTT.', 'user', 'singh.ishi2013@gmail.com', '12345678', 'active'),
(36, 'Mrs. Meenu Kanotra', 'EDUCATION DEPTT.', 'user', 'meenu.kanotra03@gmial.com', '12345678', 'active'),
(37, 'Mr. Ghanshyam', 'EDUCATION DEPTT.', 'user', 'ghanshyamjuly1980@gmail.com', '12345678', 'active'),
(38, 'Mr. Ajai Tiwari', 'EDUCATION DEPTT.', 'user', 'AJAYRU1@Yahoo.com', '12345678', 'active'),
(39, 'Mr. Harish Kumar', 'EDUCATION DEPTT.', 'user', 'harikmn2013@gmail.com', '12345678', 'active'),
(40, 'Mrs. Seema Saxena', 'EDUCATION DEPTT.', 'user', 'saxenaseema755@gmail.com', '12345678', 'active'),
(41, 'Mr. Ahsan Ali', 'EDUCATION DEPTT.', 'user', 'aliahsanali8`819@gamil.com', '12345678', 'active'),
(42, 'Mrs. Pragya', 'EDUCATION DEPTT.', 'user', '', '12345678', 'active'),
(43, 'Mr. Trivendra Kumar', 'EDUCATION DEPTT.', 'user', 'rinkusji24@gmail.com', '12345678', 'active'),
(44, 'Mr. Nirpendra Pratap Singh', 'EDUCATION DEPTT.', 'user', 'nikk.1189bly@gmail.com', '12345678', 'active'),
(45, 'Ms. Swati Kaushik', 'EDUCATION DEPTT.', 'user', 'sanswatidixit@gmail.com', '12345678', 'active'),
(46, 'Mrs. Taruna Rani', 'EDUCATION DEPTT.', 'user', 'Dr.tarunarani@gmail.com', '12345678', 'active'),
(47, 'Mrs. Anuradha Pandey', 'EDUCATION DEPTT.', 'user', 'anupandey396@gmail.com', '12345678', 'active'),
(48, 'Mrs. Mukta Mani Sharma', 'EDUCATION DEPTT.', 'user', 'muktamanisharma@gmail.com', '12345678', 'active'),
(49, 'Ms. Archana Devi', 'EDUCATION DEPTT.', 'user', 'archanashakya825@gmail.com', '12345678', 'active'),
(50, 'Mrs. Retesh Gupta', 'EDUCATION DEPTT.', 'user', 'rinki2248@gmail.com', '12345678', 'active'),
(51, 'Mr. Ritesh Agarwal', 'MANAGEMENT', 'user', 'ragarwal76@gmail.com', '12345678', 'active'),
(52, 'Dr. Prabodh Gour', 'MANAGEMENT', 'admin', 'dr.prabodhgour@gmail.com', '12345678', 'active'),
(53, 'Mr. Ajeet Verma', 'MANAGEMENT', 'user', 'vermaajeet1981@gmail.com', '12345678', 'active'),
(54, 'Mrs. Ratika Chawla', 'MANAGEMENT', 'user', 'ratikachawla12@gmail.com', '12345678', 'active'),
(55, 'Mr. Ravi Verma', 'MANAGEMENT', 'user', 'vermaravi01@gmail.com', '12345678', 'active'),
(56, 'Mr. Fahad Beg', 'MANAGEMENT', 'user', 'fhdbeg@gmail.com', '12345678', 'active'),
(57, 'Mr. Anil Kumar Singh', 'MANAGEMENT', 'user', 'anil.mjpru@gmail.com', '12345678', 'active'),
(58, 'Mr. Paras Agarwal', 'MANAGEMENT', 'user', 'paras1103@gmail.com', '12345678', 'active'),
(59, 'Mr. Mukul Gupta', 'MANAGEMENT', 'user', 'mukulguptahr@gmail.com', '12345678', 'active'),
(60, 'Mr. Harish Kumar', 'MANAGEMENT', 'user', 'kumar.harish861978@gmail.com', '12345678', 'active'),
(61, 'Mr. Amiyo Das', 'MANAGEMENT', 'user', 'amiyodas9@gmail.com', '12345678', 'active'),
(62, 'Mrs. Tejasvita Singh', 'MANAGEMENT', 'user', 'singh.tejasvita@gmail.com', '12345678', 'active'),
(63, 'Ms. Sunaina Mahajan', 'MANAGEMENT', 'user', 'sunainamahajan58@gmail.com', '12345678', 'active'),
(64, 'Ms. Priyadarshini Gour', 'MANAGEMENT', 'user', 'priya.gaur456@gmail.com', '12345678', 'active'),
(65, 'Ms. Trishty Khandelwal', 'MANAGEMENT', 'user', 'trishty9@gmail.com', '12345678', 'active'),
(66, 'Shri Shivam Kashyap', 'MANAGEMENT', 'user', 'shivamkashyap13@g.mail.com', '12345678', 'active'),
(67, 'Ms. Diya Oli', 'MANAGEMENT', 'user', 'olidiya22@gmail.com', '12345678', 'active'),
(68, 'Mr. Deepak Awasthi', 'COMPUTER', 'user', 'posttodeepak@gmail.com', '12345678', 'active'),
(69, 'Mr. Rajat Kapoor', 'COMPUTER', 'user', 'nerajatkapoor@gmail.com', '12345678', 'active'),
(70, 'Mr. Sanjeev Sharma', 'COMPUTER', 'user', 'sanjeevprof@gmail.com', '12345678', 'active'),
(71, 'Mr. Ankur Bhardwaj', 'COMPUTER', 'user', 'ankur.mca0811@gmail.com', '12345678', 'active'),
(72, 'Mrs. Shivani Rastogi', 'COMPUTER', 'user', 'shivani.rastogi15@gmail.com', '12345678', 'active'),
(73, 'Mr. Sachin Arora', 'COMPUTER', 'user', 'sachinarorabareilly@gmial.com', '12345678', 'active'),
(74, 'Ms. Sonali Singh', 'COMPUTER', 'user', 'sonalisinghnky@gmail.com', '12345678', 'active'),
(75, 'Mr. Ritik Saxena', 'COMPUTER', 'user', 'saxenaritik3002@gmail.com', '12345678', 'active'),
(76, 'Ms. Khyati Pancholi', 'COMPUTER', 'user', 'khyatipancholi30@gmail.com', '12345678', 'active'),
(77, 'Ms. Riya Agarwal', 'COMPUTER', 'user', 'agarwalriya1803@gmail.com', '12345678', 'active'),
(78, 'Mr. Ram Mohan Saxena', 'STAFF MEMBERS', 'user', 'rmsaxena1955@gmail.com', '12345678', 'active'),
(79, 'Mr. Shyama Charan', 'STAFF MEMBERS', 'user', 'scmkcmt71@gmail.com', '12345678', 'active'),
(80, 'Mr. Shakeel Ahmad', 'STAFF MEMBERS', 'user', 'shakilbly786@gmail.com', '12345678', 'active'),
(81, 'Mr. Shushant Pandey', 'STAFF MEMBERS', 'user', 'sushantpandey062@gmail.com', '12345678', 'active'),
(82, 'Mr. Abhishek Saxena', 'STAFF MEMBERS', 'user', 'abhisheksaxena652@gmail.com', '12345678', 'active'),
(83, 'Mr. Ranvijay Singh', 'STAFF MEMBERS', 'user', 'ranvijay08singh@rediffmail.com', '12345678', 'active'),
(84, 'Mr. Sumit Kumar', 'STAFF MEMBERS', 'user', 'saxenasumit78@gmail.com', '12345678', 'active'),
(85, 'Ms. Prity Devi', 'STAFF MEMBERS', 'user', 'pritydevi890@gmail.com', '12345678', 'active'),
(86, 'Ms. Mehnaz', 'STAFF MEMBERS', 'user', 'mehnazznsari77@gmail.com', '12345678', 'active'),
(87, 'Tester ', 'COMPUTER', 'user', 'prahlad.singh.education@gmail.com', '12345678', 'active'),
(88, 'Mohit Patel ', 'ZOOLOGY DEPTT.', 'user', 'pmohit645@gmail.com', 'adminmohit', 'active'),
(89, 'Administrator', 'COMPUTER', 'admin', 'administrator@gmail.com', '12345678', 'active'),
(90, 'Rohit Shakya', 'COMPUTER', 'user', 'defence18158920@gmail.com', '12345678', 'active'),
(92, 'Kuldeep Gangwar', 'COMPUTER', 'user', 'gangwarkuldeep442@gmail.com', '12345678', 'active'),
(93, 'Mohit Patel ', 'COMPUTER', 'user', 'mpmohit789@gmail.com', 'Adminmohit', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty_data`
--
ALTER TABLE `faculty_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_fill_data`
--
ALTER TABLE `faculty_fill_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `usersss`
--
ALTER TABLE `usersss`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty_data`
--
ALTER TABLE `faculty_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty_fill_data`
--
ALTER TABLE `faculty_fill_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `usersss`
--
ALTER TABLE `usersss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
