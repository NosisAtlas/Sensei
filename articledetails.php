<?php
    session_start();

    try{
        $base = new PDO('mysql:host=localhost; dbname=sensei; charset=utf8',"root","");
        // echo "connexion done";
    }
    catch(Exception $e){
        // echo "connexion not done";
    };
  

    $errors=array( 'input-insert-user' => '', 'insert-cmnts' => '');

    if(isset($_POST["submit-comment"])){
        $insertcmnt = $_POST["insert-cmnts"];
        // if (empty($_POST["input-insert-user"])){
        //     $errors['input-user'] = 'Category name required';
        // }
        if(empty($_POST["insert-cmnts"])){
            $errors['insert-cmnts'] = 'Category name required';
        }

       

        $requette2 = $base->prepare("insert into comments(comment_content,id_user,id_article) values(?,?,?)");
        $requette2->execute(array($insertcmnt,$_SESSION['id_user'],$_GET['id_article']));
    }

    // $requette2 = $base->prepare("select * from comments where id_article=?");
    // $requette2->execute(array($_GET['id_article']));

    $requette2 = $base->prepare("select users.username, comments.comment_content from users , comments, articles where comments.id_article = ?  and comments.id_user = users.id_user and articles.id_article = comments.id_article");
    $requette2->execute(array($_GET['id_article']));
  

    // $requette2 = $base->prepare("select comment_content.comments, username.users from comments innerjoin users on comments.id_comment = users.username");
    // $requette2->execute(array($_SESSION['id_user']));


    
?>











<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Details</title>
    <link rel="stylesheet" href="css/stylearticledetails.css">
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
    <div class="user-session-section" style="width:130px;">
        <!-- <div class="menu"><a href="#"><i class="fa fa-list"></i></a></div> -->
        <div class="user-name"><?php echo $_SESSION['username']; ?></div>
        <div class="avatar-content"><a href="adminprofiledashboard.php"><img src="<?php echo $_SESSION['chemin_avatar']; ?>" alt=""></a></div>
    </div>
    <?php  } ?>


    <div class="second-section">

    <?php $requette3 = $base->prepare("select * from articles where id_article=?");
          $requette3->execute(array($_GET['id_article']));

        while($ligne = $requette3->fetch()){  ?>
        <h1><?php echo $ligne['title']  ?> </h1>
        <div style="height: 100%;" class="article-content">
            <h2><?php echo $ligne['description']  ?></h2>
            <div class="img-content"><img src="<?php echo $ligne['image_article']  ?>" alt=""></div>
            <div class="clear-float"></div>
            <p><?php echo $ligne['content']  ?></p>
        </div>
        <?php } ?>

        <div class="comment-content">
            <h3>All Comments</h3>
            <?php              
            while($ligne = $requette2->fetch())
            {     ?>
            <h4><?php echo $ligne['username'] ?></h4>
            <p class="comment-inner"><?php
             echo $ligne['comment_content']; ?></p>
            <br><br>
            <?php  } ?>
        </div>
        
        <?php  if(isset($_SESSION['id_user'])) {?>
        <div class="comment-insert">
            <form action="#" method="POST">
                <!-- <label for="" style="color:#e1e1e1">Username :</label><br>
                <input class="input-insert-cmnt" type="text" name="input-insert-user" id=""><br><br> -->
                <label for="" style="color:#e1e1e1">Comment :</label><br>
                <input class="input-insert-cmnt" type="text" name="insert-cmnts"><br><br>
                <input type="submit" name="submit-comment" value="Comment" style="color:#141517; background-color:#ecc113;border:none;padding:13px 30px;cursor:pointer;">
            </form>
        </div>
        <?php  } ?>

    </div>


    <div class="footer">
    <div class="logo"><a href="index.php"><span>SEN</span>SEI</a></div>
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