-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 23 Okt 2024 pada 18.34
-- Versi server: 10.6.18-MariaDB-cll-lve
-- Versi PHP: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpqmvvui_portfolio`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `backward_link` varchar(255) NOT NULL,
  `forward_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `about`
--

INSERT INTO `about` (`id`, `name`, `role`, `description`, `image_url`, `backward_link`, `forward_link`) VALUES
(1, 'Muhammad Ellbendl Satria', 'Undergraduate Informatics Student', 'I am an Undergraduate Informatics Student at Pembangunan Jaya University, driven by a profound interest in artificial intelligence (AI). My academic focus centers on the exciting fields of deep learning, machine learning, and neural networks. These areas fascinate me due to their potential to revolutionize technology by enabling machines to recognize complex patterns and make intelligent predictions, pushing the boundaries of what\'s possible in computer science. Outside of my studies, I\'m an enthusiastic gamer, finding both enjoyment and inspiration in the intricate worlds of video games. This hobby not only provides entertainment but also fuels my creativity and problem-solving skills, which I apply to my academic pursuits. My passion for AI extends beyond the classroom, as I constantly seek to stay updated on the latest advancements in the field, exploring new algorithms and discussing the ethical implications of AI in our rapidly evolving technological landscape.', 'assets/profile.png', 'index.php', 'skills.php');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contacts`
--

INSERT INTO `contacts` (`id`, `first_name`, `last_name`, `email`, `message`, `created_at`) VALUES
(1, 'Muhammad Ellbendl', 'Satria', 'mellbendlsatria@gmail.com', 'Hello', '2024-10-19 00:37:53'),

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact_metadata`
--

CREATE TABLE `contact_metadata` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `backward_link` varchar(255) NOT NULL,
  `forward_link` varchar(255) NOT NULL,
  `github_link` varchar(255) NOT NULL,
  `linkedin_link` varchar(255) NOT NULL,
  `instagram_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contact_metadata`
--

INSERT INTO `contact_metadata` (`id`, `title`, `backward_link`, `forward_link`, `github_link`, `linkedin_link`, `instagram_link`) VALUES
(1, 'Contact', 'projects.php', 'index.php', 'https://github.com/DecX-x', 'https://linkedin.com/in/muhammad-ellbendl-satria-30a083296/', 'https://www.instagram.com/ellbendls/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero_section`
--

CREATE TABLE `hero_section` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hero_section`
--

INSERT INTO `hero_section` (`id`, `name`, `description`, `link`) VALUES
(1, 'Muhammad Ellbendl Satria', 'Informatics undergrad @ Pembangunan Jaya Uni. AI enthusiast. Making machines smarter, one algorithm at a time!', 'about.php');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `menu` varchar(10) NOT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu`, `url`) VALUES
('Home', 'index.php'),
('About', 'about.php'),
('Skills', 'skills.php'),
('Projects', 'projects.php'),
('Contact', 'contact.php');

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `github_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `thumbnail`, `github_link`) VALUES
(1, 'Stock Price Prediction', 'This project uses Long Short-Term Memory (LSTM) networks to predict stock prices. It features an ETL (Extract, Transform, Load) pipeline, model building, prediction, and evaluation functionalities, all wrapped in a Streamlit web application.', 'assets/project1.gif', 'https://github.com/DecX-x/LSTM_Stock-Prediction'),
(2, 'Intellichat', 'AI chat with your own twist. Chat with open-source AI & access your data in real-time to get tasks done faster.', 'assets/project2.gif', '#'),
(3, 'License Plate Detection', 'This project provides a license plate detection and recognition system using YOLOv8. It captures video from your webcam, identifies license plates, and displays bounding boxes around them in real-time.', 'assets/project3.png', 'https://github.com/DecX-x/License_Plate_Detection'),
(4, 'Brain Tumor Detection', 'This project utilizes a YOLO (You Only Look Once) model for the detection of brain tumors from MRI images. The project involves preprocessing data, setting up directories, and training a YOLO model using the Ultralytics YOLOV8 framework.', 'assets/project4.png', 'https://github.com/DecX-x/Brain-Tumor_Detection'),
(5, 'Handwritten Digit Recognition from Sketch Input', 'This project implements a convolutional neural network (CNN) to recognize handwritten digits from sketch inputs using the MNIST dataset.', 'assets/project5.gif', 'https://github.com/DecX-x/hdigitsrecognition');

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects_metadata`
--

CREATE TABLE `projects_metadata` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `backward_link` varchar(255) NOT NULL,
  `forward_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `projects_metadata`
--

INSERT INTO `projects_metadata` (`id`, `title`, `backward_link`, `forward_link`) VALUES
(1, 'Projects', 'skills.php', 'contact.php');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL,
  `skill_percent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `skills`
--

INSERT INTO `skills` (`id`, `skill_name`, `skill_percent`) VALUES
(1, 'Python', 80),
(2, 'Html/Css', 60),
(3, 'Php', 50),
(4, 'Tensorflow', 75),
(5, 'Pytorch', 75),
(6, 'React', 55),
(7, 'Javascript', 60),
(8, 'Solidity', 50),
(9, 'Flutter/Dart', 60);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skills_metadata`
--

CREATE TABLE `skills_metadata` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `backward_link` varchar(255) NOT NULL,
  `forward_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `skills_metadata`
--

INSERT INTO `skills_metadata` (`id`, `title`, `backward_link`, `forward_link`) VALUES
(1, 'My Skills', 'about.php', 'projects.php');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contact_metadata`
--
ALTER TABLE `contact_metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hero_section`
--
ALTER TABLE `hero_section`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `projects_metadata`
--
ALTER TABLE `projects_metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `skills_metadata`
--
ALTER TABLE `skills_metadata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `contact_metadata`
--
ALTER TABLE `contact_metadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `hero_section`
--
ALTER TABLE `hero_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `projects_metadata`
--
ALTER TABLE `projects_metadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `skills_metadata`
--
ALTER TABLE `skills_metadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
