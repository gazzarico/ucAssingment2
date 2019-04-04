<?php
if (isset($_POST['submit'])) {

// include the config file that we created before
    require "../config.php"; 

    try {
            $connection = new PDO($dsn, $username, $password, $options);
                
    $new_expense = array( 
    "expense"    => $_POST['expense'], 
    "cost"     => $_POST['cost'],
    "reason"      => $_POST['reason'],
    );
    
    $sql = "INSERT INTO costs (
        expense,
        cost,
        reason
    ) VALUES (
        :expense,
        :cost,
        :reason
    )"; 

    $statement = $connection->prepare($sql);
    $statement->execute($new_expense);

    }
        catch (PDOException $error) {
            // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
    }
}

?>

    

    <h1>Add new expense</h1>

    <?php if (isset($_POST['submit']) && $statement) { ?>

    <p>Expense added.</p>
    

    <?php } ?>
    <div>
        
    <form method="post">

    <label for="Expense">Expense</label>

    <input type="text" name="expense" id="expense">

    <label for="Cost">Cost</label>

    <input type="text" name="cost" id="cost">

    <label for="Reason">Description</label>

    <input type="text" name="reason" id="reason">

        
    <input type="submit" name="submit" value="Submit">


</form>
        
</div>
        
        <?php include "template/footer.php"; ?>