<?php
    require "db_conn.php";
    session_start();

    $action = $_POST['action'];
    $uname = $_POST['uname'];
    $id = $_SESSION['id'];

    try{
        if($action == 'add'){
            $sql = "UPDATE friendship SET friendshipstatus = 'a' WHERE requesterID = (SELECT id FROM users WHERE username = :uname) AND addresseeID = :id";
            $statement = $conn->prepare($sql);
            $success = $statement->execute(['uname'=>$uname, 'id'=>$id]);
        }
        elseif($action == 'deny'){
            $sql = "UPDATE friendship SET friendshipstatus = 'b' WHERE requesterID = (SELECT id FROM users WHERE username = :uname) AND addresseeID = :id";
            $statement = $conn->prepare($sql);
            $success = $statement->execute(['uname'=>$uname, 'id'=>$id]);
	    }
        else{
            throw new Exception('Invalid Action');
        }
    }
    catch(PDOException $error){
        header("Location: friends.php?error=Unable to connect to DB: ".$error->getMessage());
        exit();
    }
    if($success && $action == "add"){
        echo "Added";
    }
    elseif($success && $action == "deny"){
        echo "Blocked";
    }
    else{
        echo "Fail";
    }
?>
