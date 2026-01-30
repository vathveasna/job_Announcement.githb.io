-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2026 at 06:57 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `post_job`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `job_nature` varchar(50) NOT NULL,
  `vacancy` int(11) NOT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `job_type` varchar(50) DEFAULT 'Full Time',
  `description` text NOT NULL,
  `benefits` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `category`, `job_nature`, `vacancy`, `salary`, `location`, `job_type`, `description`, `benefits`, `image`, `created_at`) VALUES
(7, 'TI', 'IT', 'Full Time', 7, '300', 'choy chongVar', 'Full Time', 'Abaetnt', 'anwym', NULL, '2026-01-23 17:39:02'),
(8, 'Design', 'Design', 'Part Time', 2, '150', 'Phnom Penh ', 'Full Time', 'haee5n', 'ver35neb', NULL, '2026-01-23 17:47:40'),
(9, 'IT, Research and Development', 'Information Technology', 'Full Time', 3, '300', ' [ORUSSEY]', 'Full Time', ' Responsibilities\r\n\r\n1. IT Support \r\n	â€¢	Install, maintain, and troubleshoot computers, software, and network basics\r\n	â€¢	Support office staff with daily IT issues\r\n	â€¢	Prepare technical setups for sales and demonstrations\r\n\r\n2. Customer Technical Support\r\n	â€¢	Assist customers with product installation and troubleshooting\r\n	â€¢	Provide clear, professional after-sales support\r\n	â€¢	Solve customer technical problems quickly and efficiently\r\n\r\n3. Creative / Design Tasks\r\n	â€¢	Make simple designs for social media, brochures, and product images\r\n	â€¢	Support marketing and sales with visual content\r\n	â€¢	Edit images and promotional materials\r\n\r\n4. R&D Support / Research & Problem-Solving\r\n	â€¢	Research solutions to technical issues and help improve products\r\n	â€¢	Test new products or features and report results', ' Job Summary\r\nWe are looking for a versatile and proactive candidate who is strong in IT support, design tasks, and research/problem-solving. This role also supports our customers with technical issues.\r\n', NULL, '2026-01-24 12:29:34'),
(10, 'IT, Research and Development', 'Information Technology', 'Full Time', 3, '300', ' [ORUSSEY]', 'Full Time', ' Responsibilities\r\n\r\n1. IT Support \r\n	â€¢	Install, maintain, and troubleshoot computers, software, and network basics\r\n	â€¢	Support office staff with daily IT issues\r\n	â€¢	Prepare technical setups for sales and demonstrations\r\n\r\n2. Customer Technical Support\r\n	â€¢	Assist customers with product installation and troubleshooting\r\n	â€¢	Provide clear, professional after-sales support\r\n	â€¢	Solve customer technical problems quickly and efficiently\r\n\r\n3. Creative / Design Tasks\r\n	â€¢	Make simple designs for social media, brochures, and product images\r\n	â€¢	Support marketing and sales with visual content\r\n	â€¢	Edit images and promotional materials\r\n\r\n4. R&D Support / Research & Problem-Solving\r\n	â€¢	Research solutions to technical issues and help improve products\r\n	â€¢	Test new products or features and report results', ' Job Summary\r\nWe are looking for a versatile and proactive candidate who is strong in IT support, design tasks, and research/problem-solving. This role also supports our customers with technical issues.\r\n', NULL, '2026-01-24 12:30:40'),
(11, 'PHP Developer', '', 'Full-time', 0, '$800 - $1200', 'Phnom Penh', 'Full Time', '', NULL, NULL, '2026-01-24 12:44:48'),
(12, 'UI Designer', '', 'Part-time', 0, '$500 - $700', 'Remote', 'Full Time', '', NULL, NULL, '2026-01-24 12:44:48'),
(14, 'IT Support', 'Information Technology', 'Full Time', 2, '250', 'Sangkat Toul Sangkea 2, Khan Russy Keo,', 'Full Time', 'áž•áŸ‚áž“áž€áž¶ážšáž›áž¾áž€áž¶ážšážáŸ‚áž‘áž¶áŸ† Virtualization áž“áž·áž„ Storage\r\n-	Configuring áž“áž·áž„ážáŸ†áž¡áž¾áž„áž§áž”áž€ážšážŽáŸ network (routers, switches, firewalls, VPN,)\r\n-	áž€áž¶ážšážáŸ‚áž‘áž¶áŸ† network áž“áž·áž„áž€áž¶ážš upgrades system \r\n-	áž‚áŸ’ážšáž”áŸ‹áž‚áŸ’ážšáž„ áž“áž·áž„áž’áž¶áž“áž¶áž”áŸ’ážšážŸáž·áž‘áŸ’áž’áž—áž¶áž–ážŸáž»ážœážáŸ’ážáž·áž—áž¶áž–ážáž¶ážŠáž¼áž…áž‡áž¶ firewalls, anti-virus, áž“áž·áž„áž”áŸ’ážšáž–áŸáž“áŸ’áž’ intrusion detection \r\n-	ážšáž€áŸ’ážŸáž¶áž‘áž»áž€áž“áž¼ážœáž§áž”áž€ážšážŽáŸ Hardware, Software, User Profiles áž‘áž¶áŸ†áž„áž¢ážŸáŸ‹\r\n-	áž”áž“áŸ’ážážáž¶áž˜ážŠáž¶áž“ áž“áž·áž„áž’áŸ’ážœáž¾áž”áž…áŸ’áž…áž»áž”áŸ’áž”áž“áŸ’áž“áž”áž‰áŸ’áž áž¶ User \r\n-	áž†áŸ‚áž€ áž“áž·áž„ážáž¶áž˜ážŠáž¶áž“áž”áŸ’ážšáž–áŸáž“áŸ’áž’hardware áž“áž·áž„ softwareáž€áž»áŸ†áž–áŸ’áž™áž¼áž‘áŸážšáž“áŸ…áž€áŸ’áž“áž»áž„áž“áž¶áž™áž€ážŠáŸ’áž‹áž¶áž“áž‘áž¶áŸ†áž„áž¢ážŸáŸ‹ áž“áž·áž„ážáŸ’ážšáž¼ážœáž…áŸ’áž”áž¶ážŸáŸ‹ážáž¶áž‚áŸ’ážšáž”áŸ‹áž”áž‰áŸ’áž áž¶ážšáž”ážŸáŸ‹áž“áž¶áž™áž€ážŠáŸ’áž‹áž¶áž“áž‘áž¶áŸ†áž„áž¢ážŸáŸ‹áž‚ážºážáŸ’ážšáž¼ážœáž”áž¶áž“ážŠáŸ„áŸ‡ážŸáŸ’ážšáž¶áž™ážšáž½áž…ážšáž¶áž›áŸ‹áŸ”\r\n-	áž€áž¶ážšážšáž€áŸ’ážŸáž¶ PC, network, printer, áž‘áž¼ážšážŸáŸáž–áŸ’áž‘áž›áž¾ážáž», áž˜áŸ‰áž¶ážŸáŸŠáž¸áž“áž•áŸ’ážáž·ážáž˜áŸážŠáŸƒ áž“áž·áž„áž€áž¶áŸ†áž˜áŸážšáŸ‰áž¶ CCTV  \r\n-	ážáŸ’ážšáž¼ážœáž”áŸ’ážšáž¶áž€ážŠážáž¶ážšáž¶áž›áŸ‹áž€áž»áŸ†áž–áŸ’áž™áž¼áž‘áŸážšáž‘áž¶áŸ†áž„áž¢ážŸáŸ‹áž‚ážºážáŸ’ážšáž¼ážœáž”áž¶áž“áž€áž¶ážšáž–áž¶ážšáž–áž¸ážœáž¸ážšáž»ážŸ áž“áž·áž„\r\n-	ážáŸ†áž¡áž¾áž„áž€áž˜áŸ’áž˜ážœáž·áž’áž¸ážŠáŸ‚áž›áž¢áŸ’áž“áž€áž”áŸ’ážšáž¾áž”áŸ’ážšáž¶ážŸáŸ‹ážáŸ’ážšáž¼ážœáž€áž¶ážš áž“áž·áž„ áž’áŸ’ážœáž¾áž”áž…áŸ’áž…áž»áž”áŸ’áž”áž“áŸ’áž“áž—áž¶áž–áž€áž˜áŸ’áž˜ážœáž·áž’áž¸ antivirus\r\n-	ážáŸ‚áž‘áž¶áŸ† printer, scanner, áž˜áŸ‰áž¶ážŸáŸŠáž¸áž“ photo copy áž“áž·áž„ network\r\n-	áž”áž„áŸ’áž€áž¾áž Email outlook, Gmail áž“áž·áž„ internet \r\n-	áž¢áž—áž·ážœážŒáŸ’ážáž“áŸ Website ážšáž”ážŸáŸ‹áž€áŸ’ážšáž»áž˜áž áŸŠáž»áž“ áž áž¾áž™áž’áž¶áž“áž¶ážáž¶áž”áž¶áž“áž’áŸ’ážœáž¾áž”áž…áŸ’áž…áž»áž”áŸ’áž”áž“áŸ’áž“áž—áž¶áž–áŸ”', '', NULL, '2026-01-24 15:51:56'),
(15, 'áž•áŸ’áž“áŸ‚áž€â€‹ IT Operation & Trainer', 'Information Technology', 'Full Time', 1, '$250+', 'BKK Krang Thnong, Saensokh, Phnom Penh', 'Full Time', 'áž›áž€áŸ’ážážážŽáŸ’ážŒ áž‡áŸ’ážšáž¾ážŸážšáž¾ážŸ\r\náŸ¡.â€‹ áž“áž·ážŸáŸ’ážŸáž·ážáž†áŸ’áž“áž¶áŸ†áž‘áž¸ áŸ¤áž¡áž¾áž„áž‘áŸ…\r\náŸ¢. ážšáž½ážŸážšáž¶áž™ážšáž¶áž€áŸ‹áž‘áž¶áž€áŸ‹ áž˜áž¶áž“áž‚áŸ†áž“áž·ážážœáž·áž‡áŸ’áž‡áž˜áž¶áž“ áž“áž·áž„ážšáž áŸážŸážšáž áž½áž“\r\náŸ£. ážŸáŸ’áž˜áŸ„áŸ‡ážáŸ’ážšáž„áŸ‹ áž™áž€áž…áž·ážáŸ’ážáž‘áž»áž€ážŠáž¶áž€áŸ‹áž€áž¶ážšáž„áž¶ážš\r\náŸ¤. áž†áž“áŸ’áž‘áŸ‡ážáŸ’áž–ážŸáŸ‹áž€áŸ’áž“áž»áž„áž€áž¶ážšážšáŸ€áž“ážŸáž¼ážáŸ’ážš áž¢áŸ’ážœáž¸ážŠáŸ‚áž›ážáŸ’áž˜áž¸\r\náŸ¥. áž˜áž¶áž“áž”áŸ’ážšáž¶áž€áŸ‹áž›áž¾áž€áž‘áž¹áž€áž…áž·ážáŸ’ážáž•áŸáŸ’ážŸáž„áŸ—', 'ážŸáž¼áž˜áž•áŸ’áž‰áž¾ CV áž…áž¼áž›áž€áŸ’áž“áž»áž„ â€‹Telegram: https://t.me/anakutjob\r\nðŸ“áž¢áž¶áž‚áž¶ážšáž›áŸáž #666 áž•áŸ’áž›áž¼ážœâ€‹ 128 áž˜áž áž¶ážœáž·ážáž¸áž€áž˜áŸ’áž–áž»áž‡áž¶áž€áŸ’ážšáŸ„áž˜ ážšáž¶áž‡áž’áž¶áž“áž¸áž—áŸ’áž“áŸ†áž–áŸáž‰\r\nEmail: ana******@gmail.comClick To Sent Email', NULL, '2026-01-24 15:54:45'),
(16, 'Senior IT Infrastructure', 'Information Technology', 'Full Time', 1, '$700+', 'hnom Penh Thmei, Saensokh, Phnom Penh', 'Full Time', 'Experience :3Year+\r\nJob Description\r\nâ€¢  Perform the day-to-day operational tasks such as proactive maintenance, monitoring server performance, incident and problem management, backup & recovery across the server operation environment\r\nâ€¢  Lead helpdesk support, making sure all desktop applications, and related systems (CCTV, Alarm, Fire, Access Door, Email, etc.) problems are resolved in a timely manner with limited disruptions\r\nâ€¢  Provide leadership and expertise system and server infrastructure\r\nâ€¢  Manage IT Factory ensure all servers & hardware in Data Center are well managed & monitored, resources utilization, health check of Servers, Email system, File server and other IT systems.\r\nâ€¢  Resolves all technical issues which are related to server hardware, and server operating system\r\nâ€¢  Support on Monitoring server service issue and report to manager/director, and escalation service partners or vendors for resolution\r\nâ€¢  Install and integrate new server hardware, System and applications\r\nâ€¢  Install, configure, and maintain Windows and/or Linux servers (physical and virtual).\r\nâ€¢  Perform regular system monitoring to ensure optimal performance and capacity utilization\r\nâ€¢  Administer virtualization platforms (VMware vSphere/ESXi or equivalent)\r\nâ€¢  Implement and monitor server security policies, access control, and antivirus protection.\r\nâ€¢  Regularly review system logs and respond to potential security incidents.\r\nâ€¢  Maintain accurate documentation of server configurations, network diagrams, and procedures.\r\nâ€¢  Generate regular reports on system performance, capacity, and incident resolution.\r\nâ€¢  Manage server and VM backup jobs using enterprise backup solutions (Veeam)\r\nâ€¢  Manage server patching, updates, and security hardening in compliance with IT security policies.\r\nâ€¢  Manage Windows Server, Active Directory, Domains, DNS and DHCP environment, Exchange Mail server, QuickBooks Server\r\nâ€¢  Supervise, monitor and follow up on all tickets assigned to Technician or Officer\r\nâ€¢  Documenting administration on server service system on both server hardware, system and applications', 'Key Accountabilities \r\nâ€¢  Participate in solution designing, implementing, maintaining, and optimizing the virtual infrastructure, servers, backup software, storage, networks, firewalls, and data center facilities in accordance with business requirement, security policies and regulatory guidelines. \r\nâ€¢  Capacity management/resource monitoring of on-premises virtualization, server, and network infrastructure. \r\nâ€¢  Patch, upgrade, IVA fix, and support security network/system scanning. \r\nâ€¢  Asset up to date and maintain life cycle hardware tech-refresh with planning, budgeting, and propose new solutions to management. \r\nâ€¢  Implement and manage change windows following ITIL process. \r\nâ€¢  Ensures IT compliance and security standard policies. \r\nâ€¢  Response and management of server and network infrastructure incidents. \r\nâ€¢  Kept up to date of On-Premises infrastructure diagram, network segmentation and IP addresses management. \r\nâ€¢  Provide technical consultation on complex projects. \r\nâ€¢  Develop and maintain operational guidelines for maintenance and support of the virtual infrastructure, server and network. \r\nâ€¢  Actively coordinate with other third parties and vendors. \r\n', NULL, '2026-01-25 08:47:10');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_applied`
--

CREATE TABLE `jobs_applied` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `job_type` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `applicants_count` int(11) DEFAULT NULL,
  `status` enum('Active','Pending','Expired') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_applied`
--

INSERT INTO `jobs_applied` (`id`, `user_id`, `title`, `job_type`, `location`, `date_created`, `applicants_count`, `status`) VALUES
(2, 0, 'UI/UX Designer', 'Part-time', 'Delhi', '2023-08-13', 20, 'Pending'),
(3, 0, 'Full Stack Developer', 'Fulltime', 'Noida', '2023-09-27', 278, 'Expired'),
(4, 0, 'Developer for IT company', 'Fulltime', 'Goa', '2023-02-14', 70, 'Active'),
(6, 2, 'IT Support', 'Full Time', 'Sangkat Toul Sangkea 2, Khan Russy Keo,', '2026-01-26', 0, 'Pending'),
(7, 2, 'Senior IT Infrastructure', 'Full Time', 'hnom Penh Thmei, Saensokh, Phnom Penh', '2026-01-26', 0, 'Pending'),
(8, 1, 'IT Support', 'Full Time', 'Sangkat Toul Sangkea 2, Khan Russy Keo,', '2026-01-26', 0, 'Pending'),
(9, 2, 'áž•áŸ’áž“áŸ‚áž€â€‹ IT Operation & Trainer', 'Full Time', 'BKK Krang Thnong, Saensokh, Phnom Penh', '2026-01-27', 0, 'Pending'),
(10, 2, 'IT, Research and Development', 'Full Time', ' [ORUSSEY]', '2026-01-27', 0, 'Pending'),
(11, 2, 'TI', 'Full Time', 'choy chongVar', '2026-01-27', 0, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `cv_filename` varchar(255) NOT NULL,
  `cover_letter` text,
  `status` enum('pending','reviewed','rejected','accepted') DEFAULT 'pending',
  `applied_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `name`, `role`, `email`, `password`, `profile_pic`) VALUES
(1, NULL, 'veasna', 'user', 'snazy99@gmail.com', '$2y$10$zZNcqL2bDRI4zNwttiQg.ub0kl.4bEzx6dFCM3ewapxSlE//1qA9q', 'default.png'),
(2, 'snazyy', 'snazy', '', 'snaz68@gmail.com', '$2y$10$JKbWd1h9uS2/vIc96qoRTee6PGL8J68Uq0dSFnZmYBtgN/fHNWAra', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_applied`
--
ALTER TABLE `jobs_applied`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jobs_applied`
--
ALTER TABLE `jobs_applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
