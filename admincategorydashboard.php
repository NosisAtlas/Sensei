
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

    if (isset($_POST['add-category'])) {
        $category = $_POST['category_title'];

        if (empty($_POST['category_title'])) {
            $errors['category'] = 'Category name required';
        }

            $requette3 = $base->prepare("insert into categories(title_category) values(?)");
            $requette3->execute(array($category));


            // $reponse = $base->query("select title_category from categories");
            // $ligne= $reponse->fetch();

            
            //  echo "YEEEEEEEH";
    
        // if(isset($ligne['title_category'])){
            // $requette1 = $base->prepare("insert into categories(title_category) values(?)");
            //  $requette1->execute(array($category));
        // }else{
        //     $chemin="img/Avatar-1.png";
        //     $requette = $base->prepare("insert into users(username,password,chemin_avatar,id_role) values(?,?,?,?)");
        //     $resultat = $requette->execute(array($user, $pass, $chemin, 2));
        // }
        
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
                    <li><a href="adminprofiledashboard.php">Profile</a></li>
                    <?php  if($_SESSION['id_role'] == 1 ) {?>
                    <li><a href="admincategorydashboard.php">Manage Categories</a></li>
                    <?php  } ?>
                    <li><a href="adminarticlesdashboard.php">Manage Articles</a></li>
                    <?php  if($_SESSION['id_role'] == 1 ) {?>
                    <li><a href="adminmanageusersdash.php">Manage Users</a></li>
                    <?php  } ?>
                    <li><a href="admincommentsdashboard.php">Manage Comments</a></li>
                    <li><a href="deconnexion.php">Disconnect</a></li>
                </ul>
            </div>

            
            <div class="dashboard-article-content">
                <form class="article-editor" method="POST" enctype="multipart/data-form">

                    <div class="add-title article-div">
                        <h1>Add Category</h1>
                        <input type="text" class="article-inputs" name="category_title" id="">
                       
                        <input type="submit" name="add-category" value="Add" style="color:#141517; background-color:#ecc113;border:none;padding:15px 30px;cursor:pointer;">
                    
                    </div>



                    <div class="manage-articles article-div">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Category</th>
                                <th scope="col">Modify</th>
                                <th scope="col">Discard</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php     $reponse = $base->query("select * from categories");
                                while($ligne=$reponse->fetch()) { 
                                    $_SESSION['title_category']=$ligne['title_category'];
                                    $_SESSION['id_category']=$ligne['id_category'];
                            ?> 
                            
                                <tr>
                                <td><a href="#"><h2><?php   echo $_SESSION['title_category'] ;   ?></h2></a></td>
                                <td><a href="#">Update</a></td>
                                <td><a name="delete" href="admincategorydashboard.php?id=<?php echo $ligne['id_category'];?>&category=<?php echo $ligne['title_category']?>">Delete</a></td>
                                <?php
                                    if(isset($_GET["id"])){
                                        $category = $_GET["category"];


                                        $requette = $base->prepare("DELETE FROM categories WHERE id_category='" . $_GET['id'] . "'");
                                        $resultat = $requette->execute(array());
                                        // var_dump($requette);
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