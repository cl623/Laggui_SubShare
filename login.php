<!DOCTYPE html>
<html>
    <head>
        <title> Login </title>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body class="login-body">
        <div>
            <div class="centerbox">
                <div class="login">
                    <h2><b>Login</b></h2>
		    <form action="performlogin.php" method="post">
			<label for="uname"> Username: </label>
                        <input type="text" name="uname">
			<br>
			<label for"password"> Password </label>
                        <input type="text" name="password">
                        <br>
                        <br>
                        <button type="submit"> Login </button>
                    </form>
                </div>
            </div>
            <div class="centerbox">
                <div>
                    <form action="newUser.php" method="post">
                        <p>New to SubShare?
                            <br>
                            Create an account now!
                        </p>
                        <button href="newUser.php"> Sign Up </button>
                    </form>
                </div>
                <div>
                    <?php if(isset($_GET['error'])){ ?>
                        <p class="error"> <?php echo $_GET['error']; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>
