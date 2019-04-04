<?php 



// this code will only execute after the submit button is clicked

if (isset($_POST['submit'])) {

	

    // include the config file that we created before

    require "../config.php"; 
    //require "../common.php";
    

    //try to connect to the database. 

	try {
		

        //Get the contents of the form and store it in an array

        $login = array( 

            "username" => $_POST['username'], 

            "password" => $_POST['password'], 

        );
            
        //connect to the database using user credentials.

        $connection = new PDO($dsn, $login['username'], $login['password'], $options);

        //if connects it will open the homepage otherwise throw an error message.
        header ('location: home.php');


	} catch(PDOException $error) {
        // if there is an error, tell us what it is

		echo $error->getMessage();
		

	}	

}

?>

<!--form to collect data for user login-->
<div>

<form method="post">

    <label for="username">User Name</label>

    <input type="text" name="username" id="username">


    <label for="password">Password</label>

    <input type="text" name="password" id="password">


    <input type="submit" name="submit" value="login">

    <!--this form is to collect a username and password.-->
    
    <p>help me obi wan kenobi!</p>

</form>
</div>