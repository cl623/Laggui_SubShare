<?php
    require "db_conn.php";
    session_start();

    //   Variables for the query
    $data = [
        'uname' => json_decode($_POST['uname']),
        'id' => $_SESSION['id'],
        'status' => 'p',
    ];

    //   Create connection and query
    try{
	        $sql = "INSERT INTO friendship (requesterID, addresseeID, friendshipstatus) VALUES (:id, (SELECT id FROM users WHERE username = :uname), :status)";
            $statement = $conn->prepare($sql);
            $success = $statement->execute($data);
    }
    catch(PDOException $error){
        header("Location: friends.php?error=Unable to connect to DB:".$error->getMessage());
        exit();
    }

    if($success){
        echo "Friend Request Sent";
    }
    else{
        echo "Unable to send friend request..";
    }

?>