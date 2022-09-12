<!DOCTYPE html>
<html>
    <head>
	<title> Login </title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body class="login-body">
        <div>
            <div class="centerbox">
                <div class="login">
                    <h2><b>Login</b></h2>
                    <form action="performlogin.php" method="post">
                        <label for="uname"> Username </label>
                        <input type="text" name="uname">
                        <br>
                        <div class="on-focus tipped">
                            <label for="password"> Password </label>
                            <input type="text" name="password">
                            <div class="tool-tip slideIn right">Atleast one of each of the following:
                                <ul>
                                    <li>Special</li>
                                    <li>Uppercase</li>
                                    <li>Lowercase</li>
                                    <li>Number</li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <br>
                        <button type="submit">Log In</button>
                    </form>
                    <div>
                        <?php if(isset($_GET['error'])){ ?>
                            <p class="error"> <?php echo $_GET['error']; ?></p>
                        <?php } ?>
                    </div>
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
            </div>
        </div>
    </body>
</html>
