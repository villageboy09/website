<?php
session_start();
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact CropSync - Your Agricultural Innovation Partner</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
            --accent-color: #FFD700;
            --text-color: #333;
            --bg-color: #f4f4f4;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--bg-color);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        header {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 2rem 0;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .contact-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-top: 2rem;
        }

        .contact-form, .contact-info {
            flex: 1;
            min-width: 300px;
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        input, textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
            font-weight: bold;
        }

        button:hover {
            background-color: var(--secondary-color);
        }

        .error {
            color: #ff0000;
            font-size: 0.8rem;
        }

        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 1rem;
            border-radius: 5px;
            margin-top: 1rem;
            display: none;
        }

        .contact-details p {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .contact-details i {
            margin-right: 1rem;
            color: var(--primary-color);
        }

        .social-links {
            margin-top: 2rem;
        }

        .social-links a {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-right: 1rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: var(--secondary-color);
        }

        .map-container {
            margin-top: 2rem;
        }

        .map-container iframe {
            width: 100%;
            height: 300px;
            border: none;
            border-radius: 10px;
        }

        .feature-section {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .features {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .feature {
            text-align: center;
            flex: 1;
            min-width: 200px;
        }

        .feature i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        footer {
            text-align: center;
            margin-top: 2rem;
            padding: 1rem;
            background-color: var(--primary-color);
            color: white;
        }

        @media (max-width: 768px) {
            .contact-wrapper {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Connect with CropSync</h1>
            <p>We're here to revolutionize your farming experience</p>
        </div>
    </header>

    <div class="container">
        <div class="contact-wrapper">
            <div class="contact-form">
                <h2>Send Us a Message</h2>
                <form id="contactForm">
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                    <span class="error" id="nameError"></span>

                    <input type="tel" id="number" name="number" placeholder="Your Phone Number" required>
                    <span class="error" id="numberError"></span>

                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                    <span class="error" id="emailError"></span>

                    <textarea id="message" name="message" placeholder="How can we help you?" rows="4" required></textarea>
                    <span class="error" id="messageError"></span>

                    <button type="submit">Send Message</button>
                </form>
                <div id="successMessage" class="success-message">
                    Thank you! Your message has been sent successfully. We'll get back to you soon.
                </div>
            </div>
            <div class="contact-info">
                <h2>Get in Touch</h2>
                <p>Have questions about CropSync? We're here to help!</p>
                <div class="contact-details">
                    <p><i class="fas fa-map-marker-alt"></i> Gandi Maisamma X Rd, Hyderabad, Telangana 500043</p>
                    <p><i class="fas fa-phone"></i> +91 9154657888</p>
                    <p><i class="fas fa-envelope"></i> career.cropsync@gmail.com</p>
                    <p><i class="fas fa-clock"></i> Monday - Friday: 9am - 5pm IST</p>
                </div>
                <div class="social-links">
                    <h3>Connect With Us</h3>
                    <a href="https://www.instagram.com/CropSync_official" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/cropsync/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://x.com/CropSync365?t=6eV4aM_xeF4EQcxISXE2WA&s=09" target="_blank"><i class="fab fa-x"></i></a>
                    <a href="https://www.youtube.com/@CropSync" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="feature-section">
            <h2>Why Choose CropSync?</h2>
            <div class="features">
                <div class="feature">
                    <i class="fas fa-leaf"></i>
                    <h3>Sustainable Farming</h3>
                    <p>Optimize resource use and reduce environmental impact</p>
                </div>
                <div class="feature">
                    <i class="fas fa-chart-line"></i>
                    <h3>Increased Yields</h3>
                    <p>Boost your crop production with data-driven insights</p>
                </div>
                <div class="feature">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Easy to Use</h3>
                    <p>Access CropSync anytime, anywhere from your mobile device</p>
                </div>
            </div>
        </div>

        <div class="map-container">
            <h2>Visit Our Office</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3803.697911313416!2d78.42252137414567!3d17.569563597533485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb8efb7d234277%3A0xf098d4f5bb3a51c9!2sGandi%20Maisamma%20X%20Rd%2C%20Gandi%20Maisamma%2C%20Hyderabad%2C%20Telangana%20500043!5e0!3m2!1sen!2sin!4v1721053122008!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 CropSync. Empowering farmers with innovative technology.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            const successMessage = document.getElementById('successMessage');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateForm()) {
                    // Here you would typically send the form data to your backend
                    console.log('Form submitted successfully');
                    form.reset();
                    successMessage.style.display = 'block';
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 5000);
                }
            });

            function validateForm() {
                let isValid = true;
                
                // Name validation
                const name = document.getElementById('name');
                const nameError = document.getElementById('nameError');
                if (name.value.trim() === '') {
                    nameError.textContent = 'Name is required';
                    isValid = false;
                } else {
                    nameError.textContent = '';
                }

                // Number validation
                const number = document.getElementById('number');
                const numberError = document.getElementById('numberError');
                if (!/^\d{10}$/.test(number.value)) {
                    numberError.textContent = 'Please enter a valid 10-digit number';
                    isValid = false;
                } else {
                    numberError.textContent = '';
                }

                // Email validation
                const email = document.getElementById('email');
                const emailError = document.getElementById('emailError');
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                    emailError.textContent = 'Please enter a valid email address';
                    isValid = false;
                } else {
                    emailError.textContent = '';
                }

                // Message validation
                const message = document.getElementById('message');
                const messageError = document.getElementById('messageError');
                if (message.value.trim() === '') {
                    messageError.textContent = 'Message is required';
                    isValid = false;
                } else {
                    messageError.textContent = '';
                }

                return isValid;
            }

            // Clear error messages on input
            const inputs = form.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    const errorElement = document.getElementById(this.name + 'Error');
                    if (errorElement) {
                        errorElement.textContent = '';
                    }
                });
            });
        });
    </script>
</body>
</html>