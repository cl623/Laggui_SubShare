<!DOCTYPE html>
<html>
    <head>
        <title> Login </title>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
            <h1>ShareSub</h1>
            <h3>Welcome to ShareSub! Coordinate sharing subscription based platforms with your friends and family easily!</h3>
        <div class="nav">
                <div>
                    <h2><b>Login</b></h2>
                    <form action="performlogin.php" method="post">
                        <p>Username:</p>
                        <input type="text" name="uname" placeholder="Username">
                        <br>
                        <p>Password:</p>
                        <input type="text" name="password" placeholder="!1Abcd">
                        <br>
                        <br>
                        <button type="submit"> Login </button>
                    </form>
                </div>
                <div>
                    <form action="newUser.php" method="post">
                        <p>New to SubShare?
                            <br>
                            Create an account here!
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
    </body>
</html>
