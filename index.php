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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
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
                    <a href="https://www.instagram.com/farshidfarahtaj.ff/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/farshidfarahtaj/"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
        </div>
    </footer>
</div>

<style>
/* Additional styles specific to the homepage */
.header-content {
    position: relative;
    z-index: 2;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.tagline {
    color: var(--light-text);
    font-size: 1.1rem;
    margin-top: -10px;
    font-style: italic;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin: 30px 0;
}

.feature-card {
    background-color: white;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-top: 4px solid var(--secondary-color);
    position: relative;
    overflow: hidden;
    z-index: 1;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    transform: translateZ(0);
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    font-size: 2rem;
    color: var(--secondary-color);
    margin-bottom: 15px;
    display: block;
}

.cta-section {
    background: linear-gradient(135deg, var(--primary-color), #34495e);
    color: white;
    padding: 35px;
    border-radius: 8px;
    text-align: center;
    margin: 40px 0 20px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.cta-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="rgba(255,255,255,0.03)"/></svg>');
    opacity: 0.5;
    z-index: 0;
}

.cta-section h3 {
    color: white;
    margin-bottom: 15px;
    position: relative;
    z-index: 1;
}

.cta-section p {
    position: relative;
    z-index: 1;
}

.cta-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 25px;
    position: relative;
    z-index: 1;
}

.cta-button {
    background-color: var(--secondary-color);
    color: white;
    padding: 12px 25px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.cta-button::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.1);
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.3s ease;
    z-index: -1;
}

.cta-button:hover {
    background-color: #2980b9;
    transform: translateY(-3px);
    color: white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.cta-button:hover::after {
    transform: scaleX(1);
    transform-origin: left;
}

.cta-button:active {
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    margin-bottom: 20px;
}

.footer-section h4 {
    color: var(--primary-color);
    margin-bottom: 15px;
    font-size: 1.1rem;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 8px;
}

.footer-section ul li a {
    color: var(--light-text);
    transition: color 0.3s ease;
}

.footer-section ul li a:hover {
    color: var(--secondary-color);
}

.social-icons {
    display: flex;
    gap: 10px;
}

.social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background-color: var(--primary-color);
    color: white;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.social-icons a:hover {
    background-color: var(--secondary-color);
    transform: translateY(-3px);
}

.footer-bottom {
    border-top: 1px solid var(--border-color);
    padding-top: 20px;
    text-align: center;
}

@media (max-width: 768px) {
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .cta-buttons {
        flex-direction: column;
        gap: 10px;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .social-icons {
        justify-content: center;
    }
}
</style>

</body>
</html>
