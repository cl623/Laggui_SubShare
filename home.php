<!-- TITLE REPLACE IN header.html-->
<?php 
    session_start();

    ob_start();
    include("html/header.html");
    $buffer=ob_getcontents();
    ob_end_clean();

    $buffer=str_replace("%TITLE%", "Homepage", $buffer);
    echo $buffer;
?>
<!-- CHANGE HEADER DEPENDING ON USER -->
            <?if(isset($_SESSION['name']) && $_SESSION['name'] != 'YOUR NAME HERE'){?>
	            <h1> Welcome back, <?= $_SESSION['name']?> </h1>

                <?}elseif(isset($_SESSION['username'])){?>

                <h1> Welcome back, <?= $_SESSION['username']?> </h1>   
 
                    <?php
                        }else{
                            header("Location: login.php");
                            exit(); 
                        }?>
                <a href="logout.php">Logout</a>

<!-- INCLUDE FOOTER -->
<?php include("html/footer.html"); ?>

