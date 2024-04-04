
<?php include "topbit.php"; 

// if find button pushed...
if(isset($_POST["find_rating"]))

{

$rating = test_input(mysqli_real_escape_string($dbconnect, $_POST['rating']));
$amount = test_input(mysqli_real_escape_string($dbconnect, $_POST['amount']));
$string_rating = str_repeat("★", $rating );
$flip_rate = abs($rating - 5);
$rate_placeholder = str_repeat("✰", $flip_rate);

if ($amount=="exactly")
{$find_sql="SELECT * FROM `Book_reviews` WHERE `Rating` = $rating ORDER BY `Rating` DESC;";}
elseif($amount=="more")
{$find_sql="SELECT * FROM `Book_reviews` WHERE `Rating` >= $rating ORDER BY `Rating` DESC;";}
else 
{$find_sql="SELECT * FROM `Book_reviews` WHERE `Rating` <= $rating ORDER BY `Rating` DESC;";}

// $rating = mysqli_real_escape_string($dbconnect, $rating);
$find_query=mysqli_query($dbconnect, $find_sql);
$find_rs=mysqli_fetch_assoc($find_query);
$count=mysqli_num_rows($find_query);

?>
<div class="box main">
    <h2>Rating Search <?php echo $string_rating; echo $rate_placeholder?></h2>
   <?php
   // check results exist
    if ($count<1)

    {
    ?>
    <div class="error">
    Sorry! there are no books with a <?php echo $rating ?> Star rating. Please use the rating box in the side bar to try another rating.
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
    } // end the very top if    

   ?>
    
</div>    <!-- / main -->
        

<?php include "bottombit.php"; ?>
