<?php
        session_start();


?>







<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    <div class="dashboard-section">

        <div class="dashboard-header">

            <div class="username">Fresky</div>

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
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Manage Categories</a></li>
                    <li><a href="#">Manage Articles</a></li>
                    <li><a href="#">Manage Users</a></li>
                    <li><a href="#">Manage Comments</a></li>
                </ul>
            </div>

            
            <div class="dashboard-profile-content">
                <div class="profile-top">
                    <img class="avatar-img shadow-dark" src="img/Harry-Watts-Saxmundham-Suffolk-0040-September-08-2017-copyright-Foyers-Photography-Edit-2-website.jpg" alt="">
                    <h1 class="name-user">FRESKY</h1>
                    <p class="user-title">Admin</p>
                </div>

                <div class="cards-container">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="card-title">Categories</h2>
                            <p class="card-text">With bunch of articles about various category related to sports.</p>
                            <a href="#" class="btn">See All...</a>
                        </div>
                    </div>

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