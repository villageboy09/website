<?php
session_start();
include 'header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CropSync Internships</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
:root {
    --primary-color: #4CAF50;
    --secondary-color: #45a049;
    --text-color: #333;
    --bg-color: #f8f9fa;
    --white: #ffffff;
    --gray-100: #f8f9fa;
    --gray-200: #e9ecef;
    --gray-300: #dee2e6;
    --gray-600: #6c757d;
    --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
    --transition: all 0.3s ease;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--bg-color);
    color: var(--text-color);
    line-height: 1.6;
    overflow-x: hidden;
}


/* Header Styles */
h2.chip {
    display: inline-block;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    padding: 0.75rem 2.5rem;
    border-radius: 50px;
    font-size: 1.75rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-md);
    position: relative;
    overflow: hidden;
}

h2.chip::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    animation: shine 3s infinite;
}

@keyframes shine {
    to {
        left: 100%;
    }
}

/* Common container styles */
.container {
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
  padding: 0 1rem;
}

/* Internship Cards */
#internshipList {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin-top: 2rem;
}

.internship-card {
  background-color: var(--white);
  border-radius: 15px;
  box-shadow: var(--shadow-md);
  overflow: hidden;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: var(--transition);
}



 .card-image {
            position: relative;
            padding-top: 60%;
            overflow: hidden;
        }

        .card-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

.internship-content {
  padding: 1.75rem;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.internship-content h3 {
  font-size: 1.4rem;
  color: var(--primary-color);
  margin-bottom: 0.5rem;
}

.internship-content p {
  color: var(--gray-600);
  font-size: 0.95rem;
  margin-bottom: 0.5rem;
}

.internship-content strong {
  color: var(--text-color);
}

.apply-now {
  display: inline-block;
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  color: var(--white);
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  text-decoration: none;
  transition: var(--transition);
  margin-top: auto;
  text-align: center;
  border: none;
  cursor: pointer;
  font-size: 0.95rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.apply-now:hover {
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
  box-shadow: var(--shadow-md);
}

/* Certificate Verification Section */
  .verification-section {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 3rem;
            margin-bottom: 4rem;
            box-shadow: var(--shadow-lg);
            border-radius: 15px;
        }

        .verification-title {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .certificate-preview {
            max-width: 600px;
            margin: 0 auto 2rem;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .certificate-preview img {
            width: 100%;
            height: auto;
            display: block;
        }

        .verification-form {
            max-width: 500px;
            margin: 0 auto;
        }

        .input-group {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .verification-input {
            flex: 1;
            padding: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: var(--radius-sm);
            font-size: 1rem;
            transition: var(--transition);
        }

        .verification-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .verify-btn {
            padding: 1rem 2rem;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            border-radius: 10px;
        }

        .verify-btn:hover {
            background: var(--secondary-color);
        }

#result {
  text-align: center;
  margin-top: 1.5rem;
  min-height: 50px;
}

.success-message {
  color: var(--primary-color);
  font-weight: 500;
  padding: 1rem;
  background-color: rgba(76, 175, 80, 0.1);
  border-radius: 8px;
}

.error-message {
  color: #dc3545;
  font-weight: 500;
  padding: 1rem;
  background-color: rgba(220, 53, 69, 0.1);
  border-radius: 8px;
}

/* Footer Styles */
footer {
    background: linear-gradient(to bottom, #1a1a1a, #2d2d2d);
    color: var(--white);
    padding: 5rem 0 2rem;
    margin-top: 4rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 3rem;
    margin-bottom: 3rem;
}

.footer-section h3 {
    color: var(--primary-color);
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
}

.footer-section h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -8px;
    width: 40px;
    height: 3px;
    background: var(--primary-color);
    border-radius: 2px;
}

.footer-section p {
    color: var(--gray-300);
    line-height: 1.8;
}

.footer-section ul {
    list-style: none;
}

.footer-section ul li {
    margin-bottom: 0.75rem;
}

.footer-section ul li a {
    color: var(--gray-300);
    text-decoration: none;
    transition: var(--transition);
    display: inline-block;
}

.footer-section ul li a:hover {
    color: var(--primary-color);
    transform: translateX(5px);
}

.social-icons {
    display: flex;
    gap: 1rem;
}

.social-icons a {
    color: var(--white);
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

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-bottom p {
    color: var(--gray-300);
    font-size: 0.9rem;
}
@media (min-width: 768px) and (max-width: 1024px) {
    .container {
        width: 95%;
        margin-bottom: 2rem;
    }

    #internshipList {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .internship-card {
        max-width: 100%;
    }

    .verification-section {
        padding: 2rem 1.5rem;
        margin-top: 2rem;
    }

    .verification-form {
        max-width: 400px;
        margin: 0 auto;
    }

    .certificate-preview {
        max-width: 500px;
        margin: 0 auto 1.5rem;
    }

    .input-group {
        flex-direction: column;
    }

    .input-group input,
    .input-group button {
        width: 100%;
        margin-bottom: 1rem;
    }
}



@media (max-width: 480px) {
    .container {
        width: 92%;
        padding: 1rem 0;
    }
    
    h2.chip {
        font-size: 1.25rem;
        padding: 0.5rem 1.5rem;
    }
    
    .internship-content {
        padding: 1.25rem;
    }
    
    .internship-content h3 {
        font-size: 1.2rem;
    }
    
    .input-container {
        flex-direction: column;
    }
    
    .input-container button {
        width: 100%;
    }
    
    #neonTyper {
        font-size: 1.5rem;
    }
}
    </style>
</head>
<body>
<div class="container">
    <h2 class="chip">Internships</h2>
    <div id="internshipList">
        <!-- Internship cards will go here -->
    </div>
</div>
<br>
<br>

<div class="container">
    <section class="verification-section">
        <h2 class="verification-title">Verify Your Certificate</h2>
        <div class="certificate-preview">
            <img src="certificate.jpg" alt="Certificate Preview">
        </div>
        <div class="verification-form">
            <div class="input-group">
                <input type="text" id="uniqueCode" class="verification-input" placeholder="Enter Certificate ID">
                <button onclick="verifyUniqueCode()" class="verify-btn">Verify</button>
            </div>
            <div id="result"></div>
        </div>
    </section>
</div>


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
                        <li><a href="index.php">Services</a></li>
                        <li><a href="index.php">Our Work</a></li>
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
    <!-- Script for displaying internships -->
    <script>
        const internships = [
            {
                title: "Internship",
                company: "CropSync",
                image: "Interns.png",
                location: "Onsite",
                duration: "2 month",
                responsibilities: "Proficiency in Data Collection and Analysis<br>Strong Attention to Detail<br>Willingness to Work in Field Conditions",
                requirements: "Familiarity with MS Office, Report Writing.",
                applyLink: "apply.php",
            },
            
        ];

        // Function to display internships
        function displayInternships() {
            const internshipList = document.getElementById('internshipList');
            internships.forEach(internship => {
                const internshipCard = document.createElement('div');
                internshipCard.classList.add('internship-card');
                internshipCard.innerHTML = `
                    <div class="card"  >
                        <img class="card-img" src="${internship.image}" alt="Internship Image">
                    </div>
                    <div class="internship-content">
                        <h3>${internship.title}</h3><br>
                        <p><strong>Company:</strong> ${internship.company}</p>
                        <p><strong>Location:</strong> ${internship.location}</p>
                        <p><strong>Duration:</strong> ${internship.duration}</p>
                        <p><strong>Responsibilities:</strong> ${internship.responsibilities}</p>
                        <p><strong>Requirements:</strong> ${internship.requirements}</p>
                        <button onclick="window.location.href='${internship.applyLink}'" class="apply-now">Apply Now</button>

                    </div>
                `;
                internshipList.appendChild(internshipCard);
            });
        }

        // Display internships when page loads
        window.addEventListener('load', displayInternships);
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const text = "Verify Certificate";
        let index = 0;
        const speed = 100; // typing speed in milliseconds
    
        function typeWriter() {
            if (index < text.length) {
                document.getElementById("neonTyper").innerHTML += text.charAt(index);
                index++;
                setTimeout(typeWriter, speed);
            }
        }
    
        // Clear the text initially and start the typing effect
        document.getElementById("neonTyper").innerHTML = "";
        typeWriter();
    });
    
    </script>

    <script type="module">
        // Import Firebase functions
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js";
        import { getFirestore, collection, getDocs } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-firestore.js";

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyDAEm51DB5Cu0DRmswi0Q1MQPztu-dRCl4",
            authDomain: "cropsync-web.firebaseapp.com",
            projectId: "cropsync-web",
            storageBucket: "cropsync-web",
            messagingSenderId: "74605478928",
            appId: "1:74605478928:web:eaa6773cf7ae2d5ec7f695",
            measurementId: "G-RS130D4LHV"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);

        // Define the verifyUniqueCode function globally
       // Function to verify the unique code
window.verifyUniqueCode = async function() {
    const enteredCode = document.getElementById("uniqueCode").value;
    const resultDiv = document.getElementById("result");
    let verificationSuccess = false;

    const querySnapshot = await getDocs(collection(db, "certificate_database"));
    querySnapshot.forEach((doc) => {
        const data = doc.data();
        if (data.unique_id === enteredCode) {
            resultDiv.innerHTML = `<p class="success-message">Verification successful: ${data.name} has successfully completed internship on ${data.course}.</p>`;
            verificationSuccess = true;
        }
    });

    if (!verificationSuccess) {
        resultDiv.innerHTML = `<p class="error-message">Verification failed: Certificate ID does not match any document</p>`;
    }

    // Refresh the form after 5 seconds
    setTimeout(() => {
        document.getElementById("uniqueCode").value = "";
        resultDiv.innerHTML = "";
    }, 5000);
};

// Event listener to clear the result when the user starts typing a new ID
document.getElementById("uniqueCode").addEventListener("input", function() {
    const resultDiv = document.getElementById("result");
    resultDiv.innerHTML = "";
});

                // Add event listener after DOM content is loaded
                document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.forEach(nav => nav.classList.remove('active'));
                    link.classList.add('active');
                });
            });
                        // Initialize SmoothScroll
                        new SmoothScroll('a[href*="#"]', {
                speed: 300
            });
        });



    </script>


  <script>
    AOS.init();
</script>

</body>
</html>
