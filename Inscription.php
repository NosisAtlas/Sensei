<?php
    session_start();

    try{
        $base = new PDO('mysql:host=localhost; dbname=sensei; charset=utf8',"root","");
        // echo "connexion done";
    }
    catch(Exception $e){
        // echo "connexion not done";
    };


   
    $errors=array( 'username' => '', 'password' => '');

    //SIGN UP

    if (isset($_POST['signup'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        if (empty($_POST['username'])) {
            $errors['username'] = 'Username required';
        }
        if (empty($_POST['password'])) {
            $errors['password'] ='Password required';
        }



        $reponse = $base->query("select username from users where username='$user' limit 1");
        $ligne= $reponse->fetch();
    
        if(isset($ligne['username'])){
              $errors['username'] = "Username already exists";
        }else{
            $requette = $base->prepare("insert into users(username,password) values(?,?)");
            $resultat = $requette->execute(array($user, $pass));
        }
        
    }

    //SIGN IN

    if (isset($_POST['signin'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        // $chemin = $_POST['chemin-avatar']

        if (empty($_POST['username'])) {
            $errors['username'] = 'Username required';
        }
        if (empty($_POST['password'])) {
            $errors['password'] ='Password required';
        }

        $reponse = $base->query("select username, password from users where username='$user' and password='$pass' limit 1");
        $ligne= $reponse->fetch();

        if(isset($ligne['username']) == $user && isset($ligne['password']) == $pass){
            $_SESSION['username']= $user; 
            
            header('location: profiledashboard.php'); 
        }
        else{
            $errors['username'] = 'Username does not exist';

            $errors['password'] = 'Password does not exist';
        }
    }
?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp / SignIn</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="styleinscription.css">
    <style>
        /* .inner{
            margin-top:50px;
        }
        .user-form{
            padding-top: 100px;
        }
        .safety{
            margin-top: 30px;
        }
        .action-btn{
            margin-top: 50px;
        } */
    </style>
</head>
<body>
        <div class="top-section">
                <div class="header">
                    <div class="logo"><a href="#"><span>SEN</span>SEI</a></div>

                    <div class="nav-links">
                        <a href="#">ABOUT US</a>
                        <a href="#">PARTENERS</a>
                        <a href="#">BLOG</a>
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

        <div class="inner">
            <div class="photo">
                <!-- <img src="img/pexels-pixabay-264337.jpg"> -->
            </div>
            <div class="overlay"></div>

            <div class="user-form">
                <h1>Welcome to <span>SEN</span>SEI!</h1>

                <form action="#" method="POST">
                    <i class="fas fa-user icon"></i>
                    <input type="text" name="username" placeholder="Usernamer">
                    <?php  echo $errors['username'];
                            echo "<br><br>"
                    ?>

                    <i class="fas fa-lock icon"></i>
                    <input type="password" name="password" placeholder="Password">
                    <?php  echo $errors['password'];
                            echo "<br><br>"
                    ?>

                    <!-- <div class="safety">
                        <span>Password strength</span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div> -->

                    <div class="action-btn">
                        <input type="submit" name="signup" class="btn primary" value="Create-Account">
                        <input type="submit" name="signin" class="btn" value="Sign-In">
                    </div>
                    
                </form>
            </div>
        </div>
</body>
</html>