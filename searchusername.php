<?php 
	require "db_conn.php";
    session_start();

    $data = [
        'input' => json_decode($_POST['data']),
        'uid' => $_SESSION['id'],
    ];

    $fail = "Unsuccessful. Make sure their phone number, email, or username is correct.";
 
    // Function to change SQL Query statement dependent on input
    function createQuery($d){

        //   Declare variables to return
            //  Trim leading && trailing whitespaces;
        $d = trim($d);
        global $data;
        global $fail;

        //Validate input
            //  if user searched by phone number
                //  (xxx)-xxx-xxx;
        if(preg_match('/^\([0-9]{3}\)-[0-9]{3}-[0-9]{4}$',$d)){
                $fail = "Unsuccessful. Please make sure their phone number correct.";
                $query = "SELECT username, name FROM users WHERE id NOT IN ((SELECT requesterID FROM friendship WHERE addresseeID = :uid) UNION (SELECT addresseeID FROM friendship WHERE requesterID = :uid)) AND phone = :input AND NOT id = :uid";  
                return $query;
        }
            //   if user searched by email
            elseif(filter_var($d, FILTER_VALIDATE_EMAIL)){
                $fail = "Unsuccessful. Please make sure their email correct.";
                $query = "SELECT username, name FROM users WHERE id NOT IN ((SELECT requesterID FROM friendship WHERE addresseeID = :uid) UNION (SELECT addresseeID FROM friendship WHERE requesterID = :uid)) AND email = :input AND NOT id = :uid";
                return $query;
        }
            //   if user searched by username
            elseif(preg_match('/^[a-z0-9]*$/i', $d)){
                $fail = "Unsuccessful. Please make their username is correct.";
                $query = "SELECT username, name FROM users WHERE id NOT IN ((SELECT requesterID FROM friendship WHERE addresseeID = :uid) UNION (SELECT addresseeID FROM friendship WHERE requesterID = :uid)) AND username = :input AND NOT id = :uid";  
                return $query;
        }
            //   Invalid input error
        else{
            echo json_encode($fail);
            exit();
        }
    }
    
    //  Connect to DB and attempt Query
    try{
	    $sql = createQuery($data['input']);
        $statement = $conn->prepare($sql);
        $success = $statement->execute($data);
    }
    catch(PDOException $error){
        header("Location: friends.php?error=Unable to connect to DB:".$error->getMessage());
        exit();
    }
        
    if($success && ($statement->rowCount() > 0)){
        $result = $statement->fetchAll();
        $response = "<table class='table-friends'><tr class='friendrow'><th>Name</th><th>Username</th><th>Action</th></tr><tr class='friendrow'><td><span>".$result[0]['name']."</span></td><td><span>".$result[0]['username']."</span></td><td><span class='material-icons' onclick='addFriend()' id='friend' data-friendName='".$result[0]['username']."'>person_add</span></td></tr></table>";
        echo $response;
        exit();
    }
    else{
        echo "Unable to add ".$data['input'];
        exit();
    }

    //$sql = "INSERT INTO friendship (requesterID, addresseeID) VALUES ($_POST['id'], (SELECT id FROM users WHERE username = $_POST['username']))"

?>
