
<?php
    session_start();


    try{
        $base = new PDO('mysql:host=localhost; dbname=sensei; charset=utf8',"root","");
        // echo "connexion done";
    }
    catch(Exception $e){
        // echo "connexion not done";
    };


    if (isset($_POST['submit'])) {
        $title = $_POST['article_title'];

        if (empty($_POST['article_title'])) {
           echo "YEEEEEEEEEY";
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
?>






<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD/COMMENT</title>
    <link rel="stylesheet" href="css/stylecomment.css">
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
                <form class="article-editor" method="POST" enctype="multipart/data-form">

                    <div class="manage-articles article-div">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Comments</th>
                                <th scope="col">Discard</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  if($_SESSION['id_role'] == 1 ){
                                       $requette2 = $base->prepare("select * from comments");
                                       $requette2->execute(array()); }
                                       else{
                                        $requette2 = $base->prepare("select * from comments where id_comment = id_user");
                                        $requette2->execute(array()); }
                                       
                                       while ($ligne = $requette2-> fetch()){ 
                                ?>
                                <tr>
                                <td><a href="#"><h2><?php echo $ligne['comment_content']; ?></h2></a></td>
                                <td><a name="delete" href="admincommentsdashboard.php?id=<?php echo $ligne['id_comment'];?>">Delete</a></td>
                                <?php
                                    if(isset($_GET["id"])){
                                        


                                        $requette = $base->prepare("DELETE FROM comments WHERE id_comment='" . $_GET['id'] . "'");
                                        $resultat = $requette->execute(array());
                                        // var_dump($requette);
                                        header('location:admincommentsdashboard.php');

                                    }
                        
                                ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
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