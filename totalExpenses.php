<?php 

// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
    // include the config file that we created before

    require "../config.php"; 
    // this is called a try/catch statement 

	try {

        // FIRST: Connect to the database

        $connection = new PDO($dsn, $username, $password, $options);

		

        // SECOND: Create the SQL 

        $sql = "SELECT * FROM costs";

        

        // THIRD: Prepare the SQL

        $statement = $connection->prepare($sql);

        $statement->execute();

        

        // FOURTH: Put it into a $result object that we can access in the page

        $result = $statement->fetchAll();
      



	} catch(PDOException $error) {

        // if there is an error, tell us what it is

		echo $sql . "<br>" . $error->getMessage();

	}	

}

?>


<?php  

    if (isset($_POST['submit'])) {

        //if there are some results

        if ($result && $statement->rowCount() > 0) { ?>



<?php 

                // This is a loop, which will loop through each result in the array
            $sum = 0;
                foreach($result as $row) { 
                    $sum+= $row[2];
                    
            ?>
<?php 

            // this willoutput all the data from the array

            //echo '<pre>'; var_dump($row); 

        ?>

<hr>

<?php }; //close the foreach

        }; 

    }; 

?>

<h1> Total spendings: <?php echo $sum; ?></h1>
    

<form method="post">



    <input type="submit" name="submit" value="Show budget">



</form>





<?php include "template/footer.php"; ?>