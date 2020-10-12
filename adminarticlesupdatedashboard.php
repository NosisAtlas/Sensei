
<?php
    session_start();

    try{
        $base = new PDO('mysql:host=localhost; dbname=sensei; charset=utf8',"root","");
        // echo "connexion done";
    }
    catch(Exception $e){
        // echo "connexion not done";
    };
//   echo $_SESSION['id_user']; 

    $errors=array( 'article_title' => '', 'category_title' => '', 'category_selection' => '', 'article_description' => '', 'srcimage' => '','text_editor' => '');

    if (isset($_POST['publish'])) {
        $articletitle = $_POST['article_title'];
        $categorytitle = $_POST['category_selection'];
        $articledescription = $_POST['article_description'];
        $texteditor = $_POST['text_editor'];
        $link_image = '';


        
        // var_dump($_SESSION['article_title']);
        // var_dump($_SESSION['category_selection']);
        // var_dump($_SESSION['article_description']);
        // var_dump($_SESSION['text_content']);
        

        if(empty($_POST['article_title'])){
            $errors['article_title']="Article Title Required";
        }
        if(empty($_POST['article_description'])){
            $errors['article_description']="Article Description Required";
        }

        

    
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
                        move_uploaded_file($_FILES['srcimage']['tmp_name'], 'images-blog/'.$details['basename']); 
                        $link_image = 'images-blog/'.$details['basename'] ; 

                        // var_dump($_SESSION['image_article']);

                        //  var_dump($_SESSION['article_title']);
                    }
                }
            }

            if(empty($_POST['text_editor'])){
                $errors['text_editor']="Article Content Required";
            }


        // var_dump($articletitle);
        // var_dump($categorytitle);
        // var_dump($articledescription);
        // var_dump($texteditor);
        // var_dump($link_image);
    
        
        
        $requette = $base->prepare("UPDATE articles SET title = ?, description = ?, image_article = ?, content = ?, id_category=?, id_user = ? WHERE id_article=? ");
        $resultat = $requette->execute(array($articletitle,$articledescription,$link_image,$texteditor,$categorytitle,$_SESSION['id_user'],$_GET['id']));
        header('Location:adminarticlesdashboard.php');
                // var_dump($resultat);
        
     
         
            // $requette1 = $base->prepare("insert into articles(title,description,image_article,content,id_category,id_user) values(?,?,?,?,?,?)");
            // $requette1->execute(array($articletitle, $articledescription, $link_image, $texteditor, $categorytitle,$_SESSION['id_user']));
            

            
    }



    


?>






<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD/ARTICLES</title>
    <link rel="stylesheet" href="css/stylearticle.css">
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
                <form class="article-editor" action="" method="POST" enctype="multipart/form-data"">

                    <div class="add-title article-div">
                        <h1>Add Title</h1>
                        <input type="text" class="article-inputs" name="article_title" id="">
                        <select name="category_selection" id="">
                            <?php     $reponse = $base->query("select * from categories");
                                while($ligne=$reponse->fetch()) {
                            ?>
                            <option value="<?php   echo $ligne['id_category'] ;   ?>" class="options"><?php   echo $ligne['title_category'] ;   ?></option>
                            <?php } ?>
                        </select>
                    </div>
                     <h4 style='color: #ec1a13; font-size:15px;'><?php echo $errors['article_title']; ?></h4>


                    <div class="add-descr article-div">
                        <h1>Add Description</h1>
                        <input type="text" class="article-inputs" name="article_description" id="">
                    </div>
                    <h4 style='color: #ec1a13; font-size:15px;'><?php echo $errors['article_description']; ?></h4>


                    <div class="add-image article-div">
                        <input type="file" name="srcimage" id="file" style="display:none">
                        <label for="file" style="color:#141517; background-color:#ecc113; height:30px; width: 40px; padding:10px 20px;cursor:pointer;">Choose a Picture</label>
                    </div>


                    <div class="add-article article-div">
                        <h1>Add Article</h1>
                        <textarea name="text_editor" id="text_editor2" cols="30" rows="10"></textarea>
                    </div>
                    <h4 style='color: #ec1a13; font-size:15px;'><?php echo $errors['article_description']; ?></h4>


                    <div class="publish-article article-div">
                        <h1>Update Article</h1>
                        <input type="submit" name="publish" value="Update" style="color:#141517; background-color:#ecc113;border:none;padding:10px 30px;cursor:pointer;">
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