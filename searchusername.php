<?php 

    echo json_encode($_POST['searchuname']);

    /*$fail = "Unsuccessful. Make sure their phone number, email, or username is correct.";
    $phonePattern = "/^[0-9]{10,11}+$/"; //10 - 11 numbers in cases where users include country code;
    $usernamePattern = "/^[a-z0-9]*$/i";

    function validate($data){
        if(preg_match($data, $phonePattern)){
            $fail = "Unsuccessful. Please make sure their phone number correct.";
            return "SELECT name, id FROM users WHERE phone = $data";
        }
        elseif(filter_var($data, FILTER_VALIDATE_EMAIL)){
            $fail = "Unsuccessful. Please make sure their email correct.";
            return "SELECT name, id FROM users WHERE email = $data";
        }
        elseif(preg_match($data, $usernamePattern)){
            $fail = "Unsuccessful. Please make their username is correct.";
            return "SELECT name, id FROM users WHERE username = $data";
        }
    }
     
    try{
	    $sql = "SELECT * FROM users"
	    //$sql = validate($_POST['searchuname']);
            $statement = $conn->prepare($sql);
            $success = $statement->execute();
    }
    catch(PDOException $error){
        header("Location: friends.php?error=Unable to connect to DB:".$error->getMessage());
        exit();
    }
        
    if($success){
        $data = $statement->fetchAll();
        echo json_encode($data);
    }
    else{
        echo json_encode($fail);
    }
    */
    //$sql = "INSERT INTO friendship (requesterID, addresseeID) VALUES ($_POST['id'], (SELECT id FROM users WHERE username = $_POST['username']))"

?>
