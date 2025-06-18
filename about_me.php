<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="About the developer of University of Sicily website">
    <meta name="theme-color" content="#2c3e50">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>About Us - University Of Sicily</title>
    <link rel="stylesheet" href="main-pages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="scripts.js" defer></script>
</head>
<body>

<?php
// Include the left sidebar component
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'LeftSidebar.php';
?>

<div class="main-content chrome-fix">
    <header>
        <div class="header-content">
            <img src="unilogo.png" alt="University of Sicily Logo" class="logo-img">
            <h1>University Of Sicily</h1>
            <p class="tagline">About the Developers</p>
        </div>
    </header>

    <main>


<section class="profile-section">
            <div class="profile-header">
                <div class="profile-image">
                    <img src="farshid.jpg" alt="Farshid Farahtaj" class="profile-image">
                </div>
                <div class="profile-info">
                    <h2>Farshid Farahtaj</h2>
                    <p class="profile-title">IT Professional & Data Analyst</p>
                    <div class="social-links">
                        <a href="https://www.linkedin.com/in/farshidfarahtaj/" class="social-link" target="_blank">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                        <a href="https://www.instagram.com/farshidfarahtaj.ff/" class="social-link" target="_blank">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                    </div>
                </div>
            </div>

            <div class="profile-header">
                <div class="profile-image">
                    <img src="farsad.PNG" alt="Farsad Ghane Kia" class="profile-image">
                </div>
                <div class="profile-info">
                    <h2>Farsad Ghane Kia</h2>
                    <p class="profile-title">IT Professional & Data Analyst</p>
                    <div class="social-links">
                        <a href="https://www.linkedin.com/in/farsad-ghane-kia/" class="social-link" target="_blank">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                        <a href="https://www.instagram.com/farshidfarahtaj.ff/" class="social-link" target="_blank">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                    </div>
                </div>
            </div>

            <div class="profile-details">
                <section class="profile-card">
                    <h3><i class="fas fa-user"></i> About Our Team</h3>
                    <p>We are Farshid Farahtaj and Farsad Ghane Kia, two passionate and driven students in our final year of the Data Analysis program at the University of Messina.</p>
                    <p>With strong foundations in software development, IT systems, and data analysis, we've teamed up to bring our shared vision of innovative, efficient, and user-friendly web solutions to life. Both of us come from technical backgrounds enriched by hands-on experience — from managing IT infrastructures and security systems to designing interactive web applications.</p>
                    <p>Our goal through this project is to demonstrate real-world problem solving using modern web technologies. We believe in clean design, functional interfaces, and data-driven solutions that can genuinely improve everyday processes.</p>
                    <p>This collaboration is not just a course assignment — it's a step forward in building our professional portfolio and pushing the boundaries of what we can create as future data and software professionals.</p>
                    <p>Thank you for visiting our page. We're excited to share our work with you!</p>
                </section>

                <section class="profile-card">
                    <h3><i class="fas fa-lightbulb"></i> Introduction</h3>
                    <p>Through hands-on experience and academic exploration, we've deepened our expertise in areas such as IT, system integration, data analysis, and software development. Our shared goal is to continue expanding this knowledge and to become leaders in creating innovative, efficient, and secure solutions for the modern world.</p>
                    <p>Together, we are committed to applying what we've learned—both in the classroom and in the field—to build tools and platforms that contribute to a safer, smarter, and more connected future.</p>
                </section>
            </div>

            <section class="project-section">
                <h3><i class="fas fa-project-diagram"></i> About This Project</h3>
                <p>This project is a comprehensive web portal designed to efficiently manage university class timetables. It ensures room availability, considers maximum capacity, and integrates various subjects and courses.</p>
                
                <div class="features-grid">
                    <div class="feature-card">
                        <i class="fas fa-user-lock feature-icon"></i>
                        <h4>User Registration and Login</h4>
                        <p>Secure authentication for users.</p>
                    </div>
                    
                    <div class="feature-card">
                        <i class="fas fa-calendar-alt feature-icon"></i>
                        <h4>Timetable Management</h4>
                        <p>Administrators can add, remove, and modify timetables.</p>
                    </div>
                    
                    <div class="feature-card">
                        <i class="fas fa-user-graduate feature-icon"></i>
                        <h4>Student View</h4>
                        <p>Students can view their course timetables in a read-only format.</p>
                    </div>
                    
                    <div class="feature-card">
                        <i class="fas fa-server feature-icon"></i>
                        <h4>Backend Development</h4>
                        <p>Using PHP and MySQL to provide robust APIs.</p>
                    </div>
                    
                    <div class="feature-card">
                        <i class="fas fa-laptop-code feature-icon"></i>
                        <h4>Frontend Development</h4>
                        <p>Built with HTML, CSS, and Angular.js for a dynamic user experience.</p>
                    </div>
                </div>
            </section>
            
            <section class="skills-section">
                <h3><i class="fas fa-code"></i> Technical Skills</h3>
                <div class="skills-grid">
                    <div class="skill-category">
                        <h4>Programming Languages</h4>
                        <ul class="skill-list">
                            <li><span class="skill-badge">PHP</span></li>
                            <li><span class="skill-badge">JavaScript</span></li>
                            <li><span class="skill-badge">HTML/CSS</span></li>
                            <li><span class="skill-badge">MySQL</span></li>
                        </ul>
                    </div>
                    
                    <div class="skill-category">
                        <h4>Technologies</h4>
                        <ul class="skill-list">
                            <li><span class="skill-badge">MySQL</span></li>
                            <li><span class="skill-badge">GitHub</span></li>
                        </ul>
                    </div>
                    
                    <div class="skill-category">
                        <h4>Other Skills</h4>
                        <ul class="skill-list">
                            <li><span class="skill-badge">Data Analysis</span></li>
                            <li><span class="skill-badge">Network Manager</span></li>
                            <li><span class="skill-badge">Programming</span></li>
                            <li><span class="skill-badge">IT Infrastructure</span></li>
                        </ul>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Contact Information</h4>
                <p><i class="fas fa-envelope"></i> Email: farshid.farahtaj@studenti.unime.it</p>
                <p><i class="fas fa-envelope"></i> Email: farsad.ghanekia@studenti.unime.it</p>
                <p><i class="fas fa-map-marker-alt"></i> Location: Messina, Italy</p>
            </div>
            <div class="footer-section">
                <h4>Connect With Us</h4>
                <div class="social-icons">
                    <a href="https://www.linkedin.com/in/farshidfarahtaj/"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.linkedin.com/in/farsad-ghane-kia"><i class="fab fa-linkedin"></i></a>
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
