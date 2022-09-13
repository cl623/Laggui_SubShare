<!DOCTYPE html>
<html>
    <head>
        <title> Create Account </title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body class=login-body>
        <div class="centerbox">
            <div class="login">
                <h1>Sign Up</h1>
                <h4>Create an Account to get started with SubShare!</h4>
                <form action="createlogin.php" method="post" id="signup">
		    <div class="form-field">
			<div class="tipped">
                        <label for="uname"> Username </label>
                        <input type="text" id="uname" name="uname">
			<alert></alert>
			</div>
                    </div>
                    <div class="form-field">
                        <label for="pass"> Password </label>
                        <div class="on-focus tipped">
                            <input type="password" id="pass" name="password">
                            <div class="tool-tip slideIn right">Atleast one of each of the following:
                                    <ul>
                                        <li>Special</li>
                                        <li>Uppercase</li>
                                        <li>Lowercase</li>
                                        <li>Number</li>
                                    </ul>
                            </div>
                        </div>
                        <a style="float: right; cursor: pointer;" onclick="showPass()" ><span class="material-icons">visibility</span></a>
                        <alert></alert>
                    </div>
		    <div class="form-field">
			<div class="tipped">
                        <label for="retype"> Re-Enter Password </label>
                        <input type="password" id="retype">
			<alert></alert>
			</div>
                    </div>
		    <div class="form-field">
			<div class="tipped">
                        <label for="email"> Email Address </label>
                        <input type="text"  id="email" name="email">
			<alert></alert>
			</div>
                    </div>
                    <button type="submit"> Create Account </button>
                </form>
            </div>
        </div>
	<alert></alert>
	<p class="error"> <?php echo $_GET['error']; ?></p>
        <script src="js/app.js"></script>
    </body>
</html>
