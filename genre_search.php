
<?php include "topbit.php"; 

// if find button pushed...
if(isset($_POST["find_genre"]))

{

$genre =$_POST['genre'];
echo $genre; 

$genre = mysqli_real_escape_string($dbconnect, $genre);
	
$find_sql="SELECT * FROM `Book_reviews` WHERE `genre` LIKE '%$genre%' ORDER BY `genre` ASC";
$find_query=mysqli_query($dbconnect, $find_sql);
$find_rs=mysqli_fetch_assoc($find_query);
$count=mysqli_num_rows($find_query);

?>
<div class="box main">
    <h2>genre search</h2>
   <?php
   // check results exist
    if ($count<1)

    {
    ?>
    <div class="error">
    Sorry! there are no results that match your search. Please use the search box in the side bar to try again.
    </div>

    <?php

    }
   //if no result, error
    else {

        do {
            
        ?>
        <div class="results">
        <p>Title: <span class="sub_heading"><?php echo $find_rs['Title']; ?></span></p>

        <p>Author: <span class="sub_heading"><?php echo $find_rs['Author']; ?></span>
        </p>

        <p>Genre: <span class="sub_heading"><?php echo $find_rs['Genre']; ?></span>
        </p>

        <p>Rating: <span class="sub_heading">
            <?php
            for ($x=0; $x < $find_rs['Rating']; $x++)

            {
                echo "&#9733;";
            }
            echo  str_repeat("✰", abs($find_rs['Rating'] - 5)) 
            ?>
        </span></p>

        <p><span class="sub_heading">Review / Response</span></p>

        <p>
             <?php echo $find_rs['Review']; ?>
        </p>
    </div>
    <br />

    <?php
        } // end do
        while($find_rs=mysqli_fetch_assoc($find_query));
    } // end else
   // if results, display
    } // enf the very top if    

   ?>
    
</div>    <!-- / main -->
        

<?php include "bottombit.php"; ?>
