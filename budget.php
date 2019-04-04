<?php 
require "../config.php"; 

//the variables are used to calculate the budget costings.
$sum = 0;
$budget =0;
$remaining =0;

	try {

        //Connect to the database

        $connection = new PDO($dsn, $username, $password, $options);
		

        //Create the SQL 

        $sql = "SELECT * FROM costs";
 
        
        //Prepare the SQL

        $statement = $connection->prepare($sql);

        $statement->execute();

        //Put it into a $result object that we can access in the page

        $result = $statement->fetchAll();
      

	} catch(PDOException $error) {

        // if there is an error, tell us what it is

		echo $sql . "<br>" . $error->getMessage();

	}	

?>

<?php  

        if ($result && $statement->rowCount() > 0) { ?>


<?php 

                // This is a loop, which will loop through each result in the array and add the costs together.
           // $sum = 0;
                foreach($result as $row) { 
                    $sum+= $row[2];
                    
            ?>
<?php 

            // this willoutput all the data from the array

            //echo '<pre>'; var_dump($row); 

        ?>


<?php }; //close the foreach

        }; 

     

?>

<div>
<h1>Budget page</h1>

<p>Below are the details of the spent budget and the <br>
remaining $$$$ to stay withing the budget.</p>

<h2> Total spendings: $<?php echo $sum; ?></h2>
<br>
    <h2>Set the budget below:</h2>
    <br>
   <?php 
        if (isset($_POST['submit'])) {
        $budget   = $_POST['budget'];    
        $remaining = $budget - $sum;
            }

?>
    <form method="post">

    <label for="budget">Budget $</label>

    <input type="text" name="budget" value= "$$$">

        <br>


    <input type="submit" name="submit" value="Set Budget">


</form>
<br>
    <h1>Budget remaining is $<?php echo htmlspecialchars($remaining); ?> </h1>

    
</div>
    

<?php include "template/footer.php"; ?>