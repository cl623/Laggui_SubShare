<!-- TITLE REPLACE IN header.php-->
<?php 
    session_start();

    $title = "Homepage";
    include("common/header.php");
?>
<!-- CHANGE HEADER DEPENDING ON USER -->
            <?php if(isset($_SESSION['name']) && $_SESSION['name'] != 'YOUR NAME HERE'){?>
	            <h1> Welcome back, <?= $_SESSION['name']?> </h1>

                <?php }elseif(isset($_SESSION['username'])){?>

                <h1> Welcome back, <?= $_SESSION['username']?> </h1>   
 
                    <?php
                        }else{
                            header("Location: logout.php");
                            exit(); 
                        }?>
                <a href="logout.php">Logout</a>

<!-- INCLUDE FOOTER -->

<?php include("common/footer.php"); ?>

