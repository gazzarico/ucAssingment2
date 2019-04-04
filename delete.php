<?php 
    // include the config file that we created before
    require "../config.php"; 
    require "../common.php"; 

     if (isset($_GET["id"])) {
	    // this is called a try/catch statement 
        try {
            // define database connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set id variable
            $id = $_GET["id"];
            
            // Create the SQL 
            $sql = "DELETE FROM costs WHERE id = :id";

            // Prepare the SQL
            $statement = $connection->prepare($sql);
            
            // bind the id to the PDO
            $statement->bindValue(':id', $id);
            
            // execute the statement
            $statement->execute();

            // Success message
            $success = "Expense successfully deleted";

        } catch(PDOException $error) {
            // if there is an error, tell us what it is
            echo $sql . "<br>" . $error->getMessage();
        }
    };

    // This code runs on page load
    try {
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM costs";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }



<div>

<h2>Delete an expense</h2>
<br>
<?php 

                // This is a loop, which will loop through each result in the array

                foreach($result as $row) { 

            ?>
<p>
    
     Expense:


  <?php echo $row['expense']; ?><br> Cost $:
  <?php echo $row['cost']; ?><br> Description:
  <?php echo $row['reason']; ?><br>
    
    <a href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a>
    
</p>
        
   
<?php 

            // this willoutput all the data from the array. I am not sure what the benefit of this is.

            //echo '<pre>'; var_dump($row); 

        ?>


<?php }; //close the foreach

        ; 

    ; 

?>

</div>

<?php include "template/footer.php"; ?>