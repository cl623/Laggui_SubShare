<!-- TITLE REPLACE IN header.php-->
<?php 
    session_start();

    $title = "Friends";
    include("common/header.php");
?>

    <h3>Friends</h3>
    <a>Add friends<span class="material-icons">add</span></a>

    <table id="friends">
        <tr>
            <th></th>
            <th>Name</th>
        </tr>
        <?php 
        try{
            $sql = "SELECT * FROM users WHERE users.id IN (
                        (SELECT requesterID FROM friendshipStatus WHERE addresseeID = ?)
                        UNION
                        (SELECT addresseeID FROM friendshipStatus WHERE requesterID = ?)
                    )";
            $statement = $conn->prepare($sql);
            $success = $statement->execute(array($_SESSION['id'], $_SESSION['id']));
        }
        catch(PDOException $error){
            header("Location: friends.php?error=Unable to connect to DB:".$error->getMessage());
            exit();
        }
        
        if($success){
            $data = $success->fetchAll();

            foreach($data as $row){
                echo "<tr>";
                echo "<td>".$row['name']."<span class='tableUserName'>".$row['username']."</span></td>";
                echo "</tr>";
            }
        }
    ?>
    </table>

<?php include("common/footer.php"); ?>

