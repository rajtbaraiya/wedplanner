<?php
session_start();
?>
<!-- header section starts  -->
<header class="header">
    <a href="index.php" class="logo">Wedding<span>Planner</span></a>
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="service.php">Services</a>
        <a href="gallery.php">Gallery</a>
        <a href="pricing.php">Pricing</a>
        <a href="review.php">Review</a>
        <a href="contact.php">Contact</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="booking.php">Book Now</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>
<!-- header section ends -->
