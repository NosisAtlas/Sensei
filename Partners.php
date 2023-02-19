<?php 
    session_start();
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partners</title>
    <link rel="stylesheet" href="css/stylepartners.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        
    </style>
</head>
<body>
    <div class="top-section">
        <div class="header">
            <div class="logo"><a href="index.php"><span>SEN</span>SEI</a></div>

            <div class="nav-links">
                <a href="aboutuspage.php">ABOUT US</a>
                <a href="Partners.php">PARTNERS</a>
                <a href="blog.php">BLOG</a>
                <a href="contactpage.php">CONTACTS</a>
            </div>

            <div class="menu">
                <a href="#"><i class="fa fa-list"></i>MENU</a>
            </div>

            <div class="social-links">
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <?php  if(isset($_SESSION['id_user'])) {?>
    <div class="user-session-section" style="width:130px">
        <!-- <div class="menu"><a href="#"><i class="fa fa-list"></i></a></div> -->
        <div class="user-name"><?php echo $_SESSION['username']; ?></div>
        <div class="avatar-content"><a href="adminprofiledashboard.php"><img src="<?php echo $_SESSION['chemin_avatar']; ?>" alt=""></a></div>
    </div>
    <?php  } ?>


   <div class="second-section">
       <div class="about-div">
            <h3>CREATING, DEVELOPING & MANAGING PARTNERSHIPS THROUGHOUT SPORT.</h3>
            <h4>To ensure that every aspect was taken care of so that they could simply concentrate on the task at hand of being the best they can be. Away from the pitch, court or track The Sports Partnership also partners with clients to implement businesses and projects which will last long beyond their competitive days as an athlete.
                We have had the pleasure of partnering with world-class athletes and in turn, partnering them with world-class brands. Along the way we enhance and manage our client’s reputations to increase marketability to the brand partners they aspire to have.
            </h4>
            <h2>WE PARTNER WITH PEOPLE WHO WE BELIEVE IN AND IN TURN BELIEVE IN US.</h2>
            <div class="first-row">
                <img src="img/BRANDS-25.png" alt="">
                <img src="img/BRANDS-29-1.png" alt="">
                <img src="img/BRANDS-30.png" alt="">
            </div>
            <div class="first-row">
                <img src="img/BRANDS-17.png" alt="">
                <img src="img/BRANDS-18.png" alt="">
                <img src="img/BRANDS-21.png" alt="">
            </div>
        </div>
        
   </div>


    <div class="footer">
        <div class="logo"><a href="index.php  "><span>SEN</span>SEI</a></div>
        <div class="navigation">
            <div class="navigation-title">NAVIGATION</div>
            <div class="nav-links">
                <a href="aboutuspage.php">ABOUT US</a>
                <a href="Partners.php">PARTNERS</a>
                <a href="blog.php">BLOG</a>
                <a href="contactpage.php">CONTACTS</a>
            </div>
        </div>
        <div class="contact">
            <div class="contact-info">CONTACT INFO</div>
            <div class="contact-details">
                <a href="#">096 N Highland St, Arlington</a>
                <a href="#">VA 32101, USA</a>
                <a href="#">sensei@demo.org</a>
            </div>
        </div>
    </div>
</body>
</html>