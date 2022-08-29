<?php
    session_start();
    require "db_conn.php";

    function validate($data){
        $data = trim($data);
        return $data;
    }
    
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $email = validate($_POST['email']);
    
    $data = [
	'uname' => $uname,
	'pass' => $pass,
	'email' => $email
    ];

//	header("Location: newUser.php?error=createlogin reached");

    try{
        $sql = "INSERT INTO users (username, password, email) VALUES (:uname, :pass, :email)";

        $statement = $conn->prepare($sql);
        $success = $statement->execute($data);
    }
    catch(PDOExceoption $error){
        header("Location: newUser.php?error=Unable to create account:".$error->getMessage());
        exit();
    }
    if($success){
        echo "Redirecting...";
        $_SESSION['username'] = $uname;
//        $_SESSION['name'] = $name;
        $_SESSION['password'] = $pass;
        header("Location: home.php");
	
//	header("Location: newUser.php?error=Connected");
	exit();
    }
    else{
        header("Location: newUser.php?error=Unable to create account.")
    	exit();
   }
?>
