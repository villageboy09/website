<?php
session_start();
include 'header.php';


$user_courses = [
    "Greenhouses Course" => isset($_SESSION['course1_link']) ? $_SESSION['course1_link'] : null,
    "Course Title 2" => isset($_SESSION['course2_link']) ? $_SESSION['course2_link'] : null,
    // Add more courses if needed
];
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriculture Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

main {
    padding: 2rem;
}

.courses {
    display: flex;
    flex-direction: column;
    align-items: center;
}

h1 {
    text-align: center;
    margin-bottom: 2rem;
    color: #4CAF50;
    font-size: 2.5rem;
}

.course-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
    width: 100%;
    max-width: 1200px;
}

.course-card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transform: translateY(20px);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    opacity: 0;
    animation: fadeIn 0.5s forwards, slideUp 0.5s forwards;
}

.course-card:hover {
    transform: translateY(0);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.course-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-bottom: 3px solid #4CAF50;
}

.course-info {
    padding: 1.5rem;
}

.course-info h2 {
    font-size: 1.6rem;
    color: #4CAF50;
    margin-bottom: 0.5rem;
}

.course-info p {
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 1rem;
    color: #666;
}

.send-request-btn {
    display: block;
    width: 100%;
    padding: 0.75rem 1rem;
    background-color: #4CAF50;
    color: white;
    text-align: center;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
    cursor: pointer;
}

.send-request-btn:hover {
    background-color: #2d0869;
    transform: translateY(-2px);
}

.form-container {
    display: none;
    background-color: #f9f9f9;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-top: 1rem;
}

.form-container input,
.form-container select {
    width: 100%;
    padding: 0.75rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
}

.form-container button {
    width: 100%;
    padding: 0.75rem;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-container button:hover {
    background-color: #45a049;
}

footer {
    text-align: center;
    padding: 1rem;
    background-color: #4CAF50;
    color: white;
    font-size: 1rem;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
    }
    to {
        transform: translateY(0);
    }
}

    </style>
</head>
<body>

<main>
    <section class="courses">
        <h1>Agriculture Courses</h1>
        <div class="course-container" id="course-container"></div>
    </section>
</main>

<footer>
    <p>&copy; 2024 CropSync Pvt Ltd. All rights reserved.</p>
</footer>

<script>
    AOS.init(); // Initialize AOS

    const courses = [
        {
            title: "Crop Consultant/Agronomist",
            description: "Provides expert advice to farmers on crop management, pest control, and soil health to maximize agricultural productivity.",
            price: "Rs.499/-",
            outcome: "<br>1. Role and importance of crop consultants.<br>2. Overview of the agricultural industry and consulting opportunities.",
            image: "work1.jpg",
            link: "<?php echo isset($_SESSION['course1_link']) ? $_SESSION['course1_link'] : ''; ?>"
        },
        {
            title: "Supply Chain Manager in Agriculture",
            description: "Manages the flow of goods from farms to markets, ensuring efficient logistics and inventory control.",
            price: "Rs.699/-",
            outcome: "<br>1. Overview of supply chain concepts and key components.<br>2. The role and importance of supply chain managers.<br>3. Understanding the end-to-end supply chain process.",
            image: "work1.jpg",
            link: "<?php echo isset($_SESSION['course2_link']) ? $_SESSION['course2_link'] : ''; ?>"
        }
        
        // Add more courses as needed
    ];

    const courseContainer = document.getElementById("course-container");

    courses.forEach((course, index) => {
        const card = document.createElement("div");
        card.className = "course-card";
        card.setAttribute('data-aos', 'fade-up');
        card.innerHTML = `
            <img src="${course.image}" alt="${course.title} Image">
            <div class="course-info">
<h2><strong>${course.title}</strong></h2>
<p><strong>Description:</strong> ${course.description}</p>
<p><strong>Price:</strong> ${course.price}</p>
<p><strong>Outcome:</strong> ${course.outcome}</p>
                ${course.link ? 
                    `<a href="${course.link}" class="btn btn-primary btn-block">Access Course</a>` : 
                    `<button class="send-request-btn" onclick="toggleForm(${index})">Send Request</button>
                     <div class="form-container" id="form-${index}">
                         <form action="submit_request.php" method="POST">
                             <input type="text" name="name" placeholder="Your Name" required>
                             <input type="email" name="email" placeholder="Your Email" required>
                             <input type="text" name="mobile" placeholder="Mobile Number" required>
                             <select name="course" required>
                                 <option value="${course.title}">${course.title}</option>
                             </select>
                             <button type="submit">Submit</button>
                         </form>
                     </div>`}
            </div>
        `;
        courseContainer.appendChild(card);
    });

    function toggleForm(index) {
        const formContainers = document.querySelectorAll('.form-container');

        formContainers.forEach((formContainer, i) => {
            formContainer.style.display = "none"; // Close other forms
        });

        const currentFormContainer = document.getElementById(`form-${index}`);
        currentFormContainer.style.display = currentFormContainer.style.display === "none" || currentFormContainer.style.display === "" ? "block" : "none";
    }

    document.querySelectorAll('.form-container form').forEach((form, index) => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            const formData = new FormData(form);
            
            fetch('submit_request.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Create a div element for the success message
                const successMessage = document.createElement('div');
                successMessage.classList.add('alert', 'alert-success', 'mt-3'); // Add margin-top class
                successMessage.textContent = data; // Display the success message text
                
                // Insert the success message after the form
                form.insertAdjacentElement('afterend', successMessage);
                
                form.reset(); // Reset the form
                
                // Close the form after submission
                toggleForm(index); // Assuming toggleForm function is defined elsewhere
                
                // Remove the success message after a delay (optional)
                setTimeout(() => {
                    successMessage.remove();
                }, 3000); // Remove after 3 seconds (3000 milliseconds)
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>


</body>
</html>
