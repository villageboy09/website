<?php
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-F9ED2DFZEV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-F9ED2DFZEV');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Internship</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .apply-container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .chip {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 25px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
        }
        .btn-primary {
            border-radius: 10px;
            padding: 10px 20px;
            font-family: 'Poppins', sans-serif;
        }
        .alert-container {
            margin-top: 20px;
            
        }
        label {
            font-weight: 500;
            
        }
        .content {
            flex: 1;
            
        }
        .footer {
            position: relative;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 1rem 0;
            text-align: center;
            color: #6c757d;
        }
         .closed-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }
        /* Add new CSS here if needed */
    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="apply-container">
                    <div class="apply-header">
                        <h1 class="apply-title">Apply for Internship</h1>
                        <p class="text-muted">Join our team and grow your skills!</p>
                    </div>
                    
                    <div id="formContainer">
                        <form id="applyForm" class="apply-form" action="submit_form.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contact" name="contact" required>
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">Your State</label>
                                <input type="text" class="form-control" id="state" name="state" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Internship Role</label>
                                <select class="form-select" id="role" name="role" required onchange="showRoleSpecificFields()">
                                    <option value="">Select a role</option>
                                    <option value="field_officer">Field Officer</option>
                                    <option value="content_creator">Content Creator</option>
                                    <option value="finance_analyst">Finance Analyst</option>
                                </select>
                            </div>
                            
                            <!-- Role-specific questions -->
                            <div id="fieldOfficerQuestions" style="display: none;">
                                <div class="mb-3">
                                    <label for="field_challenge" class="form-label">Describe a challenging field situation you resolved</label>
                                    <textarea class="form-control" id="field_challenge" name="field_challenge" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="community_engagement" class="form-label">How would you build trust with local communities?</label>
                                    <textarea class="form-control" id="community_engagement" name="community_engagement" rows="3"></textarea>
                                </div>
                            </div>
                            
                            <div id="contentCreatorQuestions" style="display: none;">
                                <div class="mb-3">
                                    <label for="content_creation" class="form-label">How do you align content with brand voice?</label>
                                    <textarea class="form-control" id="content_creation" name="content_creation" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="instagram_profile" class="form-label">Instagram Profile URL</label>
                                    <input type="url" class="form-control" id="instagram_profile" name="instagram_profile">
                                </div>
                            </div>
                            
                            <div id="financeAnalystQuestions" style="display: none;">
                                <div class="mb-3">
                                    <label for="financial_analysis" class="form-label">How would you evaluate a startup's financial health?</label>
                                    <textarea class="form-control" id="financial_analysis" name="financial_analysis" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="accuracy_reporting" class="form-label">Describe how you handled a financial data error</label>
                                    <textarea class="form-control" id="accuracy_reporting" name="accuracy_reporting" rows="3"></textarea>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="ai_tools" class="form-label">AI tools you use in your domain</label>
                                <textarea class="form-control" id="ai_tools" name="ai_tools" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="resume" class="form-label">Upload Resume</label>
                                <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                            </div>
                            <div class="text-center mt-4">
                                <button type="button" class="btn btn-primary btn-lg" onclick="submitForm()">Submit Application</button>
                            </div>
                        </form>
                    </div>
                    
                    <div id="closedMessage" class="closed-message" style="display: none;">
                        <i class="fas fa-exclamation-circle fa-3x mb-3"></i>
                        <h3>Internship Applications Closed</h3>
                        <p>We're no longer accepting applications for this role. Only Students Pursuing MSc Agronomy can send their resumes to our email id. Stay tuned for more exciting opportunities!</p>
                    </div>
                    
                    <div id="alertBox" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto">
        <div class="container">
            <span>© 2024 CropSync. All rights reserved.</span>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.0/dist/confetti.browser.min.js"></script> <!-- Add this for confetti -->

    <script>
        function showRoleSpecificFields() {
            const role = document.getElementById('role').value;
            document.getElementById('fieldOfficerQuestions').style.display = 'none';
            document.getElementById('contentCreatorQuestions').style.display = 'none';
            document.getElementById('financeAnalystQuestions').style.display = 'none';
            
            if (role === 'field_officer') {
                document.getElementById('fieldOfficerQuestions').style.display = 'block';
            } else if (role === 'content_creator') {
                document.getElementById('contentCreatorQuestions').style.display = 'block';
            } else if (role === 'finance_analyst') {
                document.getElementById('financeAnalystQuestions').style.display = 'block';
            }
        }

        function checkInternshipStatus() {
            const closingDate = new Date('2024-09-15');
            const currentDate = new Date();
            updateFormVisibility(currentDate > closingDate);
        }

        function updateFormVisibility(isInternshipClosed) {
            const formContainer = document.getElementById('formContainer');
            const closedMessage = document.getElementById('closedMessage');
            
            if (isInternshipClosed) {
                formContainer.style.display = 'none';
                closedMessage.style.display = 'block';
            } else {
                formContainer.style.display = 'block';
                closedMessage.style.display = 'none';
            }
        }

        function submitForm() {
            const form = document.getElementById('applyForm');
            const formData = new FormData(form);

            fetch('submit_form.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const alertBox = document.getElementById('alertBox');
                if (data.status === 'success') {
                    alertBox.innerHTML = `
                        <div class="alert alert-success" role="alert">
                            Application submitted successfully!
                        </div>
                    `;
                    confetti({
                        particleCount: 100,
                        spread: 70,
                        origin: { y: 0.6 }
                    });
                    setTimeout(() => {
                        window.location.href = 'apply.php';
                    }, 2000);
                } else {
                    alertBox.innerHTML = `
                        <div class="alert alert-danger" role="alert">
                            Failed to submit the application. Please try again.
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('alertBox').innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        An error occurred. Please try again later.
                    </div>
                `;
            });
        }

        document.addEventListener("DOMContentLoaded", checkInternshipStatus);
    </script>

</body>
</html>
