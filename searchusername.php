<?php 
	require "db_conn.php";

    $d = json_decode($_POST['data']);
    $id = json_decode($_POST['id']);

    //Default Fail response.
    $fail = "Unsuccessful. Make sure their phone number, email, or username is correct.";

    // Function to change SQL Query statement per lookup
    function validate($data, $uid){

        //  Trim leading && trailing whitespaces;
        $data = trim($data);

        //  Check if user searched by phone number. 
        //  (xxx)-xxx-xxx;
        if(preg_match('/^\([0-9]{3}\)-[0-9]{3}-[0-9]{4}$',$data)){
                $fail = "Unsuccessful. Please make sure their phone number correct.";
                //$q =  "SELECT name, id FROM users WHERE phone = '".$data."'";
                $q = "SELECT id, name FROM users WHERE id NOT IN ((SELECT requesterID FROM friendship WHERE addresseeID = '".$uid."') UNION (SELECT addresseeID FROM friendship WHERE requesterID = '".$uid."')) AND phone = '".$data."' AND NOT id = '".$uid."'";  
            return $q;
        }
            elseif(filter_var($data, FILTER_VALIDATE_EMAIL)){
                $fail = "Unsuccessful. Please make sure their email correct.";
                //$q = "SELECT name, id FROM users WHERE email = '".$data."'";
                $q = "SELECT id, name FROM users WHERE id NOT IN ((SELECT requesterID FROM friendship WHERE addresseeID = '".$uid."') UNION (SELECT addresseeID FROM friendship WHERE requesterID = '".$uid."')) AND email = '".$data."' AND NOT id = '".$uid."'";
            return $q;
        }
            elseif(preg_match('/^[a-z0-9]*$/i', $data)){
                $fail = "Unsuccessful. Please make their username is correct.";
                //$q = "SELECT name, id FROM users WHERE username = '".$data."'";
                $q = "SELECT id, name FROM users WHERE id NOT IN ((SELECT requesterID FROM friendship WHERE addresseeID = '".$uid."') UNION (SELECT addresseeID FROM friendship WHERE requesterID = '".$uid."')) AND username = '".$data."' AND NOT id = '".$uid."'";  
            return $q;
        }
        else{
            echo json_encode("Error, unable to validate query");
            exit();
        }
    }
    //  Connect to DB and attempt Query
    try{
	        $sql = validate($d, $id);
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
    //return();
    
    //$sql = "INSERT INTO friendship (requesterID, addresseeID) VALUES ($_POST['id'], (SELECT id FROM users WHERE username = $_POST['username']))"

?>
