<?php 
	require "db_conn.php";

    $d = json_decode($_POST['data']);

    $fail = "Unsuccessful. Make sure their phone number, email, or username is correct.";
    $phonePattern = "/^[0-9]{10,11}+$/"; //10 - 11 numbers in cases where users include country code;
    $usernamePattern = "/^[a-z0-9]*$/i";

    function validate($data){
	/*if($data == "claggui"){
		$q =  "SELECT name FROM users WHERE username = '".$data."'";
		return $q;
    }*/
	if(preg_match('/^\([0-9]{3}\)-[0-9]{3}-[0-9]{4}$',$data)){
            $fail = "Unsuccessful. Please make sure their phone number correct.";
            $q =  "SELECT name, id FROM users WHERE phone = '".$data."'";
		return $q;
	}
        elseif(filter_var($data, FILTER_VALIDATE_EMAIL)){
            $fail = "Unsuccessful. Please make sure their email correct.";
            $q = "SELECT name, id FROM users WHERE email = '".$data."'";
		return $q;
	}
        elseif(preg_match('/^[a-z0-9]*$/i', $data)){
            $fail = "Unsuccessful. Please make their username is correct.";
            $q = "SELECT name, id FROM users WHERE username = '".$data."'";
		return $q;
	}
	else{
	    echo json_encode("Error, unable to validate query");
	    exit();
	}
    }

    try{
	    
	   // $sql = "SELECT name FROM users WHERE username = 'claggui'";
	    $sql = validate($d);
            $statement = $conn->prepare($sql);
            $success = $statement->execute();
    }
    catch(PDOException $error){
        header("Location: friends.php?error=Unable to connect to DB:".$error->getMessage());
        exit();
    }
        
    if($success){
        $result = $statement->fetchAll();
        echo json_encode($result);
    }
    else{
        echo json_encode($fail);
    }
 
    //$sql = "INSERT INTO friendship (requesterID, addresseeID) VALUES ($_POST['id'], (SELECT id FROM users WHERE username = $_POST['username']))"

?>
