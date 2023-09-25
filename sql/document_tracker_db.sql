-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 25, 2023 at 06:55 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `document_tracker_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int NOT NULL,
  `code` varchar(45) NOT NULL,
  `department` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `location` varchar(150) NOT NULL,
  `token` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `is_deleted` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `code`, `department`, `username`, `password`, `location`, `token`, `created`, `updated`, `is_deleted`) VALUES
(1, 'CDRRMO', 'CITY DISASTER RISK REDUCTION MNGT. OFFICE', 'CDRRMO', '$2y$10$ygm51.BobWtfnmdTPI8F/OnnYYPD/Jd08FBKktQ73JJIxOm..lL7y', '', '', '2023-05-09 18:26:56', NULL, 0),
(2, 'EEMO', 'OFFICE OF THE ECONOMIC ENTERPRISES AND MANAGEMENT(C)', 'EEMO', '$2y$10$qGdGtTV3VhVl3xUc55.sTehoM8AINFBAPtJIPIQXuwkekhBXN7hcK', '', '', '2023-05-09 18:27:38', NULL, 0),
(3, 'PDAO', 'PERSONS WITH DISABILITY AFFAIRS OFFICE', 'PDAO', '$2y$10$.O6Jfac2KrvjtLG2rNH39Onh/mvIF1A9rHzJIA.XO3HzX44fsf2aC', '', '', '2023-05-09 18:28:43', NULL, 0),
(4, 'CAPDO', 'OFFICE ON ARCHITECTURAL PLANNING AND DESIGN', 'CAPDO', '$2y$10$gVAqgdfKpfq.uFk8neh12uE/bRciiqXoaHa8KgEuWy/gajuF7RVcm', '', '', '2023-05-09 18:32:21', NULL, 0),
(5, 'VETERINARY', 'OFFICE ON VETERINARY SERVICES', 'VETERINARY', '$2y$10$Vp4F2yddhJrojVCdLw6L0ej5kHwWmIEnxKh2EO1egaVoJasU1ECke', '', '', '2023-05-09 18:32:39', NULL, 0),
(6, 'CICLEDO', 'CITY OF IMUS COOPERATIVE LIVELIHOOD AND ENTREPRENEURIAL  DEVELOPMENT OFFICE', 'CICLEDO', '$2y$10$77jpSXNqdLBr33EdUwq8HeCV.45xgbatDPkQf6F1vJ1uU4/Uo7wTG', '', '', '2023-05-09 18:33:02', NULL, 0),
(7, 'TOURISM', 'CITY TOURISM AND HERITAGE OFFICE', 'TOURISM', '$2y$10$RVwsHH8BH6FTnUZU177wIe3z/2Wvdh/A9zVt1y.f.Uk11KL6vRemG', '', '', '2023-05-09 18:33:11', NULL, 0),
(8, 'TRU', 'OFFICE OF THE MAYOR: TRICYCLE REGULATORY UNIT', 'TRU', '$2y$10$5bzAni0LAFag1WiZGxp9ped3NKnn18i4lEfOBYArXGYknzmlifCqa', '', '', '2023-05-09 18:33:27', NULL, 0),
(9, 'LIBRARY', 'OFFICE OF THE MAYOR: CITY PUBLIC LIBRARY', 'LIBRARY', '$2y$10$WM2YXo.x2nQ9zEhMbqpgVu36bD4.B7cuV77u45y5g6VPul.uXOxiK', '', '', '2023-05-09 18:33:40', NULL, 0),
(10, 'ECONOMIC', 'OFFICE OF THE ECONOMIC ENTERPRISES AND MANAGEMENT(B)', 'ECONOMIC', '$2y$10$5dAfYEQ9zmV2rjDcyibNFeGNeCXlqd.Jwlu4EC/OIbNOQZiK9iXe.', '', '', '2023-04-16 21:40:28', NULL, 0),
(11, 'GSO', 'GENERAL SERVICES OFFICE', 'GSO', '$2y$10$iPKLjAKZdCzhiiRRIgo5JutXheeK4Hq62Nab9CESAYpfcfcnwOCC6', '', '', '2023-05-09 18:34:37', NULL, 0),
(12, 'POLYTECHNIC', 'IMUS POLYTECHNIC INSTITUTE', 'POLYTECHNIC', '$2y$10$ynl5k.ttvYGgYflnRV46A.pBZptHscqV4Syqe/Vc6/xOzMNfcxcXi', '', '', '2023-04-16 21:40:29', NULL, 0),
(13, 'POPDEV', 'OFFICE ON POPULATION DEVELOPMENT', 'POPDEV', '$2y$10$RFoFsqUTCHBKq61HsfgGWeS3h4gPnfAwZ2I.SHObfj4EZCT.525BK', '', '', '2023-05-09 18:35:02', NULL, 0),
(14, 'ADMIN', 'OFFICE OF THE CITY  ADMINISTRATOR', 'ADMIN', '$2y$10$/cdscq0HW.ArgLAGRA9xquO7O8F3FsPvS/GkZE11LJfPr5ApKUAEG', '', '', '2023-05-09 18:35:07', NULL, 0),
(15, 'OSCA', 'OFFICE OF THE MAYOR: OFFICE OF THE SENIOR CITIZENS AFFAIRS', 'OSCA', '$2a$12$TMCQQ9tdZPVbwbZTK/V1k.43L7Vk5CM1yh9TAv4JXqUTbZCpqdMke', '', '', '2023-05-09 18:35:43', NULL, 0),
(16, 'LEDIPO', 'LOCAL ECONOMIC DEVELOPMENT AND INVESTMENT PROMOTION OFFICE', 'LEDIPO', '$2y$10$hT/AdRLwrG22VBIQBO.7v.5cpRT7Nxbqn87lXAkUkALaMrqI0JLI.', '', '', '2023-05-09 18:35:52', NULL, 0),
(17, 'YOUTH', 'CITY YOUTH AFFAIRS OFFICE', 'YOUTH', '$2y$10$iEmGX7FpXp7Sfr6Hxaa94upd9GCMQwycmBp1/JjzA3Lx4Es8LqObq', '', '', '2023-05-09 18:36:03', NULL, 0),
(18, 'ONI', 'CITY HOSPITAL OF IMUS', 'ONI', '$2a$12$CK1Zug2K1ICDnqMyVGW/ZuPHH.NP2W4oWc6yknRvDmpyV1aFPv1Ti', '', '', '2023-05-09 18:36:16', NULL, 0),
(19, 'PARKS', 'OFFICE OF THE MAYOR: CITY PARKS & HISTORICAL PLACES', 'PARKS', '$2y$10$bWMN4pZD7ws8M/j2c8eTT.ii2ELOX3W5f80hA7/QIbnXgSmi0508y', '', '', '2023-05-09 18:36:30', NULL, 0),
(20, 'PESO', 'OFFICE OF THE MAYOR: CITY PUBLIC EMPLOYMENT SERVICES', 'PESO', '$2y$10$Z9rkYRexLGE84OuAOPb9EOlo7U6k.v3t/b4otmjfRvbETH27UGoGi', '', '', '2023-05-09 18:36:37', NULL, 0),
(21, 'GAD', 'OFFICE OF THE MAYOR: GENDER & DEVELOPMENT UNIT', 'GAD', '$2y$10$rax8E0eGqOD6wEzsRVmZJ.bW/ZnZCSGw9OWa0B00VFk3XlWKZ49ES', '', '', '2023-05-09 18:36:56', NULL, 0),
(22, 'EXTENSION', 'OFFICE OF THE MAYOR: EXTENSION OFFICE', 'EXTENSION', '$2y$10$ceebgihEAj4qp9v1i1lFsu8vSl2gxo6/xebLca8Lzlnq8U5GsAJSy', '', '', '2023-05-09 18:37:04', NULL, 0),
(23, 'FACILITY', 'IMUS ISOLATION FACILITY', 'FACILITY', '$2y$10$XRb7w2GdrPes2iF//F8uJe5YbaRtsILqvfvnPnYOCxqwOORJe40Pa', '', '', '2023-04-16 21:40:29', NULL, 0),
(24, 'LABORATORY', 'OFFICE ON HEALTH SERVICES:  MOLECULAR LABORATORY', 'LABORATORY', '$2y$10$L8ag.cQRdrxNWOzzVHZMd.JCC9U0k4UN8AMngdClXj8HbYb/mKKru', '', '', '2023-04-16 21:40:29', NULL, 0),
(25, 'SKO', 'OFFICE OF THE CITY MAYOR: SANGGUNIANG KABATAAN', 'SKO', '$2y$10$nSA5DyBCh8xHFpZvWSWrdegLducMWdU8xvOyIJVUGB5OGEBxrUcNC', '', '', '2023-07-10 20:28:10', NULL, 0),
(26, 'CITRMU', 'OFFICE OF THE MAYOR: CITY OF IMUS INFORMATION TECHNOLOGY & RECORDS MANAGEMENT UNIT', 'CITRMU', '$2y$10$Eb3gyM5HWYHgcq6skMMfP.4i4dTysjQgySFBR7etpS9SR8WCZWyeG', '', '', '2023-05-09 18:38:04', NULL, 0),
(27, 'CENRO', 'OFFICE ON ENVIRONMENT AND NATURAL RESOURCES', 'CENRO', '$2y$10$y41mSXZx8wp6NIej.WY3W.s1Ng0epkMfwQooesukt9PILXZdoTzUu', '', '', '2023-05-09 18:38:30', NULL, 0),
(28, 'BPLO', 'BUSINESS PERMIT AND LICENSING OFFICE', 'BPLO', '$2y$10$hICRhW1f/kJ74YxLPh.Su./aZlZOtTdC5fDyApSsTNX1lG9kw3CR.', '', '', '2023-05-09 18:38:18', NULL, 0),
(29, 'HRMO', 'HUMAN RESOURCE MANAGEMENT OFFICE', 'HRMO', '$2y$10$i2q4yhTSdLBbL.EE6SiqkOrOSQdLH6gbHQlodZeNyObZK69UhdPbO', '', '', '2023-05-09 18:38:35', NULL, 0),
(30, 'CIO', 'OFFICE OF THE MAYOR: CITY INFORMATION OFFICE', 'CIO', '$2y$10$SdJ46jQRfh1gSKs9kAtOfelXm.QAf9Yamk8Zj6QqDIniha0qf7fpO', '', '', '2023-05-09 18:38:38', NULL, 0),
(31, 'CSU', 'OFFICE OF THE MAYOR: SECURITY UNIT', 'CSU', '$2y$10$p4cXwMm1WCIl3gpdTyjYRuXyHsR3ZG4gVX0nNoGWPucummuLekdU6', '', '', '2023-06-14 20:32:05', NULL, 0),
(32, 'EDUCATION', 'OFFICE OF THE MAYOR: SPECIAL SERVICES (EDUCATION) ', 'EDUCATION', '$2y$10$HYjXcWzBzd5aQ1kTT6W8XOdt.PehCKME4iBoREYzwL5IHl8qLgDZC', '', '', '2023-04-16 21:40:29', NULL, 0),
(33, 'TRAFFIC', 'OFFICE OF THE MAYOR: TRAFFIC MANAGEMENT UNIT', 'TRAFFIC', '$2y$10$WZMGr3W5Rg.Evz5jRe0mf.OZxCkqTZms0hgtdZo8gmKONa0JexoE6', '', '', '2023-04-16 21:40:29', NULL, 0),
(34, 'ECONOMIC', 'OFFICE OF THE MAYOR: ECONOMIC ENTERPRISE MANAGEMENT (A)', 'ECONOMIC', '$2y$10$hDYfy2JLvdFS5aU4skWQhe2s2IrYNonfTB08v363f2meswCmC7n9C', '', '', '2023-04-16 21:40:29', NULL, 0),
(35, 'ACCOUNTING', 'OFFICE ON ACCOUNTING & INTERNAL AUDIT SERVICES', 'ACCOUNTING', '$2y$10$jT5.n69kRUUZdOs8AwStMeftEkugxoNAULZ8uCvV61J8WMRfAwNMa', '', '', '2023-06-15 15:54:09', NULL, 0),
(36, 'AGRICULTURE', 'OFFICE ON AGRICULTURAL SERVICES', 'AGRICULTURE', '$2y$10$stlISvySAdJ9SB/bfEEC6OWE6qV5rQHXscEpGQ2/aNMOVE5Vqm5fe', '', '', '2023-06-15 15:54:02', NULL, 0),
(37, 'ASSESSOR', 'CITY ASSESSOR OFFICE', 'ASSESSOR', '$2y$10$c0tygIBAZElDAdZ3itgMVOHuZHeUZnEBKDFvb2Yfx3ei7fOU7HsOe', '', '', '2023-05-09 18:39:16', NULL, 0),
(38, 'BUDGET', 'CITY BUDGET OFFICE', 'BUDGET', '$2y$10$9rYCS7KDF3twZrQjaEN4Xu.fsOiBGd4RDgwV08qM.Cwb5GvebsoRy', '', '', '2023-05-09 18:39:25', NULL, 0),
(39, 'CCRO', 'OFFICE OF CIVIL REGISTRY', 'CCRO', '$2y$10$fF57TkZgoHpgSaTnF4ncCO0BaS0Mv9mlNQyexyefBWi/Dy9/xsOSK', '', '', '2023-05-09 18:39:38', NULL, 0),
(40, 'ENGINEERING', 'CITY ENGINEERING OFFICE', 'ENGINEERING', '$2y$10$LnXy7uHTbe5FXeseUVA8UeUPjcqxHIvZ2Ly3mgqPZTyi0BV7mi5yy', '', '', '2023-05-09 20:21:23', NULL, 0),
(41, 'HEALTH', 'OFFICE ON HEALTH SERVICES', 'HEALTH', '$2y$10$KBfPzxzvSBNxF7tXEXpqzOKERBNHFWYmeqslAghjLL05QUwgOmyUW', '', '', '2023-06-15 15:53:46', NULL, 0),
(42, 'LEGAL', 'OFFICE FOR LEGAL SERVICES', 'LEGAL', '$2y$10$Q7UEJRbVnAzOlRqo/nI7cOHrSbXaQrFcx1x7jVKNCe4zULcY3bYpW', '', '', '2023-05-09 18:40:45', NULL, 0),
(43, 'MAYOR', 'OFFICE OF THE CITY MAYOR', 'MAYOR', '$2y$10$wIIcqufnMjVeb7288/FmxuqjAxR7BEQC8QkXULGH2XKzJkhLaCCQa', '', '', '2023-05-09 20:38:40', NULL, 0),
(44, 'CPDO', 'CITY PLANNING AND DEVELOPMENT OFFICE', 'CPDO', '$2y$10$vupyIsRLGbqyWQ68Hz.EheQqmTbqBzERZlOZeY.72leom9GHDxaLW', '', '', '2023-05-09 20:38:35', NULL, 0),
(45, 'CSWDO', 'OFFICE ON SOCIAL WELFARE AND DEVELOPMENT SERVICES', 'CSWDO', '$2y$10$lO5HAAVvBGs1fGZ95BR3ZuByzPNEbL79pqXo8SDaPJoX4J8f4w1va', '', '', '2023-05-09 18:41:07', NULL, 0),
(46, 'CTO', 'CITY TREASURY OFFICE', 'CTO', '$2y$10$Frqc12sNq1nTVgmLHqWYTO3aU2XdMk96yS6kq9G/FKpjnSUAGzREm', '', '', '2023-05-09 18:41:13', NULL, 0),
(47, 'OBO', 'OFFICE OF THE CITY BUILDING OFFICIAL', 'OBO', '$2y$10$bND9l9xb6sQNJj1UAXII5ursp1Nl6XwO3teWGghaFFLMvt3.YHwNe', '', '', '2023-05-09 18:41:19', NULL, 0),
(48, 'SPO', 'SANGGUNIANG PANLUNGSOD OFFICE', 'SPO', '$2y$10$qGvxdKZ/NN0djXjgOiejsuAfII7R.ho1nQibYxoA9qs8u/pp3XuLO', '', '', '2023-06-15 15:53:31', NULL, 0),
(49, 'VMO', 'CITY VICE-MAYOR OFFICE ', 'VMO', '$2a$12$PcBRbujznsVTT0LhgRm6xO6KcyUEF5Dn4Neaerk.q8ZXFHvWyrF72', '', '', '2023-06-15 15:53:37', NULL, 0),
(50, 'SPORTS', 'OFFICE OF THE MAYOR: SPORTS UNIT', 'SPORTS', '$2y$10$HPRHgkSfUNSAfJROWi6LTOQo5N2aEOHv8P9MLRxUwCazLs.3LcCU.', '', '', '2023-05-09 18:41:39', NULL, 0),
(51, 'SCHOOL', 'LOCAL SCHOOL BOARD', 'SCHOOL', '$2y$10$uRu06dHywy8qseAwxDI8y.zn2yDHpAj4TCpHReqezDRh8pGCHJjDe', '', '', '2023-04-16 21:40:30', NULL, 0),
(52, 'BFP', 'BUREAU OF FIRE PROTECTION', 'BFP', '$2y$10$/OoE6jFd.vRCul8BACE2/eSuGLn1M/i3a2NoCYnlsekbFmc1RmWrG', '', '', '2023-05-09 18:41:55', NULL, 0),
(53, 'CONGRESSMAN', 'OFFICE OF THE CONGRESSMAN', 'CONGRESSMAN', '$2y$10$0c0kGDT6F.ZPPEHu.pr0S.Jl0lyC.1kJhalimMZ0pHZosFmyVpeJu', '', '', '2023-06-13 16:19:39', NULL, 0),
(54, 'DILG', 'DEPARTMENT OF INTERIOR LOCAL GOVERNMENT', 'DILG', '$2y$10$CSHNEwwPje0vjkT4s4JjOuJdqip7w/HmJHdSaDqaWSgl5hPfqv/DW', '', '', '2023-06-14 20:37:46', NULL, 0),
(55, 'AIMHAI', 'ANGAT IMUS HOMEOWNERS ALLIANCE, INC', 'AIMHAI', '$2y$10$3EL2p5.lWf4uubXSZskK6.0T00d1yeV/ZklV4AMZ1C3OZD/1T9WYK', '4TH FLOOR', '', '2023-07-23 21:05:28', NULL, 0),
(56, 'COA', 'COMMISSION ON AUDIT', 'COA', '$2y$10$3gdY95Vtyc4YXVG2xMEqW.RQJdVhMajeRFmJB/ciNDL7b0N3xt/pS', '3RD FLOOR', '', '2023-07-23 23:14:14', NULL, 0),
(58, 'CSO', 'CIVIL SOCIETY  ORGANIZATION OFFICE', 'CSO', '$2a$12$EptXg9VBN1zo2CcD2gAIXe8MOSPtRI7wANvuTDJyw5gsVO6nwLTAm', '4TH FLOOR', '', '2023-07-23 23:13:56', '2023-07-02 22:21:33', 0),
(59, 'ABC', 'ABC/LIGA NG MGA BARANGAY NG IMUS', 'ABC', '$2y$10$VzXH7VdHrIDdWH4B7YT5eeIAKrF/cQ3a9Qa8D4HC4cs8tgOt/4oQS', '5TH FLOOR', '', '2023-07-04 15:54:28', NULL, 0),
(60, 'POPS', 'PEACE AND ORDER', 'POPS', '$2y$10$pw6a5WVNJ8czw9PdLwVXkeHTgUUes6vf3voEJ0xDjlnnyTPeyvDRS', '4TH FLOOR', '', '2023-07-23 23:14:27', '2023-07-05 15:35:12', 0),
(61, 'BAC', 'BIDS AND AWARDS COMMITTEE', 'BAC', '$2y$10$qTWo2WiJH2lrAWmpgB7hQ.QAk4NyZGZAOB.XH.QVocM7Wfntc7Z6a', '4TH FLOOR', '', '2023-07-23 21:05:37', NULL, 0),
(63, 'LHO', 'LOCAL HOUSING OFFICE', 'LHO', '$2y$10$V9QKIzK5FQnt./Ri5wvYvuCW85sQJNyW7onwO3mHx1s0dDwj4NYe2', 'UPPER GROUND', '', '2023-07-10 21:24:39', NULL, 0),
(64, 'RECORDS', 'SP SECRETARY/ RECORDS', 'RECORDS', '$2y$10$y5wCz3jYhjDXiDpJmV.ErObM67fCvNUsLBUxsWi6iIROf9InqhZK6', '5TH FLOOR', '', '2023-07-23 23:14:42', NULL, 0),
(76, 'CITF', 'CITY OF IMUS TASK FORCE FOR ROAD CLEARING', 'CITF', '$2y$10$bCBeWUorQx0wcAeQVGkIPOYvxPmRm725pYHTct4SeEmpaXM1Vk1rm', '', '', '2023-09-10 19:20:56', NULL, 0),
(77, 'SANITARY', 'CITY SANITATION UNIT', 'SANITARY', '$2a$12$FTpDvOnqNEBGBgDd4UMxCO5mGmtBtM97Bt.RU0O7SyaNdCK.QQ9c2', '', '', '2023-09-11 19:02:05', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int NOT NULL,
  `reference` varchar(45) NOT NULL,
  `sender` varchar(45) NOT NULL,
  `document` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `details` text NOT NULL,
  `status` varchar(45) NOT NULL,
  `hidden` int NOT NULL,
  `date` date NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `is_deleted` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `reference`, `sender`, `document`, `type`, `details`, `status`, `hidden`, `date`, `created`, `updated`, `is_deleted`) VALUES
(122, '69940441', 'CSO', 'REQUEST', 'Letter', 'SOLICITATION', 'Ongoing', 0, '2023-09-12', '2023-09-11 21:58:35', NULL, 0),
(121, '76361550', 'CSO', 'REQUEST', 'Letter', 'SOLICITATION', 'Ongoing', 0, '2023-09-12', '2023-09-11 21:57:30', NULL, 0),
(117, '14490897', 'TRAFFIC', 'Voucher', 'Voucher', 'Reimbursement of emission (RD)', 'Ongoing', 0, '2023-09-12', '2023-09-11 19:23:36', NULL, 0),
(116, '41045833', 'CDRRMO', 'Voucher', 'Voucher', 'sample', 'Ongoing', 0, '2023-09-12', '2023-09-11 19:07:03', NULL, 0),
(115, '45014395', 'SPORTS', 'Request Letter', 'Letter', 'cigto request', 'Ongoing', 0, '2023-09-12', '2023-09-11 18:45:39', NULL, 0),
(113, '27358616', 'SPORTS', 'Voucher', 'Voucher', 'Supplies', 'Ongoing', 0, '2023-09-12', '2023-09-11 18:37:23', NULL, 0),
(114, '30282637', 'SPORTS', 'Request Letter', 'Letter', 'Utilization of Facilities', 'Ongoing', 0, '2023-09-12', '2023-09-11 18:40:35', NULL, 0),
(111, '96710603', 'TRAFFIC', 'Memo', 'Memo', 'Transmmital', 'Done', 0, '2023-09-12', '2023-09-11 18:25:18', NULL, 0),
(120, '75873255', 'DILG', 'MC CAO 2023-112', 'Memo', 'Availment', 'Done', 0, '2023-09-12', '2023-09-11 21:48:00', NULL, 0),
(109, '17105284', 'DILG', 'voucher', 'Voucher', 'sample', 'Ongoing', 0, '2023-09-12', '2023-09-11 18:13:19', NULL, 0),
(108, '66660985', 'CONGRESSMAN', 'LETTER', 'Letter', 'LETTER', 'Ongoing', 0, '2023-09-12', '2023-09-11 18:12:07', NULL, 0),
(107, '76823231', 'DILG', 'Correspondence', 'Letter', 'DILG CORR', 'Done', 0, '2023-09-12', '2023-09-11 18:11:28', NULL, 0),
(106, '41428370', 'CONGRESSMAN', 'MEDICAL ASSISTANCE', 'Voucher', 'CONSOLIDATED MEDICAL ASSISTANCE', 'Ongoing', 0, '2023-09-12', '2023-09-11 17:59:54', NULL, 0),
(158, '98091299', 'DILG', 'FUEL CONSUMPTION', 'Voucher', 'MONTHLY SUMMARY/FUEL CONSUMPTION', 'Ongoing', 0, '2023-09-13', '2023-09-12 20:50:19', NULL, 0),
(104, '23246971', 'BUDGET', '5508 - Utilities MERALCO', 'Voucher', 'Electricity- Bahay Kalinga, GK Water Pump', 'Ongoing', 0, '2023-09-12', '2023-09-11 16:59:24', NULL, 0),
(103, '11234043', 'BUDGET', '5509 - Utilities MERALCO', 'Voucher', 'Electricity - ONI', 'Ongoing', 0, '2023-09-12', '2023-09-11 16:58:47', NULL, 0),
(102, '35669893', 'BUDGET', '5510 - Utilities MERALCO', 'Voucher', 'Electricity - MOLE', 'Ongoing', 0, '2023-09-12', '2023-09-11 16:57:53', NULL, 0),
(101, '40330782', 'BUDGET', '5515 - Utilities MERALCO', 'Voucher', 'Electricity - Polytechnic', 'Ongoing', 0, '2023-09-12', '2023-09-11 16:56:54', NULL, 0),
(100, '14969268', 'BUDGET', '5514 - Utilities MERALCO', 'Voucher', 'Electricity - IVTS ', 'Ongoing', 0, '2023-09-12', '2023-09-11 16:56:10', NULL, 0),
(99, '63993647', 'BUDGET', '5511- Utilities MERALCO', 'Voucher', 'Electricity Consumption - Imus Public Market, Parkin, IPM, Dry Market', 'Ongoing', 0, '2023-09-12', '2023-09-11 16:54:59', NULL, 0),
(98, '52166366', 'BUDGET', '5512- Utilities MERALCO', 'Voucher', 'Electricity Consumption - M. Espeleta Public Market & Slaughterhous', 'Ongoing', 0, '2023-09-12', '2023-09-11 16:53:58', NULL, 0),
(97, '46764187', 'CAPDO', 'ARCHI PPMP 2024', 'Communications', '2024 PPMP OF CITY ARCHITECTURAL PLANNING AND DESIGN OFFICE', 'Done', 0, '2023-09-12', '2023-09-11 16:53:30', NULL, 0),
(96, '88201127', 'BUDGET', '5513 - Utilities MERALCO', 'Voucher', 'Electricity Consumption- Streetlights, Offices, and CCTVs', 'Ongoing', 0, '2023-09-12', '2023-09-11 16:52:02', NULL, 0),
(123, '64209990', 'POPS', 'REQUEST', 'Letter', 'FOR COUNCIL MEETING', 'Ongoing', 0, '2023-09-12', '2023-09-11 22:15:00', NULL, 0),
(124, '76300382', 'POPS', 'PR', 'Voucher', 'CONFEDENTIAL', 'Done', 0, '2023-09-12', '2023-09-11 22:18:39', NULL, 0),
(125, '20661065', 'POPS', 'OUTGOING LETTER', 'Letter', 'INVITATION TO CIADAC MEETING', 'Done', 0, '2023-09-12', '2023-09-11 22:21:48', NULL, 0),
(126, '68176547', 'TOURISM', 'Request Letter', 'Letter', 'Usage of Plaza', 'Done', 0, '2023-09-12', '2023-09-11 22:40:41', NULL, 0),
(231, '83355427', 'PESO', 'Purchase Request: Goods', 'Voucher', 'Livelihood Program Starter Package', 'Ongoing', 0, '2023-09-19', '2023-09-18 21:48:30', NULL, 0),
(131, '97522102', 'CIO', 'Mobile', 'Voucher', 'Re imbursement ', 'Ongoing', 0, '2023-09-12', '2023-09-11 23:23:00', NULL, 0),
(133, '14074041', 'CPDO', 'Purchase Request', 'Voucher', 'Spare Parts for Motor Vehicle', 'Done', 1, '2023-09-12', '2023-09-11 23:38:27', NULL, 0),
(137, '57883441', 'OBO', 'PRINTING FORMS', 'Voucher', 'PERMITS', 'Ongoing', 0, '2023-09-12', '2023-09-11 23:54:22', NULL, 0),
(136, '71221628', 'POPDEV', 'Travel Order', 'Communications', 'Travel Order of Maria Theresa C. Sañez - September 21, 2023', 'Done', 0, '2023-09-12', '2023-09-11 23:44:21', NULL, 0),
(138, '67978229', 'PESO', 'Outgoing PESO-OC2023-95', 'Letter', ': Letter addresses to Mayor AA, thru: Mr. Larry Monzon, re: Request of Coaster for Passport on Wheels', 'Done', 0, '2023-09-12', '2023-09-11 23:55:43', NULL, 0),
(141, '26055797', 'CPDO', 'Requisition Slip', 'Voucher', 'Reimbursement for SGLG Re-Orientation/Meeting', 'Done', 1, '2023-09-12', '2023-09-12 00:04:38', NULL, 0),
(140, '86459758', 'OBO', 'RESPONSE LETTER', 'Letter', 'COMPLAINTS', 'Ongoing', 0, '2023-09-12', '2023-09-11 23:56:34', NULL, 0),
(149, '35576846', 'CENRO', 'gasoline report ', 'Voucher', 'month of september gasoline report', 'Done', 0, '2023-09-13', '2023-09-12 16:42:50', NULL, 0),
(152, '94701561', 'CPDO', 'CTO Request for Data E. Profile 2022', 'Communications', 'Request for time series record of the City of Imus\' operating expenditures for 2022', 'Ongoing', 0, '2023-09-13', '2023-09-12 17:10:53', NULL, 0),
(148, '69515279', 'PESO', 'Purchase Request', 'Voucher', 'Cause from Computer', 'Done', 0, '2023-09-13', '2023-09-12 16:40:08', NULL, 0),
(147, '49167323', 'CENRO', 'Purchase Request', 'Voucher', 'Repair  of Vehicle', 'Done', 0, '2023-09-13', '2023-09-12 16:17:28', NULL, 0),
(150, '89680920', 'HEALTH', 'Purchase Request', 'Voucher', 'Medicines', 'Ongoing', 0, '2023-09-13', '2023-09-12 16:49:30', NULL, 0),
(151, '46651817', 'DILG', 'AIR', 'Voucher', 'food and drinks during PTC', 'Ongoing', 0, '2023-09-13', '2023-09-12 16:58:24', NULL, 0),
(153, '84604154', 'CENRO', 'for AIR/inspection ', 'Voucher', 'materials & services plate number NII 2145 / conduction number NIG 354 change oil 2nd time ', 'Ongoing', 0, '2023-09-13', '2023-09-12 17:16:05', NULL, 0),
(154, '64992242', 'DILG', 'ADVISORY - DAPC', 'Communications', 'ADVISORY', 'Ongoing', 0, '2023-09-13', '2023-09-12 17:24:32', NULL, 0),
(155, '71683466', 'DILG', 'LETTER_JOSELITO SARREAL', 'Letter', 'BARANGAY BUCANDALA II', 'Ongoing', 0, '2023-09-13', '2023-09-12 17:27:26', NULL, 0),
(156, '33870258', 'CPDO', 'Accounting Request for Data E. Profile 2022', 'Communications', 'Request for the obligated debt expenditures and time series record of revenue other than property tax for 2022', 'Done', 1, '2023-09-13', '2023-09-12 17:29:46', NULL, 0),
(159, '42640563', 'DILG', 'CERTIFICATION', 'Communications', 'CPOC CERT 2023-007 TO 009', 'Ongoing', 0, '2023-09-13', '2023-09-12 20:53:13', NULL, 0),
(160, '36403065', 'DILG', 'PURCHASE REQUEST', 'Voucher', 'PARTS REPLACEMENT AND CHANGE OIL', 'Ongoing', 0, '2023-09-13', '2023-09-12 20:54:35', NULL, 0),
(161, '63773573', 'PESO', 'Purchase Request - Desktop', 'Voucher', 'Purchase of Desktop', 'Ongoing', 0, '2023-09-13', '2023-09-12 21:38:57', NULL, 0),
(162, '92886091', 'PESO', 'Outgoing Letter: PESO-OC2023-97', 'Letter', ' Letter to Robinsons Place Imus,re: Request for the Use of  Level 4 Movie World Robinsons Place Imus', 'Done', 0, '2023-09-13', '2023-09-12 23:05:18', NULL, 0),
(163, '12727652', 'CPDO', 'MO Request for Endorsement SP Reso  Php150M', 'Communications', 'Request for an endorsement for the creation of the SP Resolution of Php 150M', 'Ongoing', 0, '2023-09-13', '2023-09-12 23:40:38', NULL, 0),
(164, '86814681', 'GSO', 'Purchase Request', 'Voucher', 'Aircon', 'Done', 1, '2023-09-13', '2023-09-13 00:09:37', NULL, 0),
(165, '85797198', 'CENRO', 'for AIR/inspection ', 'Voucher', 'shoot that bottle cans / bins', 'Ongoing', 0, '2023-09-14', '2023-09-13 17:13:06', NULL, 0),
(166, '63649343', 'CICLEDO', 'VOUCHER -BOOK PRINTING', 'Voucher', 'Printing - Book of Financial Reporting Standards for Cooperatives for Cooperatives in Imus.', 'Ongoing', 0, '2023-09-14', '2023-09-13 17:18:47', NULL, 0),
(167, '17639013', 'CICLEDO', 'VOUCHER- VEHICLE REPAIRS', 'Voucher', 'Aircon parts replacement for CICLEDO vehicle, Toyota Innova J, with Plate No. SKC 373', 'Ongoing', 0, '2023-09-14', '2023-09-13 17:22:25', NULL, 0),
(168, '43176566', 'CPDO', 'Accounting Request for Data E. Profile 20-21', 'Communications', 'Request for the obligated debt expenditures and time series record of revenue other than property tax for 2020 and 2021', 'Done', 1, '2023-09-14', '2023-09-13 17:30:43', NULL, 0),
(169, '31913643', 'CITRMU', 'PURCHASE OF INK', 'Voucher', 'PAYMENT OF INK', 'Ongoing', 0, '2023-09-14', '2023-09-13 17:36:52', NULL, 0),
(170, '65158088', 'CITRMU', 'PURCHASE OF IT EQUIPMENT', 'Voucher', 'PAYMENT OF IT EQUIPMENT', 'Ongoing', 0, '2023-09-14', '2023-09-13 17:38:14', NULL, 0),
(171, '41605096', 'CPDO', 'HRMO Request for Training Approval', 'Communications', 'HRMO Request for Training Approval  for Engr. Monzon on October 26-27, 2023', 'Ongoing', 0, '2023-09-14', '2023-09-13 23:56:30', NULL, 0),
(172, '87351009', 'CICLEDO', 'VOUCHER-HONORARIUM', 'Voucher', 'HONORARIUM FOR MSME SEMINAR OF GRETCHEN B. VARIAS', 'Ongoing', 0, '2023-09-15', '2023-09-14 16:51:48', NULL, 0),
(173, '88318047', 'BAC', 'RESOLUTIONS', 'Voucher', 'RESO 2023-756 9/6/23 RESO 2023-755 9/6/23', 'Ongoing', 0, '2023-09-15', '2023-09-14 17:36:34', NULL, 0),
(175, '85065774', 'BAC', 'PURCHASE ORDER ', 'Voucher', 'FOR PO NO. (3 DOCUMENTS) CN: 191, 187,190', 'Ongoing', 0, '2023-09-15', '2023-09-14 17:54:34', NULL, 0),
(176, '48629523', 'CSU', 'LETTER', 'Letter', 'LETTER', 'Ongoing', 0, '2023-09-15', '2023-09-14 19:29:56', NULL, 0),
(177, '69514522', 'PESO', 'Incoming Communication: T#: PESO OC2023:IC-27', 'Communications', 'Invitation Letter: GFPS 3rd Quarterly Meeting ', 'Done', 0, '2023-09-15', '2023-09-14 19:46:36', NULL, 0),
(178, '43017930', 'ACCOUNTING', 'PAYROLL OF BARANGAY BOOKKEEPER', 'Voucher', 'PAYROLL OF BARANGAY BOOKKEEPER', 'Done', 0, '2023-09-18', '2023-09-17 16:27:53', NULL, 0),
(179, '48354953', 'CPDO', 'LEGAL Req for MOU Review Lee Sansuk', 'Communications', 'Request for MOU Review for PLO School of Global Inc and Foundation for Amenity Development', 'Ongoing', 0, '2023-09-18', '2023-09-17 16:31:13', NULL, 0),
(180, '94875255', 'BAC', 'PURCHASE ORDER  / REIMBURSEMENT', 'Voucher', 'IVTS  PR# 2023-09-000029/ 9-13-23 = 5,994', 'Done', 0, '2023-09-18', '2023-09-17 18:13:28', NULL, 0),
(181, '21335607', 'BAC', 'PURCHASE ORDER  / REIMBURSEMENT', 'Voucher', 'MAYOR\'S OFFICE PR# 2023-09-00035 / 9-14-23 = 12,250', 'Done', 0, '2023-09-18', '2023-09-17 18:17:28', NULL, 0),
(182, '75485848', 'BAC', 'PURCHASE ORDER  / SHOPPING', 'Voucher', 'AGRI  PR# 2023-09-00037/ 9-15-23 = 6530', 'Done', 0, '2023-09-18', '2023-09-17 18:24:15', NULL, 0),
(183, '49084367', 'BAC', 'PURCHASE ORDER  RESO # 701', 'Voucher', 'CICLEDO  PR# 2023-08-00092 8/16/23 = 129,850', 'Done', 0, '2023-09-18', '2023-09-17 18:36:49', NULL, 0),
(184, '17285422', 'BAC', 'PURCHASE ORDER  RESO # 663', 'Voucher', 'MOLE PO# 2023-09-00050 / 9-15-23 = 550,000', 'Done', 0, '2023-09-18', '2023-09-17 18:38:51', NULL, 0),
(185, '27905785', 'BAC', 'PURCHASE ORDER  RESO #763', 'Voucher', 'LCPC PO# 2023-09-00049/ 9-15-23 = 148,200', 'Done', 0, '2023-09-18', '2023-09-17 18:40:01', NULL, 0),
(186, '48792615', 'BAC', 'PURCHASE ORDER  RESO #759', 'Voucher', 'CTO PO# 2023-09-00046/ 9-14-23 = 236,052', 'Done', 0, '2023-09-18', '2023-09-17 18:41:08', NULL, 0),
(187, '43813599', 'BAC', 'PURCHASE ORDER  RESO #697', 'Voucher', 'DEPED PO# 2023-09-00045/ 9-14-23 = 142,155', 'Done', 0, '2023-09-18', '2023-09-17 18:42:28', NULL, 0),
(188, '76951499', 'BAC', 'PURCHASE ORDER  / REIMBURSEMENT', 'Voucher', 'CTO PO# 2023-09-00044/ 9-14-23 = 550', 'Done', 0, '2023-09-18', '2023-09-17 18:43:45', NULL, 0),
(189, '62491474', 'BAC', 'PURCHASE ORDER  / SHOPPING', 'Voucher', 'CTO PO# 2023-09-00042/ 9-14-23 =5,930', 'Done', 0, '2023-09-18', '2023-09-17 18:44:37', NULL, 0),
(190, '48589535', 'BAC', 'PURCHASE ORDER  RESO #487', 'Voucher', 'CDRRMO PO# 2023-09-00052/ 9-15-23 = 954,075', 'Done', 0, '2023-09-18', '2023-09-17 18:45:53', NULL, 0),
(270, '21607800', 'BAC', 'DEPED IMUS PR# 2023-09-00056 9/20/23 = 51,000', 'Voucher', 'FOOD AND DRINKS FOR THE CONDUCT OF LOCAL BENCHMARKING OF SDO NAGA CITY ON SBFP AND GULAYAN SA PAARALAN', 'Ongoing', 0, '2023-09-20', '2023-09-19 20:16:42', NULL, 0),
(194, '98464754', 'CENRO', 'TEST DOCUMENT', 'Voucher', 'TEST', 'Ongoing', 0, '2023-09-18', '2023-09-17 19:58:56', NULL, 0),
(206, '89530789', 'ASSESSOR', 'Purchase Request', 'Voucher', 'Supplies', 'Ongoing', 0, '2023-09-18', '2023-09-17 22:30:25', NULL, 0),
(196, '44623439', 'BAC', 'GSO PR#2023-09-00033 9/13/23 = 81,587', 'Voucher', 'PURCHASE OF PARTS REPLACEMENT & CHANGE OIL FOR GOVERNMENT VEHICLE WITH PLATE # P1M561, P1C181 & P2F990', 'Ongoing', 0, '2023-09-18', '2023-09-17 20:10:31', NULL, 0),
(198, '17344487', 'AGRICULTURE', 'Voucher - For Emergency Purchase of the diffe', 'Voucher', 'Amount P4,250', 'Done', 0, '2023-09-18', '2023-09-17 21:39:31', NULL, 0),
(200, '83065019', 'ABC', 'REQUEST', 'Letter', 'MEETING', 'Ongoing', 0, '2023-09-18', '2023-09-17 21:56:46', NULL, 0),
(201, '59338954', 'ABC', 'FOOD AND DRINKS', 'Voucher', 'PAYMENT', 'Ongoing', 0, '2023-09-18', '2023-09-17 21:57:32', NULL, 0),
(202, '66738062', 'CICLEDO', 'LETTER - MOA', 'Communications', 'LETTER FOR MOA LEGAL ADVICE ON ESKWELA KOOPERATIBA', 'Ongoing', 0, '2023-09-18', '2023-09-17 21:58:05', NULL, 0),
(203, '78915860', 'SPO', 'PURCHASE REQUEST', 'Voucher', 'FOOD AND DRINKS', 'Ongoing', 0, '2023-09-18', '2023-09-17 22:05:22', NULL, 0),
(204, '24809251', 'SPO', 'PURCHASE REQUEST', 'Voucher', 'OFFICE SUPPLIES', 'Ongoing', 0, '2023-09-18', '2023-09-17 22:10:20', NULL, 0),
(205, '75061889', 'SPO', 'Transmittal', 'Letter', 'Resolution', 'Ongoing', 0, '2023-09-18', '2023-09-17 22:13:37', NULL, 0),
(209, '42239115', 'BAC', 'BIDDING PURCHASE ORDER  RESO #736', 'Voucher', 'CHO PR# 2023-06-00037/ 6-15-23 =1,55,448', 'Done', 0, '2023-09-18', '2023-09-17 22:37:50', NULL, 0),
(259, '66462355', 'CITRMU', 'CELLPHONE BILL', 'Voucher', 'REIMBURSEMNET OF CELLPHONE BILL', 'Ongoing', 0, '2023-09-20', '2023-09-19 16:56:39', NULL, 0),
(211, '92364749', 'PESO', 'Outgoing Letter: PESO-OC2023-98 ', 'Letter', 'PESO-OC2023-95: Letter addresses to  Mr. Larry Monzon, re: Request of Long Tables for JMA on Sept. 22, 2023', 'Done', 0, '2023-09-18', '2023-09-17 22:39:03', NULL, 0),
(212, '26124068', 'BAC', 'PURCHASE ORDER  / REIMBURSEMENT', 'Voucher', 'CTO PR# 2023-08-00138 /8-30-23= 26022.71', 'Done', 0, '2023-09-18', '2023-09-17 22:39:22', NULL, 0),
(213, '64002015', 'BAC', 'PURCHASE ORDER  / SHOPPING', 'Voucher', 'ENG PR# 2023-08-00143 / 9-01-23 = 9500', 'Done', 0, '2023-09-18', '2023-09-17 22:40:24', NULL, 0),
(214, '88224716', 'BAC', 'PURCHASE ORDER  / REIMBURSEMENT', 'Voucher', 'CPDO PR#2023-09-00031 / 9-15-23 = 5520', 'Done', 0, '2023-09-18', '2023-09-17 22:42:08', NULL, 0),
(355, '27218448', 'VMO', 'PANTRY AND UTILITY SUPPLIES  (PHP. 49,678.00)', 'Voucher', 'PR# 2023-08-00087 PO# 2023-09-00031', 'Ongoing', 0, '2023-09-22', '2023-09-21 21:54:32', NULL, 0),
(216, '36463376', 'BAC', 'PURCHASE ORDER  RESO # 258', 'Voucher', 'CDRRMO PR# 2023-04-00013/ 4-05-23 = 269,972.50', 'Done', 0, '2023-09-18', '2023-09-17 22:54:04', NULL, 0),
(244, '20251815', 'BAC', 'CDRRMO PR# 2023-08-00121 8/23/23  = 2,937,407', 'Voucher', 'PURCHASE OF RESPONSE EQUIPAGE USED FOR CDRRMO RESCUE OPERATION', 'Ongoing', 0, '2023-09-19', '2023-09-19 00:18:27', NULL, 0),
(218, '72377883', 'CTO', 'Purchase Request', 'Voucher', 'Food and Drinks', 'Ongoing', 0, '2023-09-18', '2023-09-17 23:14:27', NULL, 0),
(219, '43813695', 'CTO', 'DISBURSEMENT VOUCHER', 'Voucher', 'CASH ADVANCE', 'Ongoing', 0, '2023-09-18', '2023-09-17 23:25:03', NULL, 0),
(220, '21369514', 'CTO', 'DISBURSEMENT VOUCHER', 'Voucher', 'CASH ADVANCE', 'Ongoing', 0, '2023-09-18', '2023-09-17 23:28:12', NULL, 0),
(260, '32856793', 'VMO', 'REIMBURSEMENT  FOOD AND DRINKS AUG 26- SEPT 1', 'Voucher', 'REIMBURSEMENT  ', 'Ongoing', 0, '2023-09-20', '2023-09-19 17:08:27', NULL, 0),
(232, '77158438', 'AGRICULTURE', 'Obligation Request', 'Voucher', 'For purchase of vehicle parts and change oil', 'Done', 0, '2023-09-19', '2023-09-18 21:54:54', NULL, 0),
(224, '60862139', 'CCRO', 'DISBURSEMENT VOUCHER', 'Voucher', 'MINERAL WATER', 'Done', 0, '2023-09-18', '2023-09-17 23:47:02', NULL, 0),
(227, '88026502', 'LEGAL', 'Request for Certified True Copy ', 'Letter', 'Tax Declaration and Certificate of No Improvement', 'Ongoing', 0, '2023-09-18', '2023-09-18 00:20:41', NULL, 0),
(226, '97522477', 'CTO', 'DISBURSEMENT VOUCHER', 'Voucher', 'CASH ADVANCE', 'Ongoing', 0, '2023-09-18', '2023-09-18 00:00:22', NULL, 0),
(229, '20137660', 'PDAO', 'REQUEST', 'Letter', 'MEETING', 'Ongoing', 0, '2023-09-18', '2023-09-18 00:30:01', NULL, 0),
(230, '73502949', 'PDAO', 'MEDICAL ASSISTANCE', 'Voucher', 'FOR BATCH 1 ', 'Ongoing', 0, '2023-09-18', '2023-09-18 00:34:07', NULL, 0),
(233, '24968028', 'BAC', 'PURCHASE ORDER  RESO # 658', 'Voucher', 'TRU PR#2023-07-00156 /  7-31-23 =647,300', 'Ongoing', 0, '2023-09-19', '2023-09-18 22:55:34', NULL, 0),
(252, '80211378', 'CSWDO', 'rice', 'Voucher', 'for shelter use', 'Ongoing', 0, '2023-09-20', '2023-09-19 15:59:36', NULL, 0),
(258, '93816002', 'VMO', 'OFFICE EQUIPMENT (DESKTOP COMPUTER)', 'Voucher', ' PO# 2023-07-00051', 'Ongoing', 0, '2023-09-20', '2023-09-19 16:32:33', NULL, 0),
(254, '59449081', 'CPDO', 'MO Land Reclass for SP Citihomes', 'Communications', 'Request for SP endorsement Reclassification of land Citihomes Builder and Dev\'t Inc.', 'Ongoing', 0, '2023-09-20', '2023-09-19 16:04:32', NULL, 0),
(256, '10248875', 'SPO', 'PURCHASE REQUEST', 'Voucher', 'committe meeting on land utilization, zoning and housing/human settlements', 'Ongoing', 0, '2023-09-20', '2023-09-19 16:05:37', NULL, 0),
(261, '33828944', 'VMO', ' AIRCON REPAIR AND MAINTENANCE  PLATE # P6H30', 'Voucher', 'PR# 2023-05-00130 PO# 2023-08-00061', 'Ongoing', 0, '2023-09-20', '2023-09-19 17:15:36', NULL, 0),
(263, '48366221', 'LIBRARY', 'PURCHASE REQUEST', 'Voucher', 'OFFICE SUPPLIES ', 'Ongoing', 0, '2023-09-20', '2023-09-19 19:41:17', NULL, 0),
(264, '40108736', 'BAC', 'PURCHASE ORDER  RESO # 262', 'Voucher', 'CDRRMO PR# 2023-04-00043/ 4-13-23 = 74,250', 'Ongoing', 0, '2023-09-20', '2023-09-19 19:45:37', NULL, 0),
(265, '42387965', 'BAC', 'PURCHASE ORDER  / REIMBURSEMENT', 'Voucher', 'GSO PR# 2023-09-000024 / 9-13-23 =979.75', 'Ongoing', 0, '2023-09-20', '2023-09-19 19:49:28', NULL, 0),
(266, '44086274', 'BAC', 'PURCHASE ORDER  RESO #773', 'Voucher', 'BJMP FEMALE DORM PR# 2023-04-00065 / 4-20-23 = 32,150', 'Ongoing', 0, '2023-09-20', '2023-09-19 19:51:04', NULL, 0),
(267, '83206334', 'BAC', 'PURCHASE ORDER  RESO # 752', 'Voucher', 'TRU PR# 2023-08-00115 / 8-22-23 = 24,250', 'Ongoing', 0, '2023-09-20', '2023-09-19 20:05:53', NULL, 0),
(268, '58834452', 'SKO', 'Data privacy consent form', 'Letter', 'Personal Data', 'Ongoing', 0, '2023-09-20', '2023-09-19 20:11:21', NULL, 0),
(271, '70495227', 'BAC', 'CDRRMO PR# 2023-09-00052 9/20/23 = 349,932', 'Voucher', 'HOTEL ACCOMODATION TO CONDUCT TRAINING PROGRAM ON EMERGENCY OPERATION CENTER', 'Ongoing', 0, '2023-09-20', '2023-09-19 20:24:28', NULL, 0),
(272, '84019074', 'GSO', 'ELEVATOR MANTRAP RESCUE TRAINING', 'Letter', 'SEPTEMBER 22, 2023', 'Done', 0, '2023-09-20', '2023-09-19 21:09:17', NULL, 0),
(273, '12009107', 'LEDIPO', 'Request Letter', 'Letter', 'Request letter to use HR Training Room on October 11, 18 & 25, 2023', 'Ongoing', 0, '2023-09-20', '2023-09-19 21:27:51', NULL, 0),
(308, '60974897', 'BUDGET', '5874 MERALCO', 'Voucher', 'Electricity - IVTS Livelihood Training Center', 'Ongoing', 0, '2023-09-21', '2023-09-20 16:16:00', NULL, 0),
(280, '60117371', 'CSU', 'DTR OF BAHAYANG PAGASA', 'Communications', 'FOR THE MONTH AUGUST 1-31', 'Ongoing', 0, '2023-09-20', '2023-09-19 22:04:28', NULL, 0),
(279, '14425016', 'CSU', 'DTR OF BAHAYANG PAGASA', 'Communications', 'FOR THE MONTH AUGUST 1-31', 'Ongoing', 0, '2023-09-20', '2023-09-19 22:03:58', NULL, 0),
(307, '94055645', 'BUDGET', '5873 MERALCO', 'Voucher', 'Electricity - Cavite Dialysis Center', 'Ongoing', 0, '2023-09-21', '2023-09-20 16:05:13', NULL, 0),
(285, '54388631', 'MAYOR', 'TRANSMITTALS', 'Communications', 'RESO TO OVM', 'Done', 1, '2023-09-20', '2023-09-19 22:28:36', NULL, 0),
(306, '37478166', 'AGRICULTURE', 'PURCHASE ORDER', 'Voucher', 'FOR EMERGENCY PURCHASE OF  DIFFERENT MATERIALS TO BE USED AT THE CITY PLANT NURSERY', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:43:18', NULL, 0),
(288, '48021145', 'CSU', 'DTR OF BAHAYANG PAGASA', 'Letter', 'FOR THE MONTH AUGUST 1-31', 'Ongoing', 0, '2023-09-20', '2023-09-19 22:46:25', NULL, 0),
(289, '29141581', 'BAC', 'SP REPRESENTATION EXPENSES = 13,075', 'Voucher', 'MUFFY\'S KITCHENETTE ', 'Ongoing', 0, '2023-09-20', '2023-09-19 22:58:22', NULL, 0),
(290, '65065439', 'BAC', 'SP REPRESENTATION EXPENSES = 5,960', 'Voucher', 'MUFFY\'S KITCHENETTE ', 'Ongoing', 0, '2023-09-20', '2023-09-19 22:59:11', NULL, 0),
(291, '68069166', 'BAC', 'SP REPRESENTATION EXPENSES = 28,543', 'Voucher', 'MUFFY\'S KITCHENETTE ', 'Ongoing', 0, '2023-09-20', '2023-09-19 22:59:55', NULL, 0),
(292, '40528439', 'BAC', 'SP REPRESENTATION EXPENSES = 16,920', 'Voucher', 'MUFFY\'S KITCHENETTE ', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:00:16', NULL, 0),
(293, '72703107', 'BAC', 'SP REPRESENTATION EXPENSES = 14,580', 'Voucher', 'MUFFY\'S KITCHENETTE ', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:01:27', NULL, 0),
(294, '83674894', 'BAC', 'SP REPRESENTATION EXPENSES = 5,599', 'Voucher', 'MUFFY\'S KITCHENETTE ', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:02:07', NULL, 0),
(295, '76468981', 'BAC', 'SP REPRESENTATION EXPENSES = 14,760', 'Voucher', 'MUFFY\'S KITCHENETTE ', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:03:24', NULL, 0),
(296, '13518167', 'MAYOR', 'TRANSMITTAL', 'Communications', 'RESO FOR OVM', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:09:33', NULL, 0),
(297, '78660424', 'BAC', 'PURCHASE ORDER  RESO # 207', 'Voucher', 'CSWD PR# 2023-08-00107 / 8-17-23 =18,260', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:11:11', NULL, 0),
(298, '88972137', 'GSO', 'REIMBURSEMENT', 'Voucher', 'PURCHASE OF WHEEL CAP AND BRAKE FLUID', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:12:35', NULL, 0),
(299, '57201648', 'BAC', 'PURCHASE ORDER  RESO # 661', 'Voucher', 'PNP/GSO PR# 2023-08-00043/ 8-07-23= 50,200', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:13:09', NULL, 0),
(300, '19160720', 'BAC', 'PURCHASE ORDER  RESO # 742', 'Voucher', 'CDRRMO PR# 2023-08-00133 / 8-31-23 = 20,300', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:14:57', NULL, 0),
(301, '39627195', 'BAC', 'ADMIN/MO PR# 2023-09-00044 - 9/19/23 = 204,00', 'Voucher', 'PURCHASE OF ACRYLIC STAND FOR THE CITIZEN CHARTER HOLDER OF VARIOUS OFFICES', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:32:40', NULL, 0),
(302, '47180281', 'CITRMU', 'TRANSMITTAL NO. 2023-09001', 'Communications', 'Individual Development Plans (IDP) of 11 CITRMU personnel', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:34:57', NULL, 0),
(303, '24563608', 'VMO', 'OFFICE EQUIPMENT (2 CABINET)', 'Voucher', 'PR# 2023-08-00072 PO# 2023-09-00003', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:36:18', NULL, 0),
(304, '85455030', 'BAC', 'GSO PR#2023-09-00032 9/13/23 = 34,870', 'Voucher', 'PARTS REPLACEMENT & CHANGE OIL FOR GOVERNMENT VEHICLE WITH PLATE # SKS133', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:36:26', NULL, 0),
(305, '56805334', 'BAC', 'CHO PR# 2023-09-00018 / 9-11-23 =13,545', 'Voucher', 'PARTS REPLACEMENT & CHANGE OIL FOR GOVERNMENT VEHICLE WITH PLATE # SJD 292', 'Ongoing', 0, '2023-09-20', '2023-09-19 23:38:59', NULL, 0),
(309, '89549305', 'BUDGET', '5875 MERALCO', 'Voucher', 'Electricity - Bahay Kalinga 2', 'Ongoing', 0, '2023-09-21', '2023-09-20 16:17:07', NULL, 0),
(310, '91224439', 'BUDGET', '5876 MERALCO', 'Voucher', 'Bill Deposit - ONI Streetlights', 'Ongoing', 0, '2023-09-21', '2023-09-20 16:18:22', NULL, 0),
(311, '80346380', 'BUDGET', '5877 MERALCO', 'Voucher', 'Bill Deposit - Rehabilitation Center Alapan 2B', 'Ongoing', 0, '2023-09-21', '2023-09-20 16:19:11', NULL, 0),
(312, '48916537', 'BUDGET', '5878 MERALCO ', 'Voucher', 'Electricity - Diff Streetlights, Offices, and CCTVs', 'Ongoing', 0, '2023-09-21', '2023-09-20 16:20:17', NULL, 0),
(313, '82309502', 'VMO', 'RENTAL AUTOREFRACTOMETER (JUNE- AUGUST 2023)', 'Voucher', 'PR# 2023-08-00026 PO#  2023-08-00094', 'Ongoing', 0, '2023-09-21', '2023-09-20 16:29:47', NULL, 0),
(315, '98949374', 'BUDGET', '5880 MERALCO', 'Voucher', 'Electricity - WDC & CDC', 'Ongoing', 0, '2023-09-21', '2023-09-20 17:08:19', NULL, 0),
(316, '90529209', 'BUDGET', '5881 MERALCO', 'Voucher', 'Electricity - Imus Market Streetlights', 'Ongoing', 0, '2023-09-21', '2023-09-20 17:08:56', NULL, 0),
(317, '36389364', 'BUDGET', '5882 MERALCO', 'Voucher', 'Electricity - Different Streetlights', 'Ongoing', 0, '2023-09-21', '2023-09-20 17:09:36', NULL, 0),
(318, '21890384', 'MAYOR', 'transmittals', 'Communications', 'reso to sp', 'Done', 1, '2023-09-21', '2023-09-20 17:44:34', NULL, 0),
(319, '51025647', 'BUDGET', '5822 MERALCO', 'Voucher', 'Electricity- Day Care Centers', 'Ongoing', 0, '2023-09-21', '2023-09-20 18:20:17', NULL, 0),
(320, '61388039', 'BPLO', 'Business Cease and Desist Letter', 'Letter', 'For signature of Atty. Leonard Martin E. Syjuco', 'Ongoing', 0, '2023-09-21', '2023-09-20 18:24:31', NULL, 0),
(321, '64213921', 'VETERINARY', 'Repair /Replacement SKT 136 - Voucher', 'Voucher', 'For the repair and replacement of government vehicle (Animal Impounding Vehicle) assigned at the City Veterinary Services Office with plate number SKT 136.', 'Ongoing', 0, '2023-09-21', '2023-09-20 20:05:18', NULL, 0),
(322, '30066461', 'TOURISM', 'MPRO AUDIO-TECH LIGHTS AND SOUND RENTAL', 'Voucher', 'RENTAL OF LIGHTS AND SOUND WITH LEDSCREEN AND BAND EQUIPMENT FOR BATTLE OF THE BAND AND VARIETY SHOW 2023', 'Ongoing', 0, '2023-09-21', '2023-09-20 20:51:06', NULL, 0),
(323, '46651668', 'ADMIN', 'PURCHASE REQUEST', 'Voucher', 'PAPER SHREDDER', 'Ongoing', 0, '2023-09-21', '2023-09-20 21:11:54', NULL, 0),
(324, '48119613', 'VMO', 'OFFICE SUPPLIES ( BROTHER INK)', 'Voucher', ' PR# 2023-06-00075 PO# 2023-07-00099', 'Ongoing', 0, '2023-09-21', '2023-09-20 21:19:06', NULL, 0),
(325, '89697401', 'VMO', 'TIRE REPLACEMENT INNOVA P4Y925', 'Voucher', 'PR# 2023-07-00033 PO# 2023-08-00026', 'Ongoing', 0, '2023-09-21', '2023-09-20 21:34:33', NULL, 0),
(326, '65831001', 'GAD', 'voucher', 'Voucher', 'subscription', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:05:31', NULL, 0),
(327, '50866553', 'GAD', 'VOUCHER', 'Voucher', 'OFFICE FIXTURES', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:15:55', NULL, 0),
(328, '62138385', 'BAC', 'PURCHASE ORDER  / REIMBURSEMENT', 'Voucher', 'CSWD PR# 2023-09-00067 9/21/23 = 1306', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:23:50', NULL, 0),
(329, '11168409', 'BAC', 'PURCHASE ORDER  / REP ALLOWANCE', 'Voucher', 'SP PR# 2023-09-00064 9/20/23 = 6815', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:26:20', NULL, 0),
(330, '11831931', 'BAC', 'PURCHASE ORDER  / REP ALLOWANCE', 'Voucher', 'SP PR# 2023-09-00062 9/20/23 = 19908', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:28:22', NULL, 0),
(331, '30122174', 'BAC', 'PURCHASE ORDER  / REP ALLOWANCE', 'Voucher', 'SP PR# 2023-09-00063 9/20/23 = 3225', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:29:40', NULL, 0),
(332, '71945185', 'BAC', 'PURCHASE ORDER  /  BIDDING', 'Voucher', 'DEPED PR# 2023-08-00049 8/8/23 = 19,714,315.60', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:31:13', NULL, 0),
(333, '67009260', 'BAC', 'PURCHASE ORDER  / REIMBURSEMENT', 'Voucher', 'SIR LARRY VOUCHER CW HOME DEPOT', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:32:53', NULL, 0),
(334, '26079221', 'BAC', 'PURCHASE ORDER ', 'Voucher', 'LIBRARY PR# 2023-09-00021 9/12/23 = 14,355', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:35:15', NULL, 0),
(335, '64197994', 'BAC', 'PURCHASE ORDER  / SHOPPING', 'Voucher', 'ASSESSOR PR# 2023-09-00023 / 9-13-23 = 2595', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:38:01', NULL, 0),
(336, '44730923', 'BAC', 'PURCHASE ORDER  / REIMBURSEMENT', 'Voucher', 'AGRI PR# 2023-09-00039 9/18/23 = 3,895', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:39:04', NULL, 0),
(337, '28519269', 'VMO', 'PURCHASE OF OFFICE EQUIPMENT (BOLTLESS RACK) ', 'Voucher', 'PR for signature Budget Officer', 'Ongoing', 0, '2023-09-21', '2023-09-20 22:48:24', NULL, 0),
(338, '22767425', 'AGRICULTURE', 'ENDORSEMENT OF RSBSA FIELD ASSISTANT', 'Communications', 'REQUEST LETTER FROM REGIONAL FIELD OFFICE IV-CALABARZON', 'Done', 0, '2023-09-21', '2023-09-20 22:52:14', NULL, 0),
(339, '53038093', 'BAC', 'CHO PR# 2023-09-0004.3/ 9-19-23 = 70,000', 'Voucher', 'PURCHASE OF ESSENTIAL NEWBORN SCREENING KIT FOR IMUS BIRTHING HOME ( PHILHEALTH TRUST FUND)', 'Ongoing', 0, '2023-09-21', '2023-09-20 23:03:11', NULL, 0),
(340, '53915826', 'BAC', 'ASSESOR PR#2023-09-00001 9/4/23 = 29,000', 'Voucher', 'COMPUTER SPECS TO BE USE IN ASSESSOR OFFICE', 'Ongoing', 0, '2023-09-21', '2023-09-20 23:06:44', NULL, 0),
(341, '92052263', 'CTO', 'PURCHASE REQUEST', 'Voucher', 'Various supplies for BSK Election', 'Ongoing', 0, '2023-09-21', '2023-09-20 23:09:48', NULL, 0),
(342, '34397263', 'CTO', 'PURCHASE REQUEST', 'Voucher', 'Accountable forms', 'Ongoing', 0, '2023-09-21', '2023-09-20 23:10:31', NULL, 0),
(343, '28872976', 'OBO', 'purchase request', 'Voucher', 'reinbursment', 'Ongoing', 0, '2023-09-21', '2023-09-20 23:59:49', NULL, 0),
(344, '73696935', 'SPORTS', 'Request Letter', 'Letter', 'Utilization of Facilities', 'Ongoing', 0, '2023-09-21', '2023-09-21 00:36:54', NULL, 0),
(345, '50368174', 'SPORTS', 'Request Letter', 'Communications', 'cigto request', 'Ongoing', 0, '2023-09-21', '2023-09-21 00:38:20', NULL, 0),
(346, '53531661', 'VMO', 'PURCHASE OF UTILITY SUPPLIES (PHP. 46,788.00)', 'Voucher', 'PR# 2023-08-00104 PO# 2023-09-00043', 'Ongoing', 0, '2023-09-22', '2023-09-21 16:25:45', NULL, 0),
(347, '46767004', 'VMO', 'PURCHASE OF PANTRY SUPPLIES  (PHP. 77,425.00)', 'Voucher', 'PR# 2023-08-00105 PO# 2023-09-00036', 'Ongoing', 0, '2023-09-22', '2023-09-21 16:27:55', NULL, 0),
(348, '74415460', 'GAD', 'voucher', 'Voucher', 'zoom subscription', 'Ongoing', 0, '2023-09-22', '2023-09-21 16:51:16', NULL, 0),
(349, '89586189', 'CTO', 'PURCHASE REQUEST', 'Voucher', 'CHICHARON', 'Ongoing', 0, '2023-09-22', '2023-09-21 17:37:11', NULL, 0),
(350, '26174509', 'CTO', 'PURCHASE REQUEST', 'Voucher', 'LONGGANISA', 'Ongoing', 0, '2023-09-22', '2023-09-21 17:43:38', NULL, 0),
(351, '35674437', 'CITRMU', 'TRANSMITTAL NO. 2023-09002', 'Communications', 'Job Order Replacement - J. Sabado', 'Ongoing', 0, '2023-09-22', '2023-09-21 18:01:29', NULL, 0),
(352, '67182971', 'CPDO', 'CENRO Response to Mr. Emmanuel Espinola', 'Communications', 'Response to the request of CENRO for the inspection report ', 'Ongoing', 0, '2023-09-22', '2023-09-21 18:09:35', NULL, 0),
(353, '24278016', 'CTO', 'OBR-FOR AIR', 'Voucher', 'YELLOW METAL BOXES PAINT', 'Ongoing', 0, '2023-09-22', '2023-09-21 18:53:11', NULL, 0),
(354, '39339867', 'MAYOR', 'transmittals', 'Communications', 'ocm-oc-2023-09-0286-A re-national mapping reosurce information authority', 'Done', 0, '2023-09-22', '2023-09-21 21:40:27', NULL, 0),
(356, '12650940', 'BAC', 'PURCHASE ORDER/RESO NO: #586 -7/28/23', 'Voucher', 'VARIOUS OFFICES/ PR # 2023-07-00059/7-13-23 /=308,875.00', 'Ongoing', 0, '2023-09-22', '2023-09-21 23:04:08', NULL, 0),
(357, '89013244', 'BAC', 'PURCHASE ORDER/REIMBURSEMENT ', 'Voucher', 'MAYORS OFFICE / PR NO. 2023-09-00030/ 9-14-23/=15,120', 'Ongoing', 0, '2023-09-22', '2023-09-21 23:05:36', NULL, 0),
(358, '16064233', 'BAC', 'PURCHASE ORDER/REPRESENTATION ALLOWANCE', 'Voucher', 'SP OFFICE/ PR NO. 2023-07-00054/ 09-21-23/ 4,466.50', 'Ongoing', 0, '2023-09-22', '2023-09-21 23:07:29', NULL, 0),
(359, '89578986', 'BAC', 'PURCHASE ORDER/REPRESENTATION ALLOWANCE', 'Voucher', 'SP OFFICE/PR NO. 2023-07-00055/ 09-21-23 = 14,940', 'Ongoing', 0, '2023-09-22', '2023-09-21 23:08:13', NULL, 0),
(360, '71335649', 'BAC', 'PURCHASE ORDER/RESO NO: #518 -7/10/23', 'Voucher', 'VARIOUS OFFICES/ PR # 2023-05-00065/ 05-22-23/ 300,380.85', 'Ongoing', 0, '2023-09-22', '2023-09-21 23:17:00', NULL, 0),
(361, '84807287', 'CITRMU', 'Purchase Request', 'Voucher', 'supplier', 'Ongoing', 0, '2023-09-22', '2023-09-21 23:31:05', NULL, 0),
(362, '40688971', 'BAC', 'PURCHASE REQUEST 2023-09-00058 9/19/23 = 7,88', 'Voucher', 'PURCHASE OF MEDICAL EQUIPMENT , REAGENTS AND CONSUMABLES TO BE USED AT CLINICAL CHEMISTRY SECTION OF THE DIAGNOSTIC LABORATORY', 'Ongoing', 0, '2023-09-22', '2023-09-21 23:48:56', NULL, 0),
(363, '13918476', 'CDRRMO', 'Test', 'Memo', 'Test', 'Ongoing', 0, '2023-09-23', '2023-09-22 19:23:56', NULL, 0),
(364, '16804633', 'CDRRMO', 'Test', 'Letter', 'Test', 'Ongoing', 0, '2023-09-23', '2023-09-22 19:24:12', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'admin', '$2a$12$ua0E7Z6AT1QdHc/q2YbfUOy5BEvWLtRhBOh8BgpYlHc3j/NscgNfe', '2023-09-25 01:41:27', '2023-09-25 01:41:27', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
