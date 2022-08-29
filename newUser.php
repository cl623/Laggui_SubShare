<!DOCTYPE html>
<html>
    <head>
        <title> Create Account </title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
	<section>
	    <h1>Sign Up</h1>
	    <h4>Create an Account to get started with SubShare!</h4>
            <form action="createlogin.php" method="post" id="signup">
                <div class="form-field">
                    <label for="user"> Username: </label>
		    <input type="text" id="user" name="uname" placeholder="Username">
                    <alert></alert>
                </div>
                <div class="form-field">
                    <label for="pass"> Password (5 Characters minimum): </label>
                    <input type="password" id="pass" name="password" placeholder="!1abc">
                    <alert></alert>
                </div>
                <div class="form-field">
                    <label for="retype"> Retype Password: </label>
                    <input type="password" id="retype"> 
                    <alert></alert>
                </div>
                <div class="form-field">
                    <label for="email"> Email Address: </label>
                    <input type="text"  id="email" name="email" placeholder="example@mail.com">
                    <alert></alert>
                </div>

                <button type="submit"> Create Account </button>
            </form>
        </section>
	<alert></alert>
	<p class="error"> <?php echo $_GET['error']; ?></p>
        <script src="js/app.js"></script>
    </body>
</html>
