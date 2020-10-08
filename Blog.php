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


        $requette2 = $base->prepare("select * from articles limit 7");
    $requette2->execute(array());
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG</title>
    <link rel="stylesheet" href="css/styleblog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

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

            <!-- <div class="menu">
                <a href="#"><i class="fa fa-list"></i>MENU</a>
            </div> -->

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
        <h1>Articles</h1>
        <div class="article-container">
            <div class="img-content"><img src="img/pexels-stanley-morales-2475108.jpg" alt=""></div>
            <div class="article-det-details">
                <h2>Article Title</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat porro esse placeat facilis quam non molestias totam reprehenderit doloribus eius iste neque ad eveniet et, dolore earum in aliquam fugiat.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est natus cumque explicabo quae quis laborum voluptatibus, similique recusandae? Explicabo iusto libero eveniet obcaecati molestias ipsam quod laboriosam est minima deleniti?
                    Lorem ipsum...
                </p>
                <a class="a-readmore" href="articledetails.php">Read More</a>
            </div>
        </div>
        <div class="article-container">
            <div class="img-content"><img src="img/pexels-pixabay-274422.jpg" alt=""></div>
            <div class="article-det-details">
                <h2>Article Title</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat porro esse placeat facilis quam non molestias totam reprehenderit doloribus eius iste neque ad eveniet et, dolore earum in aliquam fugiat.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est natus cumque explicabo quae quis laborum voluptatibus, similique recusandae? Explicabo iusto libero eveniet obcaecati molestias ipsam quod laboriosam est minima deleniti?
                    Lorem ipsum...
                </p>
                <a class="a-readmore" href="articledetails.php">Read More</a>
            </div>
        </div>

        <div class="article-container">
            <div class="img-content"><img src="img/pexels-rfstudio-3621121.jpg" alt=""></div>
            <div class="article-det-details">
                <h2>Article Title</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat porro esse placeat facilis quam non molestias totam reprehenderit doloribus eius iste neque ad eveniet et, dolore earum in aliquam fugiat.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est natus cumque explicabo quae quis laborum voluptatibus, similique recusandae? Explicabo iusto libero eveniet obcaecati molestias ipsam quod laboriosam est minima deleniti?
                    Lorem ipsum...
                </p>
                <a class="a-readmore" href="articledetails.php">Read More</a>
            </div>
        </div>

        <div class="article-container">
            <div class="img-content"><img src="img/pexels-pixabay-264279.jpg" alt=""></div>
            <div class="article-det-details">
                <h2>Article Title</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat porro esse placeat facilis quam non molestias totam reprehenderit doloribus eius iste neque ad eveniet et, dolore earum in aliquam fugiat.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est natus cumque explicabo quae quis laborum voluptatibus, similique recusandae? Explicabo iusto libero eveniet obcaecati molestias ipsam quod laboriosam est minima deleniti?
                    Lorem ipsum...
                </p>
                <a class="a-readmore" href="articledetails.php">Read More</a>
            </div>
        </div>


        <div class="article-container">
            <div class="img-content"><img src="images-blog/foottball-player-last.jpg" alt=""></div>
            <div class="article-det-details">
                <h2>Article Title</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat porro esse placeat facilis quam non molestias totam reprehenderit doloribus eius iste neque ad eveniet et, dolore earum in aliquam fugiat.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est natus cumque explicabo quae quis laborum voluptatibus, similique recusandae? Explicabo iusto libero eveniet obcaecati molestias ipsam quod laboriosam est minima deleniti?
                    Lorem ipsum...
                </p>
                <a class="a-readmore" href="articledetails.php">Read More</a>
            </div>
        </div>

        <?php  while($ligne = $requette2->fetch()){ ?>
        <div class="article-container">
            <div class="img-content"><img src="<?php echo $ligne['image_article']; ?>" alt="" ></div>
            <div class="article-det-details">
                <h2><?php echo $ligne['title']?></h2>
                <p>
                   <?php echo $ligne['content']?>
                </p>
                <a class="a-readmore" href="articledetails.php?id_article=<?php echo $ligne['id_article']?>">Read More</a>
            </div>
        </div>
        <?php } ?>

        
    </div>















    <div class="footer">
        <div class="logo"><a href="LandingPage.php"><span>SEN</span>SEI</a></div>
        <div class="navigation">
            <div class="navigation-title">NAVIGATION</div>
            <div class="nav-links">
                <a href="aboutuspage.php">ABOUT US</a>
                <a href="#">PARTNERS</a>
                <a href="Blog.php">BLOG</a>
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