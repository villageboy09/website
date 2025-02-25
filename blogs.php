<?php
session_start();
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CropSync Blog</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
            --text-color: #333;
            --background-color: #f4f4f4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
    height: 100%;
}

body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.container {
    flex-grow: 1;
}


        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1rem;
        }

        h1 {
            margin-bottom: 0.5rem;
        }

        .blog-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .blog-card {
            background: var(--card-bg);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        .blog-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .blog-content {
            padding: 1.5rem;
        }

        .blog-tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background-color: var(--primary);
            color: white;
            border-radius: 1rem;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .blog-title {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: var(--text);
            font-weight: 600;
        }

        .blog-excerpt {
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-light);
            font-size: 0.875rem;
        }
        .read-more {
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .read-more:hover {
            background-color: var(--secondary-color);
        }

              footer {
            text-align: center;
            margin-top: 2rem;
            padding: 1rem;
            background-color:green;
            color: white;
        }

       @media (max-width: 768px) {
    .blog-container {
        grid-template-columns: 1fr;
    }
    
    .blog-card {
        background: #ffffff; /* Change this color as needed */
        border-radius: 0.5rem;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <div class="blog-container" id="blogList">
            <!-- Blogs will be dynamically added here -->
        </div>
    </div>

    <footer>
        <p>Made with <i class="fas fa-heart"></i> by CropSync</p>
    </footer>

    <script>
        const blogs = [
            {
                title: "Mustard Cultivation in Dry land areas",
                author: "R Dhanunjay Reddy",
                image: "blog 1.jpg",
                content: "A high yielding medium maturing Hybrid with bold grain and better oil percentage.",
                date: "October 10, 2023",
            },
            {
                title: "Wheat trails for optimum water use efficiency",
                author: "B Chandu",
                image: "wheat.jpeg",
                content: "They have more pods, thick grains, shiny and shade colour grains.",
                date: "October 15, 2023",
            },
            {
                title: "Cucumber Cultivation in Poly house",
                author: "Uday Kiran Vanapalli",
                image: "cucumber.jpeg",
                content: "Fruits are light green in colour with delicious, crispy, juicy and sweet flesh.",
                date: "March 20, 2022",
            }
        ];

        function displayBlogs() {
            const blogList = document.getElementById('blogList');
            blogs.forEach((blog) => {
                const blogCard = document.createElement('div');
                blogCard.classList.add('blog-card');
                blogCard.innerHTML = `
                    <img src="${blog.image}" alt="${blog.title}" class="blog-image">
                    <div class="blog-content">
                        <h2 class="blog-title">${blog.title}</h2>
                        <p class="blog-meta">By ${blog.author} | ${blog.date}</p>
                        <p class="blog-excerpt">${blog.content}</p>
                        <a href="#" class="read-more">Read more</a>
                    </div>
                `;
                blogList.appendChild(blogCard);
            });
        }

        window.addEventListener('load', displayBlogs);
    </script>
</body>
</html>