<?php
    require "db_conn.php";
    session_start();

    $action = json_decode($_POST['action']);
    $uname = json_decode($_POST['uname']);
    $id = $_SESSION['id'];
    try{
        if($action == 'add'){
            $sql = "UPDATE friendships SET friendshipstatus = 'a' WHERE requesterID = (SELECT id FROM users WHERE username = :uname) AND addresseeID = :id";
            $statement = $conn->prepare($sql);
            $success = $statement->execute(['uname'=>$uname, 'id'=>$id]);
        }
        elseif($action == 'deny'){
            $sql = "UPDATE friendships SET friendshipstatus = 'b' WHERE requesterID = (SELECT id FROM users WHERE username = :uname) AND addresseeID = :id";
            $statement = $conn->prepare($sql);
            $success = $statement->execute(['uname'=>$uname, 'id'=>$id]);
        }
    }
    catch(PDOException $error){
        header("Location: friends.php?error=Unable to connect to DB: ".$error->getMessage());
        exit();
    }
    if($success && $action == "add"){
        echo "Added ".$uname;
    }
    elseif($success && $action == "deny"){
        echo "Blocked ".$uname;
    }
    else{
        echo "Fail";
    }
    return();
?>