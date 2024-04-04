<?php include "topbit.php"; 

$showall_sql="SELECT * FROM `Book_reviews` ORDER BY `Book_reviews`.`Title` ASC";
$showall_query=mysqli_query($dbconnect, $showall_sql);
$showall_rs=mysqli_fetch_assoc($showall_query);
$count=mysqli_num_rows($showall_query);

?>
<div class="box main">
    <h2>All items</h2>
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
        <p>Title: <span class="sub_heading"><?php echo $showall_rs['Title']; ?></span></p>

        <p>Author: <span class="sub_heading"><?php echo $showall_rs['Author']; ?></span>
        </p>

        <p>Genre: <span class="sub_heading"><?php echo $showall_rs['Genre']; ?></span>
        </p>

        <p>Rating: <span class="sub_heading">
            <?php
            for ($x=0; $x < $showall_rs['Rating']; $x++)

            {
                echo "&#9733;";
            } echo  str_repeat("✰", abs($showall_rs['Rating'] - 5)) 
            ?>
        </span></p>

        <p><span class="sub_heading">Review / Response</span></p>

        <p>
             <?php echo $showall_rs['Review']; ?>
        </p>
    </div>
    <br />

    <?php
        } // end do
      //  https://youtu.be/Tbvf82B4RP8?list=PLwll6mdTmnFF-3qD4SYSqDZo4u7K0VUSs&t=15 Where to put the screenshot
        while($showall_rs=mysqli_fetch_assoc($showall_query));
    } // end else
   // if results, display
   
   ?>
    
</div>    <!-- / main -->
        

<?php include "bottombit.php"; ?>
