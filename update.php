<?php 
    // include the config file that we created before

    require "../config.php"; 
    require "../common.php";
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

?>

<div>

<h2>Edit an item</h2>

<?php 

                // This is a loop, which will loop through each result in the array

                foreach($result as $row) { 

            ?>
<p>

    ID:

    <?php echo $row["id"]; ?><br> Expense:

    <?php echo $row['expense']; ?><br> Cost:

    <?php echo $row['cost']; ?><br> Reason:

    <?php echo $row['reason']; ?><br>
    <a href='update-work.php?id=<?php echo $row['id']; ?>'>Update expense</a>
</p>

<?php 

            // this willoutput all the data from the array

            //echo '<pre>'; var_dump($row); 

        ?>


<?php }; //close the foreach

        ; 

    ; 

?>
</div>

<?php include "template/footer.php"; ?>