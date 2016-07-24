-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2013 at 09:27 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wordpress351`
--

--
-- Dumping data for table `wp_ee_degrees`
--

INSERT INTO `wp_ee_degrees` (`id`, `name`, `trashed`) VALUES
(1, 'Associate\\''s Programs', 0),
(2, 'Bachelor\\''s Programs', 0),
(3, 'Certificate Programs', 0),
(4, 'Diploma Programs', 0),
(5, 'Doctorate Programs', 0),
(6, 'M.B.A. Programs', 0),
(7, 'Master\\''s Programs', 0),
(8, 'Graduate Certificate', 0),
(9, 'HS Diploma', 0);

--
-- Dumping data for table `wp_ee_programs`
--

INSERT INTO `wp_ee_programs` (`id`, `school_id`, `degree_id`, `study_id`, `name`, `trashed`) VALUES
(1, 1, 1, 1, 'Associate of Business Administration in Sports Management', 0),
(2, 1, 1, 1, 'Associate of Arts in General Studies', 0),
(3, 1, 1, 1, 'Associate of Business Administration in Accounting', 0),
(4, 1, 1, 1, 'Associate of Business Administration in Business', 0),
(5, 1, 1, 11, 'Associate of Business Administration in Computer and Information Technology', 0),
(6, 1, 1, 1, 'Associate of Business Administration in Healthcare Administration', 0),
(7, 1, 1, 2, 'Associate of Criminal Justice in Corrections', 0),
(8, 1, 1, 2, 'Associate of Criminal Justice in Homeland Security', 0),
(9, 1, 1, 2, 'Associate of Criminal Justice in Law Enforcement', 0),
(10, 2, 2, 2, 'Criminal Justice (BA)', 0),
(11, 2, 2, 1, 'Accounting (BS)', 0),
(12, 2, 2, 1, 'Business Administration (BS)', 0),
(13, 2, 2, 1, 'Business Information Technology(BS-BIT)', 0),
(14, 2, 2, 1, 'Business Management(BS)', 0),
(15, 2, 2, 2, 'Criminal Justice:CSI (BS)', 0),
(16, 2, 2, 1, 'Information Technology (BS)', 0),
(17, 2, 2, 1, 'International Business (BS)', 0),
(18, 2, 2, 1, 'Management (BS)', 0),
(19, 2, 2, 9, 'RN to BSN', 0),
(20, 2, 2, 1, 'Sports Management (BS)', 0),
(21, 2, 1, 1, 'Business Administration(AS)', 0),
(22, 3, 1, 1, 'Business Administration - Associates', 0),
(23, 4, 1, 1, 'Associate of Science - Accounting', 0),
(24, 4, 1, 1, 'Associate of Science - Business', 0),
(25, 5, 1, 1, 'Business - Management', 0),
(26, 5, 1, 1, 'Hospitality - Hotel and Casino Management', 0),
(27, 6, 1, 1, 'Grado Asociado en Administración de Empresas', 0),
(28, 6, 1, 1, 'Grado Asociado en Administración de Empresas en Contabilidad', 0),
(29, 6, 1, 1, 'Grado Asociado en Administración de Empresas en Desarrollo Empresarial', 0),
(30, 7, 1, 1, 'Business Management', 0),
(31, 8, 1, 1, 'AAS Accounting - Financial Accounting Emphasis', 0),
(32, 8, 1, 1, 'AAS Accounting - Financial Investigation Emphasis', 0),
(33, 9, 1, 1, 'Accounting', 0),
(34, 4, 1, 2, 'Associate of Science - Criminal Justice', 0),
(35, 5, 1, 2, 'Safety and Security Administration', 0),
(36, 6, 1, 2, 'Grado Asociado en Justicia Criminal', 0),
(37, 10, 1, 2, 'Criminal Justice (Associates)', 0),
(38, 11, 1, 13, 'Photography (Associates)', 0),
(39, 3, 1, 14, 'Medical Office Specialist-Associates', 0),
(40, 4, 1, 14, 'Associate of Science - Health Care Administration', 0),
(41, 5, 1, 14, 'Medical Office Administration', 0),
(42, 3, 1, 15, 'Paralegal-Associates', 0),
(43, 4, 1, 15, 'Associate of Science - Digital Forensics and Investigation', 0),
(44, 4, 1, 15, 'Associate of Science - Paralegal Studies', 0),
(45, 10, 1, 15, 'Paralegal (Associates)', 0),
(46, 9, 1, 9, 'Allied Health Science', 0),
(47, 3, 1, 11, 'Network Administration - Associates', 0),
(48, 6, 1, 11, 'Grado Asociado en Tecnología de Redes y Desarrollo de Aplicaciones', 0),
(49, 12, 1, 11, 'Information Technology (A)', 0),
(50, 4, 2, 1, 'Bachelor of Science - Management', 0),
(51, 6, 2, 1, 'Bachelor’s (Bachillerato) en Administración de Empresas con Concentración en Administración de Empre', 0),
(52, 6, 2, 1, 'Bachelor’s (Bachillerato) en Administración de Empresas con Concentración en Contabilidad', 0),
(53, 6, 2, 1, 'Bachelor’s (Bachillerato) en Administración de Empresas con Concentración en Inteligencia de Negocio', 0),
(54, 6, 2, 1, 'Bachelor’s (Bachillerato) en Administración de Empresas con Concentración en Recursos Humanos', 0),
(55, 13, 2, 1, 'MSN - Nurse Educator', 0),
(56, 13, 2, 1, 'MSN - Nurse Informatics', 0),
(57, 13, 2, 1, 'MSPY - Addictions', 0),
(58, 13, 2, 1, 'MSPY - Applied Behavioral Analysis', 0),
(59, 13, 2, 1, 'MSPY - General Psychology', 0),
(60, 13, 2, 1, 'Master of Business Administration', 0),
(61, 13, 2, 1, 'Master of Health Care Administration', 0),
(62, 13, 2, 1, 'Master of Public Administration', 0),
(63, 13, 2, 1, 'Master of Public Health', 0),
(64, 13, 2, 1, 'Master of Science in Health Education', 0),
(65, 13, 2, 1, 'Master of Science in Management', 0),
(66, 13, 2, 1, 'Master of Science in Nursing - Adult Gerontology Practitioner', 0),
(67, 13, 2, 1, 'Master of Science in Nursing - Family Nurse Practitioner', 0),
(68, 13, 2, 1, 'Pathway to Paralegal Postbaccalaureate Certificate', 0),
(69, 13, 2, 1, 'RN to BS in Nursing', 0),
(70, 13, 2, 1, 'RN to MS in Nursing', 0),
(71, 10, 2, 1, 'Accounting (Bachelors)', 0),
(72, 14, 2, 1, 'Business Administration', 0),
(73, 4, 2, 2, 'Bachelor of Science - Criminal Justice', 0),
(74, 6, 2, 2, 'Bachelor’s (Bachillerato) en Justicia Criminal', 0),
(75, 6, 2, 2, 'Bachelor’s (Bachillerato) en Justicia Criminal con Concentración en Servicios Humanos', 0),
(76, 6, 2, 2, 'Bachelor’s (Bachillerato) en Justicia Criminal con concentración en Crímenes Cibernéticos', 0),
(77, 6, 2, 2, 'Bachelor’s (Bachillerato) en Justicia Criminal con concentración en Investigación Forense', 0),
(78, 6, 2, 2, 'Bachelor’s (Bachillerato) en Justicia Criminal con concentración en Seguridad Nacional', 0),
(79, 10, 2, 2, 'Criminal Justice (Bachelors)', 0),
(80, 10, 2, 2, 'Homeland Security (Bachelors)', 0),
(81, 14, 2, 2, 'Criminal Justice', 0),
(82, 12, 2, 16, 'Software Development: Major in Game Software Development (B)', 0),
(83, 6, 2, 14, 'Bachillerato en Ciencias de Enfermería (RN a BSN)', 0),
(84, 14, 2, 14, 'Allied Health Management', 0),
(85, 4, 2, 15, 'Bachelor of Science - Digital Forensics and Investigation', 0),
(86, 15, 2, 7, 'BS-Interdisciplinary Studies/Hospitality Management', 0),
(87, 15, 2, 7, 'BS-Interdisciplinary Studies/Humanities', 0),
(88, 15, 2, 7, 'BS-Interdisciplinary Studies/Labor Relations', 0),
(89, 11, 2, 17, 'Photography (Bachelors)', 0),
(90, 14, 2, 9, 'Nursing (RN to BSN)', 0),
(91, 16, 2, 11, 'Software Development: Major in Game Software Development (B)', 0),
(92, 6, 2, 11, 'Bachelor’s (Bachillerato) en Tecnología de Redes y Desarrollo de Aplicaciones', 0),
(93, 17, 2, 11, 'Bachelor in Cybersecurity - Cybercrime Investigation', 0);

--
-- Dumping data for table `wp_ee_schools`
--

INSERT INTO `wp_ee_schools` (`id`, `name`, `description`, `logo`, `stype`, `zipcode`, `trashed`) VALUES
(1, 'Ivy Bridge College', '<p><strong>Guided Path. Brighter Future.</strong><br /><br />Ivy Bridge College’s associate degree programs provide the flexibility and convenience of online learning while offering unparalleled mentoring and student support. You’ll learn from expert faculty and benefit from a dedicated success coach who will guide you from admission through graduation and beyond. Courses are available online anytime from anywhere—giving you the freedom to set your own schedule.<br /><br />And if you want to pursue a four-year degree, Ivy Bridge provides streamlined admission to some of the best four-year colleges in the U.S.<br /><br />Ivy Bridge College offers online associate degree programs. They are designed for maximum transferability and to reflect your diverse academic needs and professional ambitions.<br /><br />Ivy Bridge College is part of Tiffin University, an accredited independent institution that has been educating students since 1888. The sooner you begin your degree program at Ivy Bridge, the closer you will be to graduation and the future you deserve.</p>', 'http://localhost/wordpress351/wp-content/uploads/2013/04/ivy3.jpg', 'online', '1', 0),
(2, 'Salem International University Online', 'Earning your degree at Salem International University Online gives you the opportunity to change your life for the better and gives you more career choices than you have ever dreamed about.\r\n<br><br>\r\nSalem International University Online makes getting an education more convenient than ever. In less time than traditional programs, you could be on your way to fulfilling your long-awaited career goals.\r\n<br><br>\r\nDegrees offered at Salem International University Online:\r\n<ul>\r\n<li>Business Administration (AS)</li>\r\n<li>Business Administration (BS)</li>\r\n<li>Accounting</li>\r\n<li>International Business\r\nManagement</li>\r\n<li>Sports Management</li>\r\n<li>Information Technology (BS)</li>\r\n<li>Criminal Justice: CSI (BS)</li>\r\n<li>RN to BSN Degree Completion</li>\r\n<li>Master of Business Administration (MBA)</li>\r\n</ul>\r\nWhen you choose Salem International University Online, you open more doors. Our online program is perfect for any student who wants to start a new career or professional who wants to advance in their career.\r\n<br><br>\r\nAfter completing your degree at Salem International University Online, you\\''ll have marketable, professional skills and the ability to make decisions with integrity and a business-minded perspective.\r\n<br><br>\r\nSalem International University Online\\''s virtual classrooms provide an enhanced learning environment. We bring the classroom to you so you can earn your degree without leaving behind your home, family or job. So fill out the information form and take the first step toward your new and rewarding future!\r\n<br><br><i>Salem International University is a private, for-profit institution of higher learning that is accredited by The Higher Learning Commission of the North Central Association (http://www.ncahlc.org); and the West Virginia State Board of Education.</i>\r\n<br><br>** Please contact admissions for accreditation and financial aid information.\r\nFor more information about our graduation rates, the median debt of students who completed the program and other important information, please \r\n<a title=\\"Program Disclosures\\" data-lyte-options=\\"width:950 height:600 scrollbars:yes\\" class=\\"lytebox\\" href=\\"www.salemu.edu/disclosures\\">click here</a>.  ', 'http://localhost/wordpress351/wp-content/uploads/2013/04/salem1.jpg', 'online', '1', 0),
(3, 'Vista College - Military', '<b>Your Path to a Better Life Starts with Online Training at Home</b>\r\n\r\nEarn Your Online Degree at Vista College Online!\r\n\r\nWe provide online training that leads to diplomas and accredited* Associate of Applied Science (AAS) degrees that can lead to many career opportunities:\r\n<ul>\r\n	<li><b>Business</b> - Our online training program for a Diploma or an Associate Degree Business Administration education provides the real-world experience that employers are looking for.</li>\r\n	<li><b>Healthcare</b> - Our virtual school online offers training programs that prepare you for a rewarding career as a Medical Office Specialist.</li>\r\n	<li><b>Information Technology</b> - An online learning program for a Network Systems Administration degree prepares you for success in any corporation, small company or your own business.</li>\r\n	<li><b>Paralegal</b> - Online learning program for the Associates of Applied Science in Paralegal is designed to prepare students to perform specialized, delegated, substantive legal work for a lawyer, law office, corporation, government agency, or other entity.</li>\r\n</ul>\r\n<i>Financial aid is available for students who qualify, and graduates also benefit from our career services assistance, including resume preparation and interview coaching.</i>\r\n\r\n<b>Take The Next Step Toward a Rewarding Career Right Now!</b>\r\n\r\n<i>*Vista College Online is accredited by the Accrediting Commission of Career Schools and Colleges (ACCSC).</i>\r\n\r\nVista College is recognized as being a military friendly college through the Servicemembers Opportunities Colleges (SOC).\r\n\r\n<i><b>Degree Completion</b> - The time it takes to complete an associate\\\\\\''s degree at Vista College can vary depending on the number of credits accepted for transfer. Students that have prior college credits are encouraged to submit their transcripts for review. Once enrolled in an associate program, a Vista College Student Advisor will work with you to determine how many credits will transfer and your anticipated graduation date. </i>\r\n\r\nFor required program disclosure information, please visit <a href=\\"#\\">www.vistacollege.edu/info</a>', 'http://localhost/wordpress351/wp-content/uploads/2013/04/search_VistaMil.gif', 'online', '1', 0),
(4, 'Brookline College Online', '<b>Accelerate your path to a Nursing career at Brookline College.</b><br><br>\r\nTurn your passion for helping people into a meaningful career with Brookline College\\''s Nursing program. This is your opportunity to prepare for nursing positions in a variety of clinical settings. Get ready for your nursing career quicker with accelerated programs that allow you to go from learning to earning in less time than you may think!\r\n<br><br>\r\nChoose from two bachelor programs:\r\n<ul>\r\n<li>Bachelor of Science in Nursing</li>\r\n<li>Bachelor of Science in Nursing for Baccalaureate Degree Graduates*</li>\r\n</ul>\r\nIf you\\''re already a nurse, continue your education with Brookline\\''s <b>Master of Science in Nursing Education</b>** degree, and prepare to become a nurse educator.<br><br>\r\nBrookline offers you two major benefits:\r\n<br><br><b>Fast </b>- accelerated programs that allow you to go from learning to earning in less time than you may think.\r\n<br><br><b>Supportive</b> - we\\''re here for you, through graduation and beyond. <br><br>\r\nTo get started, simply fill out the form. At Brookline College, we\\''re here to help, so you can be there to help. \r\n<br><br>\r\n<i>*Bachelor’s degree required. This program allows students with a Bachelor\\''s degree in any field to complete their BSN through an accelerated program.<br><br>\r\n**RN license and BSN required.\r\n<br><br>\r\nBrookline College’s Online, Phoenix, Tucson, Tempe and Albuquerque campuses are accredited by the Accrediting Council for Independent Colleges and Schools (ACICS). The Brookline College Bachelor of Science in Nursing for Baccalaureate Degree Graduates nursing education program is a candidate for accreditation by the National League for Nursing Accrediting Commission (3343 Peachtree Road NE, Suite 850, Atlanta, Georgia 30326). Candidacy status does not guarantee that this program will achieve full accreditation, which is granted by the Commission after a full accreditation review including a visit by a team of trained site visitors. Once a program has been granted Candidacy it must seek full accreditation within 2 years.\r\n<br><br>\r\nFor more information about our graduation rates, the median debt of students who completed the program, and other consumer important information, please visit the \\"Reporting and Disclosure\\" tab on our website at <a title=\\"Brookline  Program Disclosures\\" data-lyte-options=\\"width:950 height:600 scrollbars:yes\\" class=\\"lytebox\\" href=\\"http://brooklinecollege.edu/discl/\\">http://brooklinecollege.edu/discl/</a>.</i>\r\n', 'http://localhost/wordpress351/wp-content/uploads/2013/04/brookline1.jpg', 'online', '1', 0),
(5, 'Pittsburgh Technical Institute', 'Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.', 'http://localhost/wordpress351/wp-content/uploads/2013/04/Pittsburghtech.jpg', 'online', '1', 0),
(6, 'National University College', 'At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut laboreet dolore magna aliquyam erat. ', 'http://localhost/wordpress351/wp-content/uploads/2013/04/search_NationalUniversityCollege.gif', 'online', '1', 0),
(7, 'Lincoln College of New England', 'Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. ', 'http://localhost/wordpress351/wp-content/uploads/2013/04/Lincoln-College-of-New-England-Logo.gif', 'online', '1', 0),
(8, 'Rasmussen College Online', ' At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. ', 'http://localhost/wordpress351/wp-content/uploads/2013/04/rasmussencollege.jpg', 'online', '1', 0),
(9, 'South University Online', 'At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut laboreet dolore magna aliquyam erat. ', 'http://localhost/wordpress351/wp-content/uploads/2013/04/south25.gif', 'online', '1', 0),
(10, 'Everest University Online', 'Everest University Online, a Division of Everest University makes career-training convenient and accessible. With courses tailored for working students and others who need a more flexible class...', 'http://localhost/wordpress351/wp-content/uploads/2013/04/euonline.jpg', 'online', '1', 0),
(11, 'The Art Institute Online', 'The Art Institute of Pittsburgh - Online Division is the leader in online creative arts education. Offering 16 academic online degree programs, we\\''re here to help you get the education you need to launch or enhance your creative career. The Art Institute of Pittsburgh - Online Division is a part of The Art Institutes system of schools, with more than 40 locations throughout North America. Founded in 1921, The Art Institute of Pittsburgh supports our online degree programs with more than 85 years of excellence.\r\n', 'http://localhost/wordpress351/wp-content/uploads/2013/04/arti.gif', 'online', '1', 0),
(12, 'Westwood College Online', 'Westwood custom description goes here ', '', 'online', '1', 0),
(13, 'Kaplan University', 'An online education with Kaplan University will give you the tools you need to change your future. Our helpful instructors are dedicated to helping you succeed—and you have 24/7 access to our friendly', 'http://localhost/wordpress351/wp-content/uploads/2013/04/search_kaplan.gif', 'online', '1', 0),
(14, 'Miller-Motte College Online', 'Earn a Degree with Miller-Motte College Online Request Information Today!\r\n\r\nEnroll in an online degree program at Miller-Motte College Online, a premiere online career school', 'http://localhost/wordpress351/wp-content/uploads/2013/04/miller3.jpg', 'online', '1', 0),
(15, 'Ellis University', 'Ellis University 	Ellis University\r\nEllis University offers over 50 different accredited online degrees, certificates and specializations within two online schools. At Ellis University, coursework is based on real-world scenarios', 'http://localhost/wordpress351/wp-content/uploads/2013/04/EllisU2.jpg', 'online', '1', 0),
(16, 'Westwood College Campus', '', 'http://localhost/wordpress351/wp-content/uploads/2013/04/wwcampus.jpg', 'online', '1', 0),
(17, 'Utica College', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br /><br />Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.<br /><br />Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.<br /><br />Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.<br /><br />Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.<br /><br />At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat. <br /><br />Consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br /><br /></p>', 'http://localhost/wordpress351/wp-content/uploads/2013/04/utica.gif', 'online', '1', 0),
(20, 'Laurus College', '<b>Build the Foundation of Your Future with Laurus College</b><br><br>\r\nOur mission is to provide every student with a quality education and a quality experience in order to prepare them for today\\''s marketplace. To do this we strive to provide focused instruction as well as develop in-demand, marketable skills for every student. Our emphasis on career opportunities in all program offerings helps open up avenues of opportunity that previously may have gone unrealized. Our students gain the fundamental skills you may need in fields such as 3D Animation, Business, Computer Networking, Information Technology, Medical Billing, and Web Design. \r\n<br><br>\r\n<b>3D Animation</b>\r\n<br><br>\r\nGain valuable skills in the video game design, television, and movie development industry. You\\''ll learn to work in both 2D and 3D animation environments while working with the industry\\''s major development software, Maya. Maya will be used for modeling, developing textures and animations. \r\n<br><br>\r\n<b>Computer Networking</b>\r\n<br><br>\r\nKeep computer networks up and running by learning how to maintain and upgrade computer networks for all different size organizations. At Laurus College, we teach networking theory as well as skills that will help you use network management software and understand hardware, advanced implementation and maintenance and familiarize you with network and security protection.\r\n<br><br>\r\n<b>Information Technology &amp; Service Professional</b>\r\n<br><br>\r\nThis program will help you prepare and study for an A+ Certification and develop computer servicing skills. You\\''ll also gain familiarity with computer hardware and component installation, work with various OS and communication platforms and learn techniques for troubleshooting. \r\n<br><br>\r\n<b>Medical Billing</b>\r\n<br><br>\r\nLaurus College can help you work towards a career in the medical billing field. You\\''ll learn different medical terminology, steps to analyzing forms and study diagnosis, supplies and procedural coding. \r\n<br><br>\r\n<b>Office Support</b>\r\n<br><br>\r\nMany organizations need qualified office support, and without those people in place productivity of those organizations could suffer. At Laurus, you can gain computer and administrative skills for use in today\\''s office environment. You\\''ll develop skills in word processing, business communications, spreadsheet usage and creating Microsoft PowerPoint presentations. \r\n<br><br>\r\n<b>Professional Business Systems</b>\r\n<br><br>\r\nThis certificate will you help you develop fundamental skills in business administration, accounting, business start-up and marketing. You\\''ll learn a wide range of Microsoft Office software, basic accounting and marketing principles &amp; techniques and gain an understanding of project management strategies.\r\n<br><br>\r\n<b>Web Design</b>\r\n<br><br>\r\nAs the way people use the internet continues to change web designers and developers will be needed. Laurus College can help you develop practical skills for this exciting field. You\\''ll train on software and programs that are widely used in the industry. Other items covered are: exploring web page planning and production strategies as well as creating and editing web pages. \r\n<br><br>\r\n<b><u>Disclaimers:</u></b><br>\r\nFor Student Consumer Disclosures please visit: \r\n<a title=\\"Laurus College  Disclosures\\" data-lyte-options=\\"width:950 height:600 scrollbars:yes\\" class=\\"lytebox\\" href=\\"http://lauruscollege.edu/dl/Laurus_College_Student_Consumer_Information.pdf\\">click here</a>\r\n<br><br>\r\nLaurus College is accredited by the Accrediting Council for Independent Colleges and Schools (ACICS)', '', 'online', '1', 0),
(21, 'Northcentral University', 'Northcentral University was founded with the goal of providing accessible, high-quality, online graduate degrees to working professionals.  NCU currently serves students worldwide, focusing on Doctoral and Masterï¿½s degrees in the Schools of Business and Technology Management, Education, and Behavioral and Health Sciences.  Providing unprecedented access to regionally accredited online graduate degree programs utilizing a One-to-One faculty-mentored approach to online learning with highly-credentialed faculty, Northcentral University is an excellent choice for adult students who share a passion for excellence in higher education.\r\n<br><br>\r\n<b>MISSION </b><br>\r\nNorthcentral University educates professionals throughout the world and provides an accessible opportunity to earn a U.S. regionally accredited degree. Northcentral mentors students One-to-One with highly credentialed faculty via advanced delivery modalities.  Northcentral commits to helping students achieve academically and become valuable contributors to their communities and within their professions.\r\n<br><br>\r\n<b>VISION</b><br>\r\nNorthcentral University is a premier online graduate university and a global leader in providing unprecedented access to U.S. regionally accredited higher education.\r\n<br><br>\r\n<b>VALUES <br> \r\nI.D.E.A.\\''s Founded on INTEGRITY</b><br>\r\nWe hold all members of our community to the highest ethical standards of professional and academic conduct and the rules and regulations of U.S. higher education.\r\n<br><ul>\r\n<li><b>Innovation:</b> We envision new and innovative education delivery systems, and support proven concepts of teaching and learning.  We encourage our community to seek solutions to educational challenges that will improve the quality of our programs and services.</li>\r\n<br>\r\n<li><b>Diversity:</b> We value diversity of thought and action as a strength that allows our community to transcend organizational and geographical boundaries. We expect members of our community to treat people with respect and dignity.</li>\r\n<br>\r\n<li><b>Excellence:</b> Our community is committed to excellence in academics and service. We value leadership and strive for continuous improvement in everything we do.  We define and measure outcomes and take action to ensure that our communityï¿½s passion for excellence is never compromised.</li>\r\n<br>\r\n<li><b>Accountability:</b>  We are deeply committed to holding each member of the University responsible for their scholarly and professional work. We expect financial responsibility in the actions of our students and University team.</li>\r\n</ul>\r\n<b>WHY NORTHCENTRAL?</b>\r\n<ul><li>Regionally accredited</li>\r\n<li>One-to-One faculty mentored approach</li>\r\n<li>No physical residency requirements</li>\r\n<li>Highly credentialed faculty</li>\r\n<li>Applied experiential learning</li>\r\n<li>Weekly course starts</li>\r\n</ul>\r\n<b>ACCREDITATION</b><br>\r\nNorthcentral University is accredited by the Higher Learning Commission (HLC) and is a member of the North Central Association of Colleges and Schools (NCA) (230 South LaSalle Street, Suite 7-500, Chicago, IL 60604, 1.800.621.7440,  <a href=\\"http://www.ncahlc.org\\">www.ncahlc.org)</a>. In addition to regional accreditation from the Higher Learning Commission (HLC), NCUï¿½s degree programs in the School of Business and Technology Management are accredited by the Accreditation Council for Business Schools and Programs (ACBSP).  NCU was the first accredited online university to feature an ACBSP accredited business school.\r\n<p>Northcentral University strives to enable students to make informed choices about their academic program selection by making disclosures to prospective students in a clear, timely, and meaningful way. Visit <a href=\\"http://www.ncu.edu/GE\\">www.ncu.edu/GE</a> for more information.</p>', 'http://localhost/wordpress351/wp-content/uploads/2013/04/search_Northcentral.gif', 'online', '1', 0);

--
-- Dumping data for table `wp_ee_studies`
--

INSERT INTO `wp_ee_studies` (`id`, `name`, `trashed`) VALUES
(1, 'Business', 0),
(2, 'Criminal Justice', 0),
(3, 'Education &amp; Teaching', 0),
(4, 'Engineering', 0),
(5, 'Health and Fitness', 0),
(6, 'HVAC', 0),
(7, 'Liberal Arts', 0),
(8, 'Medical Billing &amp; Coding', 0),
(9, 'Nursing', 0),
(10, 'Science &amp; Math', 0),
(11, 'Technology', 0),
(12, 'Trades', 0),
(13, 'Design', 0),
(14, 'Health Care', 0),
(15, 'Legal &amp; Paralegal', 0),
(16, 'Game Art &amp; Design', 0),
(17, 'Media Arts &amp; Animation', 0),
(18, 'Automotive', 0),
(19, 'Cosmetology', 0),
(20, 'Counseling', 0),
(21, 'Culinary', 0),
(22, 'Dental Assisting', 0),
(23, 'Fashion', 0),
(24, 'Interior Design', 0),
(25, 'Lab Technician', 0),
(26, 'Massage Therapy', 0),
(27, 'Medical Assisting', 0),
(28, 'Pharmacist', 0),
(29, 'Psychology', 0),
(30, 'Social Science', 0),
(31, 'Tourism &amp; Hospitality', 0),
(32, 'Web Design', 0),
(33, 'Wind Energy', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
