<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="University of Sicily - Excellence in Education">
    <meta name="theme-color" content="#2c3e50">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>University Of Sicily - Excellence in Education</title>
    <link rel="stylesheet" href="main-pages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="scripts.js" defer></script>
</head>
<body>

<?php
// Include the left sidebar component
session_start();
include 'LeftSidebar.php';
?>

<div class="main-content chrome-fix">
    <header>
        <div class="header-content">
            <img src="unilogo.png" alt="University of Sicily Logo" class="logo-img">
            <h1>University Of Sicily</h1>
            <p class="tagline">Excellence in Education Since 1955</p>
        </div>
    </header>

    <main>
        <section class="welcome-section">
            <h2><i class="fas fa-university"></i> Welcome to the University of Sicily</h2>
            <p>The University of Sicily is a premier institution dedicated to academic excellence, research, and innovation. Located in the heart of Sicily, we provide a diverse and inclusive learning environment that fosters intellectual and personal growth.</p>
        </section>
        
        <div class="features-grid">
            <section class="info-section feature-card">
                <i class="fas fa-lightbulb feature-icon"></i>
                <h3>Our Vision & Mission</h3>
                <p>At the University of Sicily, we aim to nurture future leaders by offering cutting-edge education and research opportunities. Our mission is to inspire critical thinking, creativity, and global engagement through high-quality academic programs and interdisciplinary collaborations.</p>
            </section>
            
            <section class="info-section feature-card">
                <i class="fas fa-graduation-cap feature-icon"></i>
                <h3>Programs & Academics</h3>
                <p>We offer a wide range of undergraduate, graduate, and doctoral programs across various fields, including Science, Technology, Humanities, Business, and Medicine. Our world-class faculty is committed to delivering innovative teaching and mentorship to prepare students for successful careers.</p>
            </section>

            <section class="info-section feature-card">
                <i class="fas fa-flask feature-icon"></i>
                <h3>Research & Innovation</h3>
                <p>With advanced research facilities and a strong focus on technological advancements, the University of Sicily is a hub for groundbreaking discoveries. We encourage our students and faculty to engage in research projects that have a meaningful impact on society.</p>
            </section>

            <section class="info-section feature-card">
                <i class="fas fa-globe-europe feature-icon"></i>
                <h3>Global Partnerships</h3>
                <p>We have established strong international collaborations with universities and institutions worldwide. Our exchange programs and research initiatives provide students with valuable global experiences, enhancing their academic and professional perspectives.</p>
            </section>

            <section class="info-section feature-card">
                <i class="fas fa-users feature-icon"></i>
                <h3>Campus Life & Community</h3>
                <p>Our university boasts a vibrant and inclusive campus, offering a variety of cultural, academic, and extracurricular activities. Students have access to clubs, organizations, and events that promote networking, leadership, and personal development.</p>
            </section>
            
            <section class="info-section feature-card">
                <i class="fas fa-medal feature-icon"></i>
                <h3>Achievements & Recognition</h3>
                <p>The University of Sicily has been recognized for its excellence in education, research, and community engagement. Our faculty members are esteemed in their fields, and our alumni have gone on to make significant contributions to society.</p>
            </section>
        </div>
        
        <section class="cta-section">
            <h3>Join Our Academic Community</h3>
            <p>Ready to embark on your educational journey? Explore our programs and discover how the University of Sicily can help you achieve your academic and career goals.</p>
            <div class="cta-buttons">
                <a href="login.php" class="cta-button">Student Login</a>
                <a href="register.php" class="cta-button">Apply Now</a>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Contact Us</h4>
                <p><i class="fas fa-map-marker-alt"></i>  Viale Palermo, Palermo, Sicily</p>
                <p><i class="fas fa-phone"></i> +39 333 715 8980</p>
                <p><i class="fas fa-envelope"></i> info.students@unisicily.it</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Registery</a></li>
					<li><a href="about_me.php">About Me</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Connect With Us</h4>
                <div class="social-icons">
                    <a href="https://www.linkedin.com/in/farshidfarahtaj/"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.linkedin.com/in/farsad-ghane-kia/"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
        </div>
    </footer>
</div>

</body>
</html>
