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
    <title>About Me - University Of Sicily</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
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
            <p class="tagline">About the Developer</p>
        </div>
    </header>

    <main>
        <section class="profile-section">
            <div class="profile-header">
                <div class="profile-image">
                    <!-- Placeholder for profile image -->
                    <i class="fas fa-user-circle"></i>
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
            
            <div class="profile-details">
                <section class="profile-card">
                    <h3><i class="fas fa-user"></i> Personal Information</h3>
                    <p>My name is Farshid Farahtaj. I am a seasoned IT and security systems professional with a strong background in technical project management, data analysis, and software development. I am currently in my last year of a Data Analysis degree at the University of Messina and am eager to leverage technology to solve complex problems and drive innovation.</p>
                    <p>With several years of hands-on experience in working on different technical projects in Shiraz, Iran, I have specialized in designing and implementing security solutions, optimizing IT infrastructures, and analyzing data to drive business decisions. I would like to utilize my skills in forward-thinking organizations that use technology for growth and efficiency.</p>
                    <p>I always look forward to the opportunity to create innovative projects, design new solutions, and establish my portfolio in data-driven decision-making and computer programs.</p>
                    <p>Currently, I am a third-year student in Data Analysis at the University of Messina, continuing my journey to expand my technical skills.</p>
                </section>

                <section class="profile-card">
                    <h3><i class="fas fa-lightbulb"></i> Introduction</h3>
                    <p>I have also been fascinated by technology, security, and the way systems can be integrated to improve our lives. Over the years, I have gained a personal understanding of surveillance systems and security infrastructure needed to protect individuals, information, and buildings. My goal is to continue to expand my understanding, particularly in data analysis and software development, to be a pacesetter toward a safer and more efficient world.</p>
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
                <p><i class="fas fa-envelope"></i> Email: farahtajfarshid@gmail.com</p>
                <p><i class="fas fa-map-marker-alt"></i> Location: Messina, Italy</p>
            </div>
            <div class="footer-section">
                <h4>Connect With Me</h4>
                <div class="social-icons">
                    <a href="https://www.linkedin.com/in/farshidfarahtaj/"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/farshidfarahtaj.ff/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
        </div>
    </footer>
</div>

<style>
/* About Me page specific styles */
.header-content {
    position: relative;
    z-index: 2;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.profile-section {
    display: flex;
    flex-direction: column;
    gap: 30px;
    transform: translateZ(0);
    -webkit-transform: translateZ(0);
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color);
    position: relative;
}

.profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), #34495e);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    border: 5px solid white;
    position: relative;
    z-index: 1;
}

.profile-image i {
    font-size: 100px;
    color: white;
    text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.profile-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-info {
    flex: 1;
}

.profile-info h2 {
    margin-bottom: 10px;
    font-size: 2rem;
    color: var(--primary-color);
    font-weight: 700;
}

.profile-title {
    color: var(--light-text);
    font-size: 1.2rem;
    margin-bottom: 15px;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-link {
    display: inline-flex;
    align-items: center;
    padding: 10px 18px;
    background: linear-gradient(135deg, var(--primary-color), #34495e);
    color: white;
    border-radius: 30px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.social-link i {
    margin-right: 8px;
}

.social-link:hover {
    background: linear-gradient(135deg, var(--secondary-color), #2980b9);
    transform: translateY(-3px);
    color: white;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

.social-link:active {
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
}

.profile-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}

.profile-card {
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    transform: translateZ(0);
    -webkit-transform: translateZ(0);
}

.profile-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
}

.profile-card h3 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    color: var(--primary-color);
    font-weight: 600;
}

.profile-card h3 i {
    color: var(--secondary-color);
    font-size: 1.2rem;
}

.profile-card p {
    line-height: 1.6;
    color: var(--text-color);
    margin-bottom: 15px;
}

.profile-card p:last-child {
    margin-bottom: 0;
}

.project-section {
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
    transform: translateZ(0);
    -webkit-transform: translateZ(0);
}

.project-section h3 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    color: var(--primary-color);
    font-weight: 600;
}

.project-section h3 i {
    color: var(--secondary-color);
    font-size: 1.2rem;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 25px;
}

.feature-card {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 25px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-top: 4px solid var(--secondary-color);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    position: relative;
    overflow: hidden;
    transform: translateZ(0);
    -webkit-transform: translateZ(0);
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    font-size: 2.2rem;
    color: var(--secondary-color);
    margin-bottom: 15px;
    display: block;
}

.feature-card h4 {
    margin-bottom: 12px;
    font-weight: 600;
    color: var(--primary-color);
}

.skills-section {
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
    margin-top: 30px;
    transform: translateZ(0);
    -webkit-transform: translateZ(0);
}

.skills-section h3 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 25px;
    color: var(--primary-color);
    font-weight: 600;
}

.skills-section h3 i {
    color: var(--secondary-color);
    font-size: 1.2rem;
}

.skills-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
}

.skill-category h4 {
    margin-bottom: 18px;
    color: var(--primary-color);
    padding-bottom: 8px;
    border-bottom: 1px solid var(--border-color);
    font-weight: 600;
}

.skill-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.skill-badge {
    display: inline-block;
    padding: 6px 14px;
    background: linear-gradient(135deg, var(--primary-color), #34495e);
    color: white;
    border-radius: 20px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
}

.skill-badge:hover {
    background: linear-gradient(135deg, var(--secondary-color), #2980b9);
    transform: translateY(-3px);
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
}

@media (max-width: 992px) {
    .profile-card, .project-section, .skills-section {
        padding: 25px;
    }
    
    .feature-card {
        padding: 20px;
    }
}

@media (max-width: 768px) {
    .profile-header {
        flex-direction: column;
        text-align: center;
        padding-bottom: 25px;
    }
    
    .profile-image {
        width: 130px;
        height: 130px;
    }
    
    .profile-image i {
        font-size: 80px;
    }
    
    .social-links {
        justify-content: center;
        margin-top: 5px;
    }
    
    .profile-details {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .skills-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .profile-info h2 {
        font-size: 1.8rem;
    }
}

@media (max-width: 576px) {
    .profile-card, .project-section, .skills-section {
        padding: 20px;
    }
    
    .profile-image {
        width: 110px;
        height: 110px;
    }
    
    .profile-image i {
        font-size: 70px;
    }
    
    .social-link {
        padding: 8px 15px;
        font-size: 0.85rem;
    }
    
    .profile-info h2 {
        font-size: 1.6rem;
    }
    
    .profile-title {
        font-size: 1.1rem;
    }
}
</style>

</body>
</html>
