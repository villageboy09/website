// Smooth Scroll Initialization
var scroll = new SmoothScroll('a[href*="#"]', {
  speed: 800,
  speedAsDuration: true
});


 document.getElementById('CropSyncLink').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        // Navigate to index.html
        window.location.href = "index.html";
    });

document.addEventListener('DOMContentLoaded', function() {
  // Show the floating banner after 2 seconds
  setTimeout(function() {
    document.getElementById('floating-banner').style.display = 'block';
  }, 2000);

  // Close button functionality
  document.getElementById('close-button').addEventListener('click', function() {
    document.getElementById('floating-banner').style.display = 'none';
  });

  // Apply Now button functionality
  document.getElementById('apply-button').addEventListener('click', function() {
    window.location.href = 'internships.html'; // Change this to the desired page URL
  });
});

// Get all nav links
const navLinks = document.querySelectorAll('.nav-link');

// Loop through the links
navLinks.forEach(link => {
  // Add click event listener to each link
  link.addEventListener('click', () => {
    // Remove 'active' class from all links
    navLinks.forEach(navLink => navLink.classList.remove('active'));
    // Add 'active' class to the clicked link
    link.classList.add('active');
  });
});
