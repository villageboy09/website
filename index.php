<?php
session_start();
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" as="style">
<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" as="script">
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-F9ED2DFZEV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-F9ED2DFZEV');
</script>
    <style>
/* Import Poppins Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');


/* Global Styles */
:root {
    --primary-color: #2ecc71;
    --secondary-color: #27ae60;
    --dark-color: #2c3e50;
    --light-color: #ecf0f1;
    --transition: all 0.3s ease;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

html {
    scroll-behavior: smooth;
}

body {
    line-height: 1.6;
    color: var(--dark-color);
    overflow-x: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Typography */
h1, h2, h3, h4, h5, h6 {
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1rem;
}

p {
    margin-bottom: 1rem;
    font-weight: 400;
}

/* Hero Section */
.hero {
    position: relative;
    height: 100vh;
    overflow: hidden;
}

.hero-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    z-index: 2;
}

.hero-content {
    position: relative;
    z-index: 3;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    padding: 0 20px;
}

.hero-content h1 {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 20px;
    animation: fadeInDown 1s ease;
}

.hero-content p {
    font-size: 1.25rem;
    max-width: 600px;
    margin-bottom: 30px;
    animation: fadeInUp 1s ease 0.3s;
    font-weight: 400;
}

/* About Section */
#about {
    padding: 100px 0;
}

#about p {
    font-size: 1.1rem;
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
    color: #666;
}

/* Services Section */
#services {
    padding: 100px 0;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    padding: 20px;
}

.service-card {
    background: white;
    padding: 40px 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: var(--transition);
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.service-card i {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 20px;
}

.service-card h3 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: var(--dark-color);
}

.service-card p {
    color: #666;
    font-size: 0.95rem;
}

/* Stats Section */
.stats-section {
    background: var(--dark-color);
    padding: 80px 0;
    color: white;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    max-width: 1000px;
    margin: 0 auto;
}

.stat-card {
    text-align: center;
    padding: 20px;
}

.stat-number {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: white;
}

.stat-card p {
    font-size: 1.1rem;
    font-weight: 500;
    margin: 0;
}

/* Courses Section */
.courses-section {
    padding: 100px 0;
    background: white;
}

.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    padding: 20px;
}

.course-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: var(--transition);
}

.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.course-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.course-content {
    padding: 25px;
}

.course-title {
    font-size: 1.3rem;
    margin-bottom: 10px;
    color: var(--dark-color);
}

.course-price {
    color: var(--primary-color);
    font-size: 1.4rem;
    font-weight: 700;
    margin: 15px 0;
}

/* Work Section */
#work {
    padding: 100px 0;
}

.work-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    padding: 20px;
}

.work-item {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    height: 300px;
}

.work-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.work-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(46, 204, 113, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.work-item:hover .work-overlay {
    opacity: 1;
}

.work-overlay h3 {
    color: white;
    font-size: 1.5rem;
    transform: translateY(20px);
    transition: var(--transition);
}

.work-item:hover .work-overlay h3 {
    transform: translateY(0);
}

/* Sponsors Section */
#sponsors {
    padding: 80px 0;
    background: white;
}

.sponsors {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    align-items: center;
    justify-items: center;
    max-width: 1000px;
    margin: 0 auto;
}

.sponsor-logo {
    max-width: 100px;
    height: auto;
    opacity: 0.7;
    transition: var(--transition);
}

.sponsor-logo:hover {
    opacity: 1;
}

/* CTA Section */
.cta-section {
    background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('/api/placeholder/1920/1080') center/cover;
    padding: 120px 20px;
    text-align: center;
    color: white;
}

.cta-content {
    max-width: 800px;
    margin: 0 auto;
}

.cta-content h2 {
    font-size: 2.8rem;
    margin-bottom: 25px;
}

.cta-content p {
    font-size: 1.2rem;
    margin-bottom: 40px;
    opacity: 0.9;
}

/* Button Styles */
.btn {
    display: inline-block;
    padding: 15px 35px;
    background: var(--primary-color);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: var(--transition);
    border: none;
    cursor: pointer;
}

.btn:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
}

/* Section Title Global Style */
.section-title {
    text-align: center;
    font-size: 2.8rem;
    margin-bottom: 50px;
    color: var(--dark-color);
    position: relative;
    padding-bottom: 20px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: var(--primary-color);
    border-radius: 2px;
}

/* Animations */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-content h1 {
        font-size: 3.5rem;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.8rem;
    }
    
    .hero-content p {
        font-size: 1.1rem;
    }
    
    .services-grid,
    .courses-grid,
    .work-gallery {
        grid-template-columns: 1fr;
        max-width: 500px;
        margin: 0 auto;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .section {
        padding: 60px 0;
    }
    
    .cta-content h2 {
        font-size: 2.3rem;
    }
}

@media (max-width: 480px) {
    .hero-content h1 {
        font-size: 2.2rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .sponsor-logo {
        max-width: 120px;
    }
    
    .btn {
        padding: 12px 25px;
        font-size: 1rem;
    }
}
/* Footer Styles */
footer {
    background-color: #1a1a1a;
    color: #fff;
    padding: 80px 0 20px;
    position: relative;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
    margin-bottom: 60px;
}

.footer-section h3 {
    color: var(--primary-color);
    font-size: 1.5rem;
    margin-bottom: 20px;
    font-weight: 600;
}

.footer-section p {
    color: #999;
    line-height: 1.8;
    font-size: 0.95rem;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 12px;
}

.footer-section ul li a {
    color: #999;
    text-decoration: none;
    transition: var(--transition);
    font-size: 0.95rem;
}

.footer-section ul li a:hover {
    color: var(--primary-color);
    padding-left: 5px;
}

.social-icons {
    display: flex;
    gap: 15px;
}

.social-icons a {
    color: #fff;
    background: rgba(255, 255, 255, 0.1);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.social-icons a:hover {
    background: var(--primary-color);
    transform: translateY(-3px);
}

.social-icons i {
    font-size: 1.2rem;
}

.footer-bottom {
    text-align: center;
    padding-top: 30px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-bottom p {
    color: #999;
    font-size: 0.9rem;
}


/* Responsive Adjustments */
@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .social-icons {
        justify-content: center;
    }


}

@media (max-width: 480px) {
    footer {
        padding: 60px 0 20px;
    }

    .footer-section h3 {
        font-size: 1.3rem;
    }

    .social-icons a {
        width: 35px;
        height: 35px;
    }
}

/* AOS Animation Styles */
[data-aos] {
    opacity: 0;
    transition-property: opacity, transform;
}

[data-aos].aos-animate {
    opacity: 1;
}

[data-aos="fade-up"] {
    transform: translateY(30px);
}

[data-aos="fade-up"].aos-animate {
    transform: translateY(0);
}

/* Stats Animation */
.stat-number {
    transition: color 0.3s ease;
}

.stat-number.animated {
    color: var(--primary-color);
}

       /* Styles for the floating banner */
        .floating-banner {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 1, 0.8);
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            z-index: 1000;
            max-width: 90%;
            width: 350px;
        }

        .banner-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .banner-button {
            display: inline-block;
            background-color: #fa5c5c;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .banner-button:hover {
            background-color: #45a049;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff5c5c;
            border: none;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
            font-size: 16px;
            line-height: 25px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .floating-banner {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <main>
 <section class="hero" id="home">
        <video class="hero-video" autoplay loop muted playsinline>
            <source src="https://firebasestorage.googleapis.com/v0/b/data-adcfe.appspot.com/o/7630_Hand_Field_1280x720.mp4?alt=media&token=9a06aa7e-836b-45fb-a44f-3e4c0fc4f40d" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
<div class="hero-content">
    <h1>Transform Agriculture with Smart Solutions</h1>
    <p>Join CropSync's innovative platform to experience the power of RFID technology in agriculture. From crop advisory services to smart farm management, CropSync is revolutionizing how farmers access real-time data and insights.</p>
</div>


</section>

    <!-- Floating Banner -->
    <div class="floating-banner" id="floatingBanner">
        <button class="close-button" onclick="closeBanner()">&times;</button>
        <img src="Playstore.jpeg" alt="Promotional Banner" class="banner-image">
        <p>We are now live on Play Store!</p>
        <a href="https://play.google.com/store/apps/details?id=com.cropsync.CropSync" class="banner-button">Download Now</a>
    </div>



        <section id="about" class="section"  data-aos="fade-up">
            <div class="container">
                <h2 class="section-title">About Us</h2>
                <p>CropSync is a startup dedicated to Agriculture extension and Advisory services. We are passionate about empowering farmers with cutting-edge technology and expert knowledge to optimize their crop production and sustainability practices.</p>
            </div>
        </section>

        <section id="services" class="section"  data-aos="fade-up">
            <div class="container">
                <h2 class="section-title">Our Services</h2>
                <div class="services-grid" data-aos-delay="100">
                    <div class="service-card">
                        <i class="fas fa-seedling"></i>
                        <h3>Soil Testing</h3>
                        <p>Comprehensive soil analysis to optimize your crop's growth potential.</p>
                    </div>
                    <div class="service-card" data-aos-delay="200">
                        <i class="fas fa-leaf"></i>
                        <h3>Crop Advisory</h3>
                        <p>Expert guidance on crop management and optimization strategies.</p>
                    </div>
                    <div class="service-card" data-aos-delay="300">
                        <i class="fas fa-tractor"></i>
                        <h3>Farm Advisory</h3>
                        <p>Personalized consulting to improve overall farm productivity.</p>
                    </div>
                    <div class="service-card" data-aos-delay="400">
                        <i class="fas fa-wifi"></i>
                        <h3>IoT Services</h3>
                        <p>Cutting-edge technology for real-time farm monitoring and management.</p>
                    </div>
                </div>
            </div>
        </section>
            <section class="stats-section" data-aos="fade-up">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number" data-count="500">0</div>
                <p>Successful Interns</p>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-count="5">0</div>
                <p>Active Internships</p>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-count="10">0</div>
                <p>Virtual Job Simulation Courses</p>
            </div>
        </div>
    </section>
        <section class="courses-section" id="courses" data-aos="fade-up">
        <h2 class="section-title">Featured Courses</h2>
        <div class="courses-grid">
            <div class="course-card">
                <img src="https://picsum.photos/200/300" alt="Agricultural Data Analysis" class="course-image">
                <div class="course-content">
                    <h3 class="course-title">Crop Consultant/Agronomist</h3>
                    <div class="course-price">₹499</div>
                    <p>Master data-driven decision making in modern agriculture.</p>
                    <a href="courses.php" class="btn">Learn More</a>
                </div>
            </div>
            <div class="course-card">
                <img src="https://picsum.photos/200/300" alt="Supply Chain Manager" class="course-image">
                <div class="course-content">
                    <h3 class="course-title">Supply Chain Manager</h3>
                    <div class="course-price">₹699</div>
                    <p>Explore various supply chain optimisation techniques</p>
                    <a href="courses.php" class="btn">Learn More</a>
                </div>
            </div>
        </div>
    </section>



        <section id="work" class="section">
            <div class="container">
                <h2 class="section-title">Our Work</h2>
                <div class="work-gallery">
                    <div class="work-item lax" data-lax-translate-y="0 0, 200 -50" data-lax-opacity="0 0, 200 1">
                        <img src="work1.jpg" alt="CropSync Work 1">
                        <div class="work-overlay">
                            <h3>Soil Analysis</h3>
                        </div>
                    </div><div class="work-item lax" data-lax-translate-y="0 0, 200 -50" data-lax-opacity="0 0, 200 1" data-lax-delay="200"> 
                        <img src="work2.jpeg" alt="CropSync Work 2">
                        <div class="work-overlay">
                            <h3>Crop Management</h3>
                        </div>
                    </div>
                    <div class="work-item lax" data-lax-translate-y="0 0, 200 -50" data-lax-opacity="0 0, 200 1" data-lax-delay="400">
                        <img src="work3.jpeg" alt="CropSync Work 3">
                        <div class="work-overlay">
                            <h3>Farm Optimization</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section id="sponsors" class="section"  data-aos="fade-up">
            <div class="container">
                <h2 class="section-title">Supported By</h2>
                <div class="sponsors">
                    <img src="logos/msme.png" alt="MSME Logo" class="sponsor-logo">
                    <img src="logos/mca.png" alt="MCA Logo" class="sponsor-logo">
                    <img src="logos/acic.png" alt="ACIC Logo" class="sponsor-logo">
                    <img src="logos/vgu-logo.png" alt="VGU Logo" class="sponsor-logo">
                    <img src="logos/vgu-tbi.png" alt="VGU TBI Logo" class="sponsor-logo">
                    <img src="logos/sidbi.png" alt="SIDBI Logo" class="sponsor-logo">
                </div>
            </div>
        </section>






     <section class="cta-section" data-aos="fade-up">
        <div class="cta-content">
            <h2>Ready to Start Your Agricultural Journey?</h2>
            <p>Join our community of future agricultural leaders and transform your career with hands-on experience.</p>
            <a href="internships.php" class="btn">Apply Now</a>
        </div>
    </section>
    </main>


<footer>


        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About CropSync</h3>
                    <p>CropSync is dedicated to revolutionizing agriculture through innovative technology and research.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#work">Our Work</a></li>
                        <li><a href="privacy.php">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Connect With Us</h3>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=61566437559561&mibextid=ZbWKwL"><i class="fab fa-facebook"></i></a>
                        <a href="https://x.com/CropSync365?t=huB6RVyHezmBQJZcyPTegg&s=09"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/company/cropsync/"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.instagram.com/cropsync_official/"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 CropSync. All rights reserved. | Made with ❤️ by CropSync Team</p>
            </div>
        </div>
        </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
// Initialize AOS with optimized settings
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 800,
        once: true,
        disable: window.innerWidth < 768,
        startEvent: 'DOMContentLoaded'
    });
});

// Optimized stats counter with IntersectionObserver and requestAnimationFrame
class Counter {
    constructor(element, target, duration = 2000) {
        this.element = element;
        this.target = target;
        this.duration = duration;
        this.current = 0;
        this.increment = target / (duration / 16); // For 60fps
        this.isAnimating = false;
    }

    animate() {
        if (!this.isAnimating) return;

        this.current += this.increment;
        
        if (this.current >= this.target) {
            this.element.textContent = Math.round(this.target);
            this.isAnimating = false;
            return;
        }

        this.element.textContent = Math.round(this.current);
        requestAnimationFrame(() => this.animate());
    }

    start() {
        if (this.isAnimating) return;
        this.isAnimating = true;
        this.animate();
    }
}

// Initialize counters with IntersectionObserver
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const element = entry.target;
            const counter = new Counter(
                element, 
                parseInt(element.dataset.count)
            );
            counter.start();
            statsObserver.unobserve(element);
        }
    });
}, {
    threshold: 0.5,
    rootMargin: '0px'
});

// Observe all stat numbers
document.querySelectorAll('.stat-number').forEach(stat => {
    statsObserver.observe(stat);
});



// Smooth scroll for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Lazy load images
const lazyLoadImages = () => {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img.lazy').forEach(img => {
        imageObserver.observe(img);
    });
};

// Performance optimization for scroll events
let scrollTimeout;
window.addEventListener('scroll', () => {
    if (scrollTimeout) {
        window.cancelAnimationFrame(scrollTimeout);
    }
    scrollTimeout = requestAnimationFrame(() => {
        // Handle scroll-based animations or updates here
    });
}, { passive: true });

// Initialize all features
document.addEventListener('DOMContentLoaded', () => {
    lazyLoadImages();
});

         const showBanner = true; // Set this to true or false

        // JavaScript to show the banner after 3 seconds if showBanner is true
        window.addEventListener('load', function() {
            if (showBanner) {
                setTimeout(function() {
                    const banner = document.getElementById('floatingBanner');
                    banner.style.display = 'block';
                }, 3000); // 3000ms = 3 seconds
            }
        });

        // Function to close the banner
        function closeBanner() {
            const banner = document.getElementById('floatingBanner');
            banner.style.display = 'none';
        }
    </script>
</body>
</html>