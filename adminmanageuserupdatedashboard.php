
<?php
    session_start();

    try{
        $base = new PDO('mysql:host=localhost; dbname=sensei; charset=utf8',"root","");
        // echo "connexion done";
    }
    catch(Exception $e){
        // echo "connexion not done";
    };


    $errors="";

    


    if(isset($_POST["update-username"])){
        $username = $_POST['username'];
        $role = $_POST['role'];


        $requette = $base->prepare("UPDATE users SET username = ? , id_role = ? WHERE id_user=? ");
        $resultat = $requette->execute(array($username, $role, $_GET['id']));
        // var_dump($resultat);
        // echo $_POST['username'];
        // echo $_POST['role'];
        header('Location:adminmanageusersdashboard.php');
        
    }


    
?>






<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD/MANAGE USER UPDATE</title>
    <link rel="stylesheet" href="css/stylecategory.css">
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

                    <div class="add-title article-div">
                        <h1>Update Username</h1>
                        <input type="text" class="article-inputs" name="username" id="" value="<?php echo $_GET['username']; ?>"><br><br>
                        <h1>Update Badge</h1>
                        <input type="text" class="article-inputs" name="role" id=""><br><br>
                       
                        <input type="submit" name="update-username" value="Update" style="color:#141517; background-color:#ecc113;border:none;padding:15px 30px;cursor:pointer;">
                    
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