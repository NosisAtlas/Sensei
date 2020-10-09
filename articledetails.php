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
        $insertuser = $_POST["input-insert-user"];
        $insertcmnt = $_POST["insert-cmnts"];
        // if (empty($_POST["input-insert-user"])){
        //     $errors['input-user'] = 'Category name required';
        // }
        if(empty($_POST["insert-cmnts"])){
            $errors['insert-cmnts'] = 'Category name required';
        }

       

        $requette2 = $base->prepare("insert into comments(comment_content,id_user) values(?,?)");
        $requette2->execute(array($insertcmnt,$_SESSION['id_user']));
    }

    // $requette2 = $base->prepare("select * from comments where id_article=?");
    // $requette2->execute(array($_SESSION['id_user']));

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
        <h1>ARTICLE NAME</h1>
        <div class="article-content">
            <h2>Article Description Here Is The Description</h2>
            <div class="img-content"><img src="img/pexels-stanley-morales-2475108.jpg" alt=""></div>
            <div class="clear-float"></div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat porro esse placeat facilis quam non molestias totam reprehenderit doloribus eius iste neque ad eveniet et, dolore earum in aliquam fugiat.
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est natus cumque explicabo quae quis laborum voluptatibus, similique recusandae? Explicabo iusto libero eveniet obcaecati molestias ipsam quod laboriosam est minima deleniti?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, architecto ullam nesciunt animi possimus quas ex eius illum in temporibus esse aliquam assumenda est quo laudantium saepe dolorem ipsum at?
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure laboriosam vitae, ipsum iusto hic facere sint eaque odio nemo porro. Ea perspiciatis delectus quo eveniet, voluptates sit dolores quidem est!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis iusto illo quo! Fuga omnis enim officiis nisi fugiat obcaecati? Exercitationem ipsa omnis nostrum vero animi rem nam sunt magnam pariatur.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis ex atque magnam possimus quis sit, quam est sunt dignissimos eos? Animi, atque aliquam. Magnam excepturi fuga quas ab cum neque.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio quidem animi dolor ipsam dolores quaerat voluptas autem obcaecati laboriosam laborum assumenda commodi vel, iste inventore! Molestiae fugit cum quaerat magnam!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta tenetur animi laboriosam ex soluta quae voluptate repellendus quaerat aut? Sunt pariatur id doloremque harum obcaecati omnis sed ipsum voluptate iure.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ab fugit fugiat ducimus dignissimos expedita aspernatur maiores deserunt atque earum et error nisi, explicabo molestiae quidem eos harum alias itaque!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Error maiores nesciunt facere optio voluptas modi. Sunt cupiditate omnis in ipsa dolores! Nam pariatur eligendi sunt tempore dolorum, consequuntur veniam fugit.
            </p>
            <h2>Description two is here all</h2>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam consectetur repudiandae ea, deserunt voluptate fuga ut perferendis quos eaque sapiente explicabo sint voluptatem, soluta dignissimos quisquam ab, tempora commodi incidunt.
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus et officia inventore officiis cumque rem nulla quo, dolorem, ea ipsum sapiente voluptates fuga optio voluptatum labore praesentium? Incidunt, vel hic.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. At magni eius enim error. Quos, exercitationem? Magni, ipsum! Ex laudantium impedit ipsam, dolorem, veniam blanditiis, dicta velit id eos non deserunt.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium odio, quis iste quos sequi consequuntur incidunt molestiae explicabo harum repellat quae ea doloremque voluptate omnis. Magni exercitationem dolore laborum quae.
            </p>
        </div>

        <div class="comment-content">
            <h3>All Comments</h3>
            <?php  
            // while($ligne = $requette2->fetch()) 
            // $comment=$ligne['comment_content'];
            // $usernamecmnt=$ligne['username'];
            // var_dump($usernamecmnt);
            {     ?>
            <h4>Username</h4>
            <p class="comment-inner"><?php 
            // echo $usernamecmnt; 
            ?></p>
            <br><br>
            <?php  } ?>
        </div>

        <div class="comment-insert">
            <form action="#" method="POST">
                <label for="" style="color:#e1e1e1">Username :</label><br>
                <input class="input-insert-cmnt" type="text" name="input-insert-user" id=""><br><br>
                <label for="" style="color:#e1e1e1">Comment :</label><br>
                <input class="input-insert-cmnt" type="text" name="insert-cmnts"><br><br>
                <input type="submit" name="submit-comment" value="Comment" style="color:#141517; background-color:#ecc113;border:none;padding:13px 30px;cursor:pointer;">
            </form>
        </div>
    </div>


    <div class="footer">
        <div class="logo"><a href="#"><span>SEN</span>SEI</a></div>
        <div class="navigation">
            <div class="navigation-title">NAVIGATION</div>
            <div class="nav-links">
                <a href="aboutuspage.php">ABOUT US</a>
                <a href="#">PARTNERS</a>
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