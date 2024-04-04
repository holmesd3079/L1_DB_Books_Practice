<!DOCTYPE HTML>

<html lang="en">

<?php
    session_start();
    include("config.php");
    include("functions.php");

    $dbconnect=mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (mysqli_connect_errno())
    
    {echo "Connection failed:".mysqli_connect_error();
    exit;}
?>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Book Review Database">
    <meta name="keywords" content="books, reading, fiction, non-fiction, genre, reviews">
    <meta name="author" content="Daniel holmes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Book Review Database</title>
    
    <!-- Edit the link below / replace with your chosen google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato%7cUbuntu" rel="stylesheet"> 
    
    <!-- Edit the name of your style sheet - 'foo' is not a valid name!! -->
    <link rel="stylesheet" href="css/font-awesome.min.css"> 
    <link rel="stylesheet" href="db_book_style.css"> 
    
</head>
    
<body>
    
    <div class="wrapper">
    

        
        <div class="box banner">
            
        <!-- logo image linking to home page goes here -->
        <a href="index.php">
            <div class="box logo"  title="Logo - Click here to go to the Home Page">
            <img class="img-circle" src="images/skull_warning.png" width="150" height="150" alt="generic logo" />
            
            </div>    <!-- / logo -->
        </a>
            
            <h1>Skull reading</h1>
        </div>    <!-- / banner -->

    <!-- Navigation goes here. Edit BOTH the file name and the link name -->
    <div class="box side">
        <h2>Search | <a class="side" href="show_all.php">Show All</a></h2>
        <i>Type part of this title / author name if  desired </i>

        <hr />
        <!-- Start of title search -->

        <form method="post" action="title_search.php" enctype="multipart/form-data"> 
            <input class="search" type="text" name="title" size="40" value="" required placeholder="Title...">  
            <input class="submit" type="submit" name="find_title" value="&#xf002">
        </form>
        <!-- End of title search -->
        <!-- Start of author search -->
        <hr />
        <form method="post" action="author_search.php" enctype="multipart/form-data"> 
          <input class="search" type="text" name="author" size="40" value="" required placeholder="Author...">  
          <input class="submit" type="submit" name="find_author" value="&#xf002">
        </form>
        <!-- End of author search -->
        <hr />
         <!-- Start of genre search -->
        <form method="post" action="genre_search.php" enctype="multipart/form-data"> 

            <select class="full_width" name="genre" value="" required placeholder="Genre...">
                <option value="" disabled selected> Genre...</option>
                <?php
                $genre_sql="SELECT DISTINCT `Genre` FROM `Book_reviews` ORDER BY 'Genre' ASC";
                $genre_query=mysqli_query($dbconnect, $genre_sql);
                $genre_rs=mysqli_fetch_assoc($genre_query);

                do {
                    
                ?>
                <option value="<?php echo $genre_rs['Genre']; ?>"><?php echo $genre_rs['Genre']; ?></option>

                <?php
                }
                while($genre_rs=mysqli_fetch_assoc($genre_query));
                ?>
                
                
            </select>
			
			<input class="submit" type="submit" name="find_genre" value="&#xf002">

			
        </form>
<!-- End of genre search -->
<hr />
<!-- start of rating search -->
        <form method="post" action="rating_search.php" enctype="multipart/form-data"> 
            <select class="half_width" name="amount">
            <option value="exactly" selected>Exactly...</option>
            <option value="more">At least...</option>
            <option value="less">At most...</option>
            </select>

            <select name="rating" value="" required placeholder="Rating...">
                <option value="" disabled selected> Rating...</option>
                <option value="1">★✰✰✰✰</option>
                <option value="2">★★✰✰✰</option>
                <option value="3">★★★✰✰</option>
                <option value="4">★★★★✰</option>
                <option value="5">★★★★★</option>

            </select>

        <input class="submit" type="submit" name="find_rating" value="&#xf002">


        </form>
<!-- end of rating search -->
    </div>    <!-- / nav -->