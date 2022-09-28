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
                $sql = "SELECT users.name, users.username FROM users WHERE users.id IN ((SELECT requesterID FROM friendship WHERE addresseeID = ? AND friendshipstatus = 'a') UNION (SELECT addresseeID FROM friendship WHERE requesterID = ? AND friendshipstatus = 'a'))";
            
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
                <h2>Add a friend</h2>
            </div>
            <div class="modal-body">
                <form id="addFriends" action="searchusername.php" class="searchbox" method="post">
                    <input type="text" name="searchuname" id="searchuname" placeholder="Search username...">
                    <button type="submit"><span class="material-icons">search</span><button>
                </form>
            </div>
            <div class="modal-footer">
                <span class="error"><?php echo $_GET['error']?></span>
                <span id="postData"></span>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <script src="js/modal.js"></script>

    <script>
        $("#addFriends").submit(function(e){
            e.preventDefault();
            $.ajax({
                type:"POST",
                url: "../searchusername.php",
                data: {data: JSON.stringify($("#searchuname").val())
                    /*, id: <?php// echo json_encode($_SESSION['id'])?>*/
                },
                cache: false,
                success: function(response){
                $("#postData").html(response);
                }
            });
        });
    </script>

<?php include("common/footer.php"); ?>

