<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Password Reset | Cast Solution</title>
  
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
  <link rel="stylesheet" href="css/reset_password.css">

  
</head>

<header> 
<img id="logo" src="LOGO-01.png" style='width:100%;' border="0" alt="Null"/>

<!--<img id="logo" src="LOGO-01.png"/></header>-->
  <body>
	<div class="login">
		<div class="login-screen">
			<div class="login-title">
				<h1>Password Reset</h1>
				<p>Enter your email, and we'll send you instructions on how to reset your password.</p>
			</div>

            <form action="function-modified.php" method="POST">
			<div class="reset-form">
				
				<div class="input-group">
				<input type="email" class="reset-email" name="email" placeholder="Email" id="email-name" required><br><br>
				<input type="text" class="reset-user" name="username" placeholder="Username" id="reset-username" required><br><br>
				 <input class="btn"  type="submit" value="Forget" name="forget" />
				<!-- <label class="label-reset-email" for="reset-pass"></label> -->
				</div>
				
                </div></form>
		</div>
	</div>
	  
	  <footer> <P id="copy"> &copy; 2017 Cast Solutions   </P> </footer>
</body>
  
  

</html>
