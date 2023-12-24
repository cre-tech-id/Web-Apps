-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 01:16 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matkul`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_courses` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code_courses`, `name`, `sks`, `semester`, `type`, `created_at`, `updated_at`) VALUES
(1, 'c09', 'AI', '3', 'Genap', 'Teori', '2022-06-05 10:44:15', '2022-06-05 10:44:25'),
(2, 'co10', 'kalkul', '3', 'Genap', 'Teori', '2022-06-05 10:44:57', '2022-06-05 10:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_days` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `code_days`, `name_day`, `created_at`, `updated_at`) VALUES
(5, '0506220533107201', 'Senin', '2022-06-05 10:33:10', '2022-06-05 10:33:10'),
(6, '0506220609097556', 'Selasa', '2022-06-05 11:09:09', '2022-06-05 11:09:09'),
(7, '0506220609168154', 'Rabu', '2022-06-05 11:09:16', '2022-06-05 11:09:16'),
(8, '0506220609273562', 'Kamis', '2022-06-05 11:09:27', '2022-06-05 11:09:27'),
(9, '0506220609449458', 'Jum\'at', '2022-06-05 11:09:44', '2022-06-05 11:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_lecturers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nidn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `code_lecturers`, `nidn`, `name`, `email`, `created_at`, `updated_at`) VALUES
(3, '0506220540081160', '0506220540086963', 'alif', 'alif@gmail.com', '2022-06-05 10:40:08', '2022-06-05 10:40:08'),
(4, '0506220550557313', '0506220550558456', 'alif_dsptra', 'alif_dsptra@gmail.com', '2022-06-05 10:50:55', '2022-06-05 10:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_rooms` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `code_rooms`, `name`, `capacity`, `type`, `created_at`, `updated_at`) VALUES
(1, '0506220548447015', 'D4', '30', 'Kelas', '2022-06-05 10:48:44', '2022-06-05 10:48:44'),
(2, '050622054901152', 'D45', '30', 'Kelas', '2022-06-05 10:49:01', '2022-06-05 10:49:01'),
(3, '0506220549284033', 'D3', '40', 'Laboratorium', '2022-06-05 10:49:28', '2022-06-05 10:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `teachs_id` int(10) UNSIGNED NOT NULL,
  `days_id` int(10) UNSIGNED NOT NULL,
  `times_id` int(10) UNSIGNED NOT NULL,
  `rooms_id` int(10) UNSIGNED NOT NULL,
  `type` int(10) DEFAULT NULL,
  `value` double(8,2) DEFAULT NULL,
  `value_process` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachs`
--

CREATE TABLE `teachs` (
  `id` int(10) UNSIGNED NOT NULL,
  `courses_id` int(10) UNSIGNED DEFAULT NULL,
  `lecturers_id` int(10) UNSIGNED DEFAULT NULL,
  `class_room` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teachs`
--

INSERT INTO `teachs` (`id`, `courses_id`, `lecturers_id`, `class_room`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'D4', '2022/2023', '2022-06-05 10:50:23', '2022-06-05 10:50:23'),
(2, 2, 4, 'D3', '2022/2023', '2022-06-05 10:51:15', '2022-06-05 10:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `timedays`
--

CREATE TABLE `timedays` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_timedays` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `days_id` int(10) UNSIGNED DEFAULT NULL,
  `times_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_times` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_begin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_finish` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `range` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sks` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `times`
--

INSERT INTO `times` (`id`, `code_times`, `time_begin`, `time_finish`, `range`, `sks`, `created_at`, `updated_at`) VALUES
(2, '0506220543034568', '16:30', '15:30', '16:30 - 15:30', 3, '2022-06-05 10:43:03', '2022-06-05 10:43:03'),
(3, '0506220607559601', '18:00', '18:30', '18:00 - 18:30', 3, '2022-06-05 11:07:55', '2022-06-05 11:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `time_not_available`
--

CREATE TABLE `time_not_available` (
  `id` int(10) UNSIGNED NOT NULL,
  `lecturers_id` int(10) UNSIGNED DEFAULT NULL,
  `days_id` int(10) UNSIGNED DEFAULT NULL,
  `times_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$hlH9ecuHuFUxUjs4j4k1guSjlDZS7OtqK8sSIsJWSH2mc3ncskNlK', 'VZX2ttTR8S9sw2vLZBvjnhA6P5KzT4c2EI7qWMkiBnNLfrXjXRkmMN6HuQfs', '2016-10-30 07:32:57', '2016-11-17 06:38:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lecturers_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_teachs_id_foreign` (`teachs_id`),
  ADD KEY `schedules_days_id_foreign` (`days_id`),
  ADD KEY `schedules_times_id_foreign` (`times_id`),
  ADD KEY `schedules_rooms_id_foreign` (`rooms_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachs`
--
ALTER TABLE `teachs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachs_courses_id_foreign` (`courses_id`),
  ADD KEY `teachs_lecturers_id_foreign` (`lecturers_id`);

--
-- Indexes for table `timedays`
--
ALTER TABLE `timedays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timedays_days_id_foreign` (`days_id`),
  ADD KEY `timedays_times_id_foreign` (`times_id`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_not_available`
--
ALTER TABLE `time_not_available`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_not_available_lecturers_id_foreign` (`lecturers_id`),
  ADD KEY `time_not_available_days_id_foreign` (`days_id`),
  ADD KEY `time_not_available_times_id_foreign` (`times_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachs`
--
ALTER TABLE `teachs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timedays`
--
ALTER TABLE `timedays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `time_not_available`
--
ALTER TABLE `time_not_available`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_days_id_foreign` FOREIGN KEY (`days_id`) REFERENCES `days` (`id`),
  ADD CONSTRAINT `schedules_rooms_id_foreign` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `schedules_teachs_id_foreign` FOREIGN KEY (`teachs_id`) REFERENCES `teachs` (`id`),
  ADD CONSTRAINT `schedules_times_id_foreign` FOREIGN KEY (`times_id`) REFERENCES `times` (`id`);

--
-- Constraints for table `teachs`
--
ALTER TABLE `teachs`
  ADD CONSTRAINT `teachs_courses_id_foreign` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `teachs_lecturers_id_foreign` FOREIGN KEY (`lecturers_id`) REFERENCES `lecturers` (`id`);

--
-- Constraints for table `timedays`
--
ALTER TABLE `timedays`
  ADD CONSTRAINT `timedays_days_id_foreign` FOREIGN KEY (`days_id`) REFERENCES `days` (`id`),
  ADD CONSTRAINT `timedays_times_id_foreign` FOREIGN KEY (`times_id`) REFERENCES `times` (`id`);

--
-- Constraints for table `time_not_available`
--
ALTER TABLE `time_not_available`
  ADD CONSTRAINT `time_not_available_days_id_foreign` FOREIGN KEY (`days_id`) REFERENCES `days` (`id`),
  ADD CONSTRAINT `time_not_available_lecturers_id_foreign` FOREIGN KEY (`lecturers_id`) REFERENCES `lecturers` (`id`),
  ADD CONSTRAINT `time_not_available_times_id_foreign` FOREIGN KEY (`times_id`) REFERENCES `times` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
