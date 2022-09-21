<!-- TITLE REPLACE IN header.php-->
<?php 
    session_start();

    $title = "Friends";
    include("common/header.php");
    require "db_conn.php";
?>

<?php //echo "<p>".$_SESSION['id']."</p>"?>

    <h3>Friends</h3>
    <a>Add friends<span class="material-icons">add</span></a>

    <table id="friends">
        <tr>
            <th>Name</th>
            <th>Username</th>
        </tr>
        <?php 
        try{
           $sql = "SELECT users.name, users.username FROM users WHERE users.id IN ((SELECT requesterID FROM friendship WHERE addresseeID = ?) UNION (SELECT addresseeID FROM friendship WHERE requesterID = ?))";
	   
	   // $sql = "SELECT requesterID FROM friendship WHERE addresseeID = ? UNION SELECT addresseeID FROM friendship WHERE requesterID =?";
            $statement = $conn->prepare($sql);
            $success = $statement->execute(array($_SESSION['id'], $_SESSION['id']));
        }
        catch(PDOException $error){
            header("Location: friends.php?error=Unable to connect to DB:".$error->getMessage());
            exit();
        }
        
        if($success){
            $data = $statement->fetchAll();

            foreach($data as $row){
                echo "<tr>";
                echo "<td>".$row['name']."</td><td><span class='tableUserName'>".$row['username']."</span></td>";
                echo "</tr>";
	    }
	//	echo "<tr><td>".var_dump($data)."</td></tr>";
	}
	else{
	   echo "<tr><td>fail</td></tr>";
	}
    ?>
    </table>
    <p class="error"><?php echo $_GET['error'];?></p>
<?php include("common/footer.php"); ?>

