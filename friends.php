<!-- TITLE REPLACE IN header.php-->
<?php 
    session_start();

    $title = "Friends";
    include("common/header.php");
    require "db_conn.php";
?>

    <h3>Friends</h3>


    <div class="main-content">
        <a onclick="openModal()">Add a friend<span class="material-icons">add</span></a>
            <table id="friends" class="table-friends">
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
        </div>
    </div>
    <p class="error"><?php echo $_GET['error'];?></p>
        <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Modal Header</h2>
            </div>
            <div class="modal-body">
                <p>Some text in the Modal Body</p>
                <p>Some other text...</p>
            </div>
            <div class="modal-footer">
                <h3>Modal Footer</h3>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <script src="js/modal.js"></script>
<?php include("common/footer.php"); ?>

