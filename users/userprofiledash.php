<?php
        session_start();

        try{
            $base = new PDO('mysql:host=localhost; dbname=sensei; charset=utf8',"root","");
            // echo "connexion done";
        }
        catch(Exception $e){
            // echo "connexion not done";
        };

        if(isset($_POST["submit"])){
 
    
           if(isset( $_FILES['srcimage'])    and  $_FILES['srcimage']['error'] == 0)
           {
               if( $_FILES['srcimage']['size']< 3000000)
               {
                   $list_extensions = array('png','jpg', 'jpeg', 'gif'); 
                   $details = pathinfo($_FILES['srcimage']['name']); 
                   $extension = $details['extension']; 
                   $resultat = in_array($extension, $list_extensions); 
                   if($resultat)
                   {
                       move_uploaded_file($_FILES['srcimage']['tmp_name'], 'images/'.$details['basename']); 
                       $chemin = 'images/'.$details['basename'] ; 
                       $_SESSION['chemin_avatar']=$chemin;
    
                        //  $requette1 = $base->prepare("insert into users(chemin_avatar) values(?)");
                        //  $requette1->execute(array($chemin));
                        //  $_SESSION['chemin_avatar'] = $chemin;

                        $requette = $base->prepare("UPDATE users SET chemin_avatar = ?  WHERE username = ?");
                        $resultat = $requette->execute(array($chemin, $_SESSION['username']));
                   }
               }
           }
    
        }
    
    
          
        $requette1 = $base->prepare("select chemin_avatar,username from users order by id_user desc limit 1");
        $requette1->execute(array());
        // $_SESSION['chemin_avatar'] = $ligne['chemin_avatar']



?>







<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD/USER</title>
    <link rel="stylesheet" href="css/styleuserprofile.css">
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

    <div class="dashboard-section">

        <div class="dashboard-header">

            <div class="username"><?php   echo $_SESSION['username'] ;  ?></div>

            <nav class="search-bar">
                <form class="form-inline">
                    <input class="search-input" type="search" name="search" placeholder="Search" aria-label="Search">
                    <input class="search-btn" type="submit" name="btn-search" value="search">
                </form>
            </nav>

        </div>


        <div class="dashboard-main-content">

            <div class="dashboard-side-content">
                <ul class="links-list">
                    <li><a href="userprofiledash.php">Profile</a></li>
                    <li><a href="userarticlesdashboard.php">Manage Articles</a></li>
                    <li><a href="usercommentsdashboard.php">Manage Comments</a></li>
                    <li><a href="deconnexion.php">Disconnect</a></li>
                </ul>
            </div>

            <div class="dashboard-profile-content">
                <div class="profile-top">

                    <img class="avatar-img shadow-dark" src="<?php echo $_SESSION['chemin_avatar'] ?>" alt="">

                    <h1 class="name-user"><?php   echo $_SESSION['username'] ;   ?></h1>
                    <p class="user-title" style="margin-bottom:20px;">User</p>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <!-- <label>Select a file</label> -->
                        <input type="file" name="srcimage" id="file" style="display:none">
                        <label for="file" style="color:#141517; background-color:#ecc113; height:30px; width: 40px; padding:10px 20px;cursor:pointer;">Choose a Picture</label>
                        <br>
                        <input type="submit" name="submit" value="Validate" style="margin-top:10px;border:none;color:#939393; background-color:#2f3031; height:30px; width: 100px; padding:10px 20px;cursor:pointer;">
                    </form>
                </div>

                <div class="cards-container" style="margin-top:20px;">
                    
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="card-title">Articles</h2>
                            <p class="card-text">With bunch of articles about various category related to sports.</p>
                            <a href="#" class="btn">See All...</a>
                        </div>
                    </div>
                    
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="card-title">Comments</h2>
                            <p class="card-text">With bunch of articles about various category related to sports.</p>
                            <a href="#" class="btn">See All...</a>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="card-title">Favourites Articles</h2>
                            <p class="card-text">With bunch of articles about various category related to sports.</p>
                            <a href="#" class="btn">See All...</a>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
    </div>
</body>
</html>