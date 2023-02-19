
<?php
    session_start();

    try{
        $base = new PDO('mysql:host=localhost; dbname=sensei; charset=utf8',"root","");
        // echo "connexion done";
    }
    catch(Exception $e){
        // echo "connexion not done";
    };

    $errors=array('username' => '',"user_add" => '');


    if(isset($_POST['add'])){
        if (empty($_POST['user_add'])) {
            $errors['user_add'] = 'Username required';
        }

        $requette2=$base->prepare("select * from users where username = ?");
        $requette2->execute(array($_POST['user_add']));
        $ligne= $requette2->fetch();
   

        if(isset($ligne['username'])){
          
            $errors['username'] = "Username already exists";
      }else{
        
        $useradd = $_POST['user_add'];
        $chemin="img/Avatar-1.png";
        $requette = $base->prepare("insert into users(username,chemin_avatar,id_role) values(?,?,?)");
        $resultat = $requette->execute(array($useradd, $chemin, 2));
        // var_dump(resultat);
       }
    }
?>






<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD/CATEGORY</title>
    <link rel="stylesheet" href="css/stylecategory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        
    </style>
</head>
<body>
    <div class="top-section">
        <div class="header">
            <div class="logo"><a href="#"><span>SEN</span>SEI</a></div>

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

    <div class="dashboard-section">

        <div class="dashboard-header">

        <div class="username"><?php   echo $_SESSION['username'] ;  ?></div>

            <!-- <nav class="search-bar">
                <form class="form-inline">
                    <input class="search-input" type="search" name="search" placeholder="Search" aria-label="Search">
                    <input class="search-btn" type="submit" name="btn-search" value="search">
                </form>
            </nav> -->

        </div>


        <div class="dashboard-main-content">

            <div class="dashboard-side-content">
                <ul class="links-list">
                    <li><a href="adminprofiledashboard.php">Profile</a></li>
                    <?php  if($_SESSION['id_role'] == 1 ) {?>
                    <li><a href="admincategorydashboard.php">Manage Categories</a></li>
                    <?php  } ?>
                    <li><a href="adminarticlesdashboard.php">Manage Articles</a></li>
                    <?php  if($_SESSION['id_role'] == 1 ) {?>
                    <li><a href="adminmanageusersdashboard.php">Manage Users</a></li>
                    <?php  } ?>
                    <li><a href="admincommentsdashboard.php">Manage Comments</a></li>
                    <li><a href="deconnexion.php">Disconnect</a></li>
                </ul>
            </div>

            
            <div class="dashboard-article-content">
                <form action="#" class="article-editor" method="POST" >

                    <div class="add-title article-div">
                        <h1>Add User</h1>
                        <input type="text" class="article-inputs" name="user_add" id="">
                       
                        <input type="submit" value="Add" name="add" style="color:#141517; background-color:#ecc113;border:none;padding:15px 30px;cursor:pointer;">
                        <h4 style='color: #ec1a13; font-size:15px;'><?php echo $errors['username']; ?></h4>
                        <h4 style='color: #ec1a13; font-size:15px;'><?php echo $errors['user_add']; ?></h4>

                    </div>
                </form>


                    <div class="manage-articles article-div" style="margin-left:30px">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col" style="padding:20px 150px">Users</th>
                                <th scope="col" style="padding:20px 50px">badge</th>
                                <th scope="col" style="padding:20px 50px">Discard</th>
                                </tr>
                            </thead>
                            <tbody><?php
                                    if(isset($_GET["id"])){
                                        $category = $_GET["username"];


                                        $requette = $base->prepare("DELETE FROM users WHERE id_user=?");
                                        $resultat = $requette->execute(array($_GET['id']));
                                        // var_dump($requette);
                                       // header('location:adminmanageusersdashboard.php'); //PROBLEM OF HEADER!!!!!!
                                       session_destroy();
                                        header('location: index.php');

                                    }
                        
                                ?>
                            <?php     $reponse = $base->query("select * from users");
                                while($ligne=$reponse->fetch()) { 
                                    $_POST['user_add']=$ligne['username'];
                            ?> 
                                <tr>
                                <td><a href="#"><h2><?php   echo $_POST['user_add'] ;   ?></h2></a></td>
                                <td><a href="adminmanageuserupdatedashboard.php?id=<?php echo $ligne['id_user'];?>&username=<?php echo $ligne['username']?>">Update</a></td>
                                <td><a name="delete" href="adminmanageusersdashboard.php?id=<?php echo $ligne['id_user'];?>&username=<?php echo $ligne['username']?>">Delete</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
         
            </div>
                
        </div>
    </div>



    <script src="ckeditor5-build-classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.getElementById('text_editor2'));

        // ClassicEditor
		// .create( document.querySelector( '#editor' ), {
		// 	// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		// } )
		// .then( editor => {
		// 	window.editor = editor;
		// } )
		// .catch( err => {
		// 	console.error( err.stack );
		// } );
    </script>
</body>
</html>