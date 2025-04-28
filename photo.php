<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wed Planner-Photo Gallery</title>

        <!--font awesome cdn link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

         <!--aos cdn link-->
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
     <!--swiperjs cdn link-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
 
    <link rel="stylesheet" href="photo.css">
</head>
<body>


     <!--header section starts-->

     <header class="header">

        <a data-aos="zoom-in-left" data-aos-delay="150" href="#" class="logo"><i class= "fas fa-user"></i>FRENTE</a>

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


    <!--galler section starts-->

    <section class="photo" id="photo"><div>.<br><br><br></div>

        <h1 class="heading"  style="font-family:gabriola; font-size:5rem">Our Gallery</h1>

        <div class="swiper gallery-slider" data-aos="fade-up">

            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="images/haldi1.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/haldi2.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/haldi3.jpeg" />
                </div>
                
                <div class="swiper-slide">
                    <img src="images/haldi4.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/haldi5.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/mehndi1.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/mehndi2.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/mehndi3.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/wed1.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/wed2.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/wed3.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/wed10.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/wed4.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/wed5.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/wed6.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/wed7.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/wed8.jpeg" />
                </div>

                <div class="swiper-slide">
                    <img src="images/wed9.jpeg" />
                </div>
             </div>

        </div>

    </section>

  <!--gallery section ends-->



    <section class="gallery" id="gallery">
       
        <h1 class="heading"  style="font-family:gabriola; font-size:5rem">Our<span  style="font-family:gabriola; font-size:5rem"> PHOTOS</span></h1>
        <div class="box-container">
            <?php
            include 'db_connection.php';
            $query = "SELECT * FROM gallery ORDER BY created_at DESC";
            $result = mysqli_query($conn, $query);
            
            while($photo = mysqli_fetch_assoc($result)) {
                echo '<div class="box">';
                echo '<img src="' . htmlspecialchars($photo['image_path']) . '" alt="">';
                echo '<h3 class="title">' . htmlspecialchars($photo['title']) . '</h3>';
                echo '<div class="icons">';
                echo '<a href="#" class="fas fa-heart"></a>';
                echo '<a href="#" class="fas fa-share"></a>';
                echo '<a href="#" class="fas fa-eye"></a>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>


      <!--aos cdn link-->

      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

      <!--swiperjs cdn link-->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
 
     <!--custome js cdn link-->
    <script src="script.js"></script>
</body>
</html>