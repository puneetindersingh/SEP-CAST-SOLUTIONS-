<!DOCTYPE html>
<html>
    
<head>
  <meta charset="UTF-8">
  <title>Login | Cast Solution</title>
  
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
  <link rel="stylesheet" href="css/login_style.css">

  
</head>

<!-- 	header -->
 <header> 

<img id="logo" src="LOGO-01.png"/>
	
</header>
  <body>
	<div class="login">
		<div class="login-screen">
			<div class="login-title">
				<h1>Login</h1>
			</div>
             <form action="function-modified.php" method="POST" >
			<div class="login-form">
				<div class="input-group">
				<input type="text" class="login-field" name="username" placeholder="username" id="login-name" required>
				<label class="login-field-icon fui-user" for="login-name"></label>
				</div>

				<div class="input-group">
				<input type="password" class="login-field" name="password" placeholder="password" id="login-pass" required>
				<label class="login-field-icon fui-lock" for="login-pass"></label>
				</div>

                <input class="btn"  type="submit" value="Login" name="login" />
				<!--<a class="btn" href="#" type="submit" name="login" >login</a>-->
				<a class="resetPassword-link" href="resetpassword.php">Forgot your password?</a>
			</div>
            </form>
		</div>
	</div>
</body>
  
<!--   footer -->
<footer> <P id="copy"> &copy; 2017 Cast Solutions   </P> </footer>
</html>
