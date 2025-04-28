<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../logg/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wed planner-Book Slot</title>

    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--aos cdn link-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!--swiperjs cdn link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>


    <style>




        /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    
    line-height: 1.6;
    background-color: #f4f1f1;
    background: url(images/bg2-booking.jpeg);
    color: #333;
}

a {
    text-decoration: none;
}

ul {
    list-style: none;
}

/* Header Section */
header {
   background-color: rgb(247, 244, 244);
   /* background: url(images/booking_back.jpeg)no-repeat;*/
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

header .logo h1 {
    font-size: 28px;
    color: #e2a2d7;
}

/* Hero Section */
.hero {
    text-align: center;
    background: url(images/bg2-booking.jpeg);

    /*background-color : var(--white);
    color: var(--light-black);*/

    padding: 50px 20px;
}

.hero h2 {
    font-family: cursive;
    font-size: 36px;
    margin-bottom: 10px;
}

.hero p {
    font-size: 20px;
    margin-bottom: 20px;
}

/* Booking Form Section */
.booking {
    padding: 40px 20px;
    background: url(images/booking_back.jpeg);
    color: white;
    max-width: 800px;
    margin: 0 auto;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.booking h3 {
    text-align: center;
    font-size: 28px;
    margin-bottom: 20px;
}

.booking form {
    display: flex;
    flex-direction: column;
   /* background: url(images/booking_back.jpeg)no-repeat;*/
    gap: 20px;
}

.booking label {
    font-size: 18px;
}

.booking input, .booking select, .booking textarea {
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.booking button {
    padding: 12px 20px;
    background-color: White;
    color: rgb(67, 66, 66);
    font-size: 18px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.booking button:hover {
    background-color: #d57bb6;
}

/* Contact Information Section */
.contact {
    text-align: center;
    padding: 40px 20px;
   /* background-color: #f9f9f9;
   background: url(images/booking_bg.jpeg)no-repeat;*/
}

.contact h3 {
    font-size: 24px;
    margin-bottom: 10px;
}

.contact p {
    font-size: 18px;
}

/* Footer Section */
footer {
    background-color: #fff;
    padding: 20px;
    text-align: center;
    margin-top: 40px;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
}

footer p {
    font-size: 16px;
    color: #777;
}



    /* style.css vali css navigation mate*/


    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap");

:root{
    --main-color:#f45866;
    /*--main-color:#c1378e;*/
    --primary-color:#404068;
    --white:#fff;
    --bg:#f7f0ed;
    --light-black:#333;
    --box-shadow: 0 .5rem 1rem rgba(0,0,0,1);
}

*{
    font-family: 'Times New Roman';/*'Poppins', sans-serif;*/
    margin: 0; padding: 0;
    box-sizing: border-box;
    outline: none; border: none;
    text-decoration: none;
    transition: .2s linear;
    text-transform: capitalize;

}

html{
    font-size: 62.5%;
    overflow-x: hidden;
    scroll-behavior: smooth;
    scroll-padding-top: 6rem;
}

html::-webkit-scrollbar{
    width: .8rem;

}

html::-webkit-scrollbar-track{
    background: var(--white);
}

html::-webkit-scrollbar-thumb{
    background: var(--primary-color);
    border-radius: 5rem;
}


body.active{
    --primary-color: #fff;
    --light-black: #eee;
    --white: #333;
    --bg: #222;
    --box-shadow: 0.5rem 1.5rem rgba(0,0,0,.4);
}

section{
    padding: 3rem 9%;
}

.heading{
    text-align: center;
    color: var(--primary-color);
    text-transform: uppercase;
    margin-bottom: 4rem;
    font-size: 4rem;
    margin-top: 2rem;
}

input[type="submit"] {
    display: inline-block;
    margin-top: 1rem;
    padding: 0.8rem 2.8rem;
    border-radius: 5rem;
    border-top-left-radius: 0;
    border: 0.2rem solid var(--main-color);
    cursor: pointer;
    color: var(--main-color);
    font-size: 1.7rem;
    position: relative;
    overflow: hidden;
    background: transparent;
    transition: all 0.2s linear;
    appearance: none; /* Removes default browser styling */
    font-family: inherit; /* Ensures consistent typography */
}

input[type="submit"] {
    background: linear-gradient(
        to right,
        var(--main-color) 50%,
        transparent 50%
    );
    background-size: 200% 100%;
    background-position: right bottom;
}

input[type="submit"]:hover {
    background-position: left bottom;
    color: var(--white);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Optional: Add focus state for accessibility */
input[type="submit"]:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(var(--main-color-rgb), 0.3);
}


/* header */

.header{
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem 9%;
    background: var(--white);
    box-shadow: var(--box-shadow);
}

.header .logo{
    font-size: 2.2rem;
    font-weight: bolder;
    color: var(--primary-color);
}

.header .logo i{
    color: var(--main-color);
    padding-right: .5rem;
}

.header .navbar a{
    font-size: 1.7rem;
    margin-left: 2rem;
    color: var(--primary-color);
    padding-block: 1.6rem;
    position: relative;
}

.header .navbar a:hover{
    color: var(--main-color);
}

.header .navbar a::before{
    content: '';
    position: absolute;
    height: .3rem;
    border-block: .1rem solid var(--main-color);
    bottom: .5rem;
    width: 100%;
    transform: scaleX(0);
    transform-origin: center;
    transition: .5s ease;
}

.header .navbar a:is(:hover, :focus)::before{
    transform: scaleX(1);
}

.header .icons div{
    height: 4.5rem;
    width: 4.5rem;
    line-height: 4.5rem;
    font-size: 2rem;
    border-radius: .5rem;
    margin-left: .5rem;
    cursor: pointer;
    color: var(--primary-color);
    background: var(--main-color);
    text-align: center;
}

.header .icons div:hover{
    color: var(--main-color);
    background: var(--primary-color);
}

#menu{
    display: none;
}

/* media query */

@media(max-width: 991px){
    html{
        font-size: 55%;
    }

    .header{
        padding: 2rem, 5rem;
    }

    section{
        padding: 3rem;
    }
}


@media(max-width: 768px){
    #menu{
        display: inline-block;
    }

    .header .navbar{
        position: absolute;
        top: 99%; left: 0; right: 0;
        background: var(--bg);
        clip-path: polygon(0 0, 100% 0, 0 0);
    }

    .header .navbar.active{
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
    }

    .header .navbar a{
        display: flex;
        justify-content: center;
        background: var(--white);
        border-radius: .5rem;
        padding: 1.3rem;
        margin: 1.3rem;
        font-size: 2rem;
    }

    .home .content h3{
        font-size: 4rem;
    }
}

@media(max-width: 450px){
    html{
        font-size: 50;
    }
}



    /* Add styles for the my-booking button */
    .my-booking-btn {
        display: inline-block;
        padding: 12px 25px;
        background: linear-gradient(to right, #f45866, #e2a2d7);
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 30px;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .my-booking-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        background: linear-gradient(to right, #e2a2d7, #f45866);
    }

    /* Make the booking section display flex */
    .booking-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        gap: 30px;
    }

    .booking {
        flex: 0 1 800px;
        margin: 0;
    }

    .booking-sidebar {
        flex: 0 0 auto;
        margin-top: 100px;
    }
</style>
</head>
<body>

     <!--header section  from index page starts-->

     <header class="header">

        <a data-aos="zoom-in-left" data-aos-delay="150" href="#" class="logo"><i class= "fas fa-user"></i>FRENTE</a>

        <nav class="navbar">
            <a data-aos="zoom-in-left" data-aos-delay="300" href="index.php">Home</a>
            <a data-aos="zoom-in-left" data-aos-delay="450" href="about.php">About Us</a>
            <a data-aos="zoom-in-left" data-aos-delay="600" href="service.php">Services</a>
            <a data-aos="zoom-in-left" data-aos-delay="750" href="destination.php">Destinations</a>
            <a data-aos="zoom-in-left" data-aos-delay="900" href="index.php">Review</a>
            <a data-aos="zoom-in-left" data-aos-delay="1200" href="photo.php">Photos</a>
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

    <!--header section of index page ends-->


<!-- Header Section -->
<header>
    <div class="logo">
        <h1> Wed Planner</h1>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <h2 style="font-family: 'Times New Roman';">Plan Your Dream Wedding with Us</h2>
    <p>Start by booking a slot with wedding planners today!</p>
</section>

<!-- Booking Form Section -->
<div class="booking-container">
    <section id="booking-form" class="booking">
        <h3>Book Your Consultation</h3>
        <form action="submit_booking.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="start_date">Event Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">Event End Date:</label>
            <input type="date" id="end_date" name="end_date" required>

            <label for="package">Package:</label>
            <select id="package" name="package" required>
                <option value="">Select a package</option>
                <option value="1">Full Planning Package (₹400,000)</option>
                <option value="2">Partial Planning Package (₹200,000)</option>
                <option value="3">Day-of Coordination Package (₹90,000)</option>
            </select>

            <label for="comments">Additional Comments:</label>
            <textarea id="comments" name="comments" rows="4"></textarea>

            <input type="submit" name="book" value="Book Now">
        </form>
    </section>
    
    <div class="booking-sidebar">
        <a href="my_bookings.php" class="my-booking-btn">
            <i class="fas fa-calendar-check"></i> My Bookings
        </a>
    </div>
</div>

<!-- Contact Information Section -->
<section class="contact">
    <h3>Need Help? Contact Us</h3>
    <p>If you have any questions, feel free to reach out.</p>
    <p>Phone: +91 8799366188</p>
    <p>Email: wedplanner@gmail.com</p>
    
</section>

<!-- Footer Section -->
<footer>
    <p>&copy; 2025 FRENTE. All Rights Reserved.</p>
</footer>


     <!--aos cdn link-->

     <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

     <!--swiperjs cdn link-->
       <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!--custome js cdn link-->
   <script src="script.js"></script>

</body>
</html>
