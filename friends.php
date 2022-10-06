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
        <table id="pendingFriends" class="table-friends">
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <?php
    		try{
                    $sql = "SELECT name, username FROM users WHERE id IN (SELECT requesterID FROM friendship WHERE addresseeID = ? AND friendshipstatus = 'p')";
		            $statement = $conn->prepare($sql);
                    $success = $statement->execute([$_SESSION['id']]);
                }
                catch(PDOException $error){
                    header("Location: friends.php?error=Unable to retrieve incoming friend requests: ".$error->getMessage());
                    exit();
                }
                if($success){
                    $data = $statement->fetchAll();
                    foreach($data as $row){
                        echo "<tr class='friendRow'>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td><span class='tableUserName'>".$row['username']."</span></td>";
                        echo "<td><span class='material-icons' data-friendName='".$row['username']."' onclick='acceptRequest(this)'>person_add_alt_1</span><span class='material-icons' data-friendName='".$row['username']."' onclick='denyRequest(this)'>block</span></td>";
                        echo "</tr>";
                    }
                }
                else{
                    echo "<tr><td>Failed pending requests</td></tr>";
                }
            ?>
        </table>
        <table id="friends" class="table-friends">
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th style="width: 20px;">Action</th>
            </tr>

            <?php 
                //   PHP script to retrieve friendslist.
                try{
                    $sql = "SELECT users.name, users.username FROM users WHERE users.id IN ((SELECT requesterID FROM friendship WHERE addresseeID = ? AND friendshipstatus = 'a') UNION (SELECT addresseeID FROM friendship WHERE requesterID = ? AND friendshipstatus = 'a'))";
                    $statement = $conn->prepare($sql);
                    $success = $statement->execute(array($_SESSION['id'], $_SESSION['id']));
                }
                catch(PDOException $error){
                    header("Location: friends.php?error=Unable to connect to DB:".$error->getMessage());
                    exit();
                }
                //   If connection and query are successful do:
                if($success){
                    $data = $statement->fetchAll();
                    //   Serve HTML content per Friend returned:
                    foreach($data as $row){
                        echo "<tr class='friendRow'>";
                            echo "<td>".$row['name']."</td><td><span class='tableUserName'>".$row['username']."</span></td>";
                            echo "<td>";
                                echo "<div data-friendName='".$row['username']."' class='dropdown'>";
                                    echo "<button onclick='listFriendActions(\"".$row['username']."Dropdown\")' class='dropbtn'>";
                                        echo "<span class='material-icons'>view_headline</span>";
                                    echo "</button>";
                                    echo "<div id='".$row['username']."Dropdown' class='dropdown-content'>";
                                        //echo "<a href='".$row['uname']."/profile'>View Profile</a>";
                                        //echo "<a href='".$row['uname']."/payments'>Pay</a>";
                                        echo "<a onclick='inviteToGroup(\"".$row['username']."\")'><span class='material-icons'>playlist_add_circle</span>Invite to Group</a>";
                                        echo "<a onclick='deleteFriend(\"".$row['username']."\")'><span class='material-icons'>no_accounts</span>Remove Friend</a>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</td>";
                        echo "</tr>";
                    }
                }
                else{
                    echo "<tr><td>fail</td></tr>";
                }
            ?>
        </table>
        </div>
    </div>
    <p class="error"><?php echo $_GET['error'];?></p>

    <!-- Add Friend Modal -->
    <div id="myModal" class="modal">
        <!-- Add Friend Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Add a friend</h2>
            </div>
            <div class="modal-body">
                <form id="addFriends" action="searchusername.php" class="searchbox" method="post">
                    <input type="text" name="searchuname" id="searchuname" placeholder="Enter Username/Phone/Email...">
                    <button type="submit"><span class="material-icons">search</span></button>
                    <span id="postData"></span>
                </form>
            </div>
            <div class="modal-footer">
                <span class="error"><?php echo $_GET['error']?></span>
            </div>
        </div>
    </div>
    <!-- End Add Friend Modal -->

    <!-- Delete Friend Modal -->
    <div id="unfriendModal" class="modal">
        <!-- Delete Friend Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Confirm Unfriend</h2>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to unfriend <span id=friendName></span></p>
                <button id="confirmDelete()" onclick="confirmDelete()">Confirm</button><button onclick="closeModal()">Cancel</button>
            </div>
            <div class="modal-footer">
                <span class="error"><?php echo $_GET['error']?></span>
            </div>
        </div>
    </div>
    <!-- End Delete Friend Modal -->

    <script src="js/modal.js"></script>
    <script src="js/friends.js"></script>

<?php include("common/footer.php"); ?>

