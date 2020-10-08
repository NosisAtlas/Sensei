<?php
        session_start();

        try{
            $base = new PDO('mysql:host=localhost; dbname=sensei; charset=utf8',"root","");
            // echo "connexion done";
        }
        catch(Exception $e){
            // echo "connexion not done";
        };

        // var_dump($_SESSION['username']);

?>  




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABOUT US</title>
    <link rel="stylesheet" href="css/styleabout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /*USER-SESSION-SECTION*/

.user-session-section{
    position: absolute;
    width: 200px;
    height: 50px;
    background-color: #ecc113;
    right: 0;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 10px;
}


.user-session-section .avatar-content{
    width: 45px;
    height: 45px;
    border-radius: 50%;
    border: 1px solid #e1e1e1;
    margin-left: 5px;
    cursor: pointer;
}

.user-session-section .avatar-content img{
    width: 100%;
    height: 100%;
    border-radius: 50%;
}


.user-session-section .user-name{
    font-size: 18px;
    font-weight: 530;
    color: #131419;
}


.user-session-section .menu{
    margin-right: 30px;
}


.user-session-section .menu a{
    color: #0d1118;
    font-size: 24px;
}
    </style>
</head>
<body>
    <div class="top-section">
        <div class="header">
            <div class="logo"><a href="LandingPage.php"><span>SEN</span>SEI</a></div>

            <div class="nav-links">
                <a href="aboutuspage.php">ABOUT US</a>
                <a href="#">PARTNERS</a>
                <a href="blog.php">BLOG</a>
                <a href="#">CONTACTS</a>
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
    <div class="user-session-section">
        <div class="menu"><a href="#"><i class="fa fa-list"></i></a></div>
        <div class="user-name"><?php echo $_SESSION['username']; ?></div>
        <div class="avatar-content"><a href="adminprofiledashboard.php"><img src="<?php echo $_SESSION['chemin_avatar']; ?>" alt=""></a></div>
    </div>
    <?php  } ?>
    

    <div class="second-section">
        <h1>The Ultimate Dynamic Sports Destination Welcomes You!</h1>

        <div class="about-div">
            <p>While the story of this sports arts club is not as tumultuous and vivid as some stories out of ancient Chinese or Japanese epos tales, 
            still we have more than 20 years of our proud history… It was in 1996, when the founder of the club, 
            Hans Breuter was still considering whether to go to the college for getting a law degree or pursue a career of teaching martial arts 
            for the living. Luckily for 15, 00 students he and his instructors have taught since, Hans decided that founding a school of his own would be
             the best decision. During those 20 years Hans and his colleagues have achieved a tremendous level of success, helping thousands of 
             individuals in becoming more empowered, fit, healthy and mind-balanced!</p>
             <img src="img/shutterstock_1071593777.jpg" alt="">
        </div>
    </div>


    <div class="footer">
        <div class="logo"><a href="LandingPage.php"><span>SEN</span>SEI</a></div>
        <div class="navigation">
            <div class="navigation-title">NAVIGATION</div>
            <div class="nav-links">
                <a href="aboutuspage.php">ABOUT US</a>
                <a href="#">PARTENERS</a>
                <a href="blog.php">BLOG</a>
                <a href="#">CONTACTS</a>
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