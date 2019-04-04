<?php 



    // include the config file that stores the connection details.

    require "../config.php";

    //common is needed to get special characters.

    require "../common.php";



    // run when submit button is clicked

    if (isset($_POST['submit'])) {

        try {

            $connection = new PDO($dsn, $username, $password, $options);  

            

            //grab elements from form and set as varaible

            $spendings =[

              "id"         => $_POST['id'],

              "expense" => $_POST['expense'],

              "cost"  => $_POST['cost'],

              "reason"   => $_POST['reason'],

              "date"   => $_POST['date'],

            ];

            

            // create SQL statement

            $sql = "UPDATE `costs` 

                    SET id = :id, 

                        expense = :expense, 

                        cost = :cost, 

                        reason = :reason, 

date = :date 

                    WHERE id = :id";



            //prepare sql statement

            $statement = $connection->prepare($sql);

            

            //execute sql statement

            $statement->execute($spendings);



        } catch(PDOException $error) {

            echo $sql . "<br>" . $error->getMessage();

        }

    }



    // GET data from DB

    //simple if/else statement to check if the id is available

    if (isset($_GET['id'])) {

        //yes the id exists 

        

        try {

            // standard db connection

            $connection = new PDO($dsn, $username, $password, $options);

            

            // set if as variable

            $id = $_GET['id'];

            

            //select statement to get the right data

            $sql = "SELECT * FROM costs WHERE id = :id";

            

            // prepare the connection

            $statement = $connection->prepare($sql);

            

            //bind the id to the PDO id

            $statement->bindValue(':id', $id);

            

            // now execute the statement

            $statement->execute();

            

            // attach the sql statement to the spendings variable so we can access it can be accessed in the form.

            $spendings = $statement->fetch(PDO::FETCH_ASSOC);

            

        } catch(PDOExcpetion $error) {

            echo $sql . "<br>" . $error->getMessage();

        }

    } else {

        // no id, show error

        echo "No id - something went wrong";

        //exit;

    };



?>



<?php if (isset($_POST['submit']) && $statement) : ?>

	<p>Expense successfully updated.</p>

<?php endif; ?>

<div>

<h2>Edit a costing</h2>



<form method="post">

    

    <label for="id">ID</label>

    <input type="text" name="id" id="id" value="<?php echo escape($spendings['id']); ?>" >

    

    <label for="expense">expense</label>

    <input type="text" name="expense" id="expense" value="<?php echo escape($spendings['expense']); ?>">



    <label for="cost">cost $</label>

    <input type="text" name="cost" id="cost" value="<?php echo escape($spendings['cost']); ?>">



    <label for="reason">description</label>

    <input type="text" name="reason" id="reason" value="<?php echo escape($spendings['reason']); ?>">


    

    <label for="date">date</label>

    <input type="date" name="date" id="date" value="<?php echo escape($spendings['date']); ?>">



    <input type="submit" name="submit" value="Save">



</form>

</div>

<?php include "template/footer.php"; ?>