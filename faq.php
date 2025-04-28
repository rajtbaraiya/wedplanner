<?php
include 'db_connection.php';

// Get FAQs from database
$query = "SELECT * FROM faqs ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FRENTE Wedding - FAQ</title>
   <!--font awesome cdn link-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--aos cdn link-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!--swiperjs cdn link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

  
   <!--custome css link-->
   <link rel="stylesheet" href="style.css">
   <style>
        .faq {
            padding: 2rem 9%;
        }
        .faq .heading {
            text-align: center;
            padding-bottom: 2rem;
        }
        .faq .heading span {
            color: var(--main-color);
            font-size: 2rem;
        }
        .faq .heading h1 {
            font-size: 4rem;
            color: #222;
            padding-top: 1rem;
        }
        .accordion {
            margin-top: 2rem;
        }
        .accordion-item {
            background: #fff;
            border-radius: .5rem;
            margin-bottom: 1rem;
            box-shadow: var(--box-shadow);
        }
        .accordion-header {
            padding: 2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .accordion-header h3 {
            font-size: 1.7rem;
            color: #222;
        }
        .accordion-header i {
            font-size: 1.7rem;
            color: var(--main-color);
            transition: .2s linear;
        }
        .accordion-content {
            padding: 0 2rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .accordion-content.active {
            padding: 1rem 2rem;
            max-height: 500px;
        }
        .accordion-content p {
            font-size: 1.5rem;
            color: #666;
            padding: 1rem 0;
            line-height: 1.5;
        }
        .rotate {
            transform: rotate(180deg);
        }
    </style>
</head>
<body>
   <!--header section starts-->

   <header class="header">

<a data-aos="zoom-in-left" data-aos-delay="150" href="#" class="logo"><i class= "fas fa-user"></i>FRENTE<br></a>

<nav class="navbar">
    <a data-aos="zoom-in-left" data-aos-delay="300" href="index.php">Home</a>
    <a data-aos="zoom-in-left" data-aos-delay="450" href="about.php">About Us</a>
    <a data-aos="zoom-in-left" data-aos-delay="600" href="service.php">Services</a>
    <a data-aos="zoom-in-left" data-aos-delay="750" href="destination.php">Destinations</a>
    <a data-aos="zoom-in-left" data-aos-delay="900" href="index.php">Review</a>
    <a data-aos="zoom-in-left" data-aos-delay="1050" href="photo.php">Photos</a>
    <a data-aos="zoom-in-left" data-aos-delay="1200" href="booking.php">Book Slot</a>
    <a data-aos="zoom-in-left" data-aos-delay="1200" href="faq.php">FAQs</a>

    <a data-aos="zoom-in-left" data-aos-delay="1350" href="../logg/register.php">Login</a>
    <a data-aos="zoom-in-left" data-aos-delay="1500" href="../logg/home.php">Profile</a>

</nav>

<div class="icons">
    <div data-aos="zoom-in-left" data-aos-delay="1350" class="fas fa-moon" id="theme-btn"></div>
    <div data-aos="zoom-in-left" data-aos-delay="1500" class="fas fa-bars" id="menu"></div>
</div>



</header>

<!--header section ends-->
  <div class="container">
  
  <br><br><br><br><br><img src="./images/logo_wed.jpg" alt="FRENTE The Wed Planner" style="width: 300px; display: block; margin: 0 auto 40px;">
 
  <section class="faq">
        <div class="heading">
            <span></span>
            <h1>Frequently Asked Questions</h1>
        </div>

        <div class="accordion">
            <?php while($faq = mysqli_fetch_assoc($result)): ?>
            <div class="accordion-item">
                <div class="accordion-header">
                    <h3><?php echo htmlspecialchars($faq['question']); ?></h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p><?php echo nl2br(htmlspecialchars($faq['answer'])); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
  </div>
  <!--aos cdn link-->

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<!--swiperjs cdn link-->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!--custome js cdn link-->
<script src="script.js"></script>
<script>
        const accordionHeaders = document.querySelectorAll('.accordion-header');
        
        accordionHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                const icon = header.querySelector('i');
                
                // Close all other accordion items
                document.querySelectorAll('.accordion-content').forEach(item => {
                    if (item !== content) {
                        item.classList.remove('active');
                        item.previousElementSibling.querySelector('i').classList.remove('rotate');
                    }
                });
                
                // Toggle current accordion item
                content.classList.toggle('active');
                icon.classList.toggle('rotate');
            });
        });
    </script>
</body>
</html>