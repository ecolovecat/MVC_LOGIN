<?php require_once "./layout/header.php";
include_once "./helpers/session_helper.php"; ?>


	<div class="container">
		<div class="main">
			<div class="title">
				<a href="#" class="logo_link">
					<img src="https://share-gcdn.basecdn.net/brand/logo.full.png" alt="Logo Base" class="logo">
				</a>
				<h1 class="title_text">Login</h1>
				<p class="title_message">Welcome back. Login to start working.</p>
			</div>
			<div class="content">
                
                
				<form method="post" action="./controllers/Users.php" >
                    <input type="hidden" name="type" value="login"> 
					<label for="email" class="label">Email</label><br>
					<input class="input-box" type="text" name="name/email"
					id="email" placeholder="Your email"><br>
					<div class="label-group">
						<label for="password" class="label">Password</label>
						<a href="#" class="redirect-link">Forget your password?</a>
					</div>
					<input class="input-box" type="password" name="userPwd"
					id="password" placeholder="Your password"><br>
                    <?php flash("login") ?>
					<div class="row-save">
						<input type="checkbox" name="save_login" id="save" checked>
						<label for="save" class="label-save">Keep me logged in</label>
					</div>
					<button class="btnSubmit" type="submit">Login</button>
				</form>
				<div class="out-auth">
					<span class="option_message">Or, login via single sign-on</span><br>
					<div class="btnGroup">
						<a href="#" class="btnOutAuth">Login with Google</a>
						<a href="#" class="btnOutAuth">Login with Microsoft</a>
						<a href="#" class="btnOutAuth">Login with SAML</a>
					</div>
				</div>
				<div class="btnSubmit"><a href="signup.php">Sign Up</a>	</div>
                			

			</div>
		</div>

	</div>

    


	
    <?php require_once "./layout/footer.php" ?>