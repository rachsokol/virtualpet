<?php
session_name('virtual_pet'); //unique session name
session_start();//all pages must have both lines in order to be part of the same session
require("cfd.php");
if(isset($_POST['submit'])){//they are submitting
	if($_POST['password'] == $_POST['vpassword']){//the passwords match
		$username = $_POST['username'];
		$password = $_POST['password'];
		// Create a 256 bit (64 characters) long random salt
		// Let's add 'something random' and the username
		// to the salt as well for added security
		$salt = hash('sha256', uniqid(mt_rand(), true) . 'P*Ja@VS32kd4udns%#' . strtolower($username));
		// Prefix the password with the salt
		$hash = $salt . $password;
		// Hash the salted password a bunch of times
		for($i = 0; $i < 100000; $i ++ ) {
			$hash = hash('sha256', $hash);
		}//end for
		// Prefix the hash with the salt so we can find it back later
		$hash = $salt . $hash;
		$isql = "INSERT into login(username, password) values('".$username."','".$hash."')";
		if(mysqli_query($db,$isql)){
		    //$username = $_SESSION['USERNAME'];
		$sql = "INSERT INTO currency (coins, username) VALUES (20, '".$username."');";
		$res = mysqli_query($db, $sql) or die(mysqli_error($db));
	    header("Location: ". $config_basedir . "/login.php?new=true");
		}//end if
		
	}//end if
}//end if post submit
	if(isset($_SESSION['USERNAME'])){
		require('header.php');
		echo "Welcome, " . $_SESSION['USERNAME'] .", you are logged into our system.";
		require('footer.php');
	}else{
		require('header.php');
		?>
<div class="mx-auto mt-5 mb-5 col-xl-4 col-lg-5 col-md-7 col-sm-8 col-xs-9"  >
		<form class="form-horizontal form-login rounded p-4" action='register.php' method='POST' id='otherlogin'>
			<fieldset>
				<legend>Please Register</legend>
				<div class="form-group">
					<label class="col control-label" for="username">Username</label>  
					<div class="col">
						<input id="username" name="username" type="text" placeholder="username" class="form-control input-md" required="">   
					</div>
				</div>
				<div class="form-group">
					<label class="col control-label" for="password">Password</label>
					<div class="col">
						<input id="password" name="password" type="password" placeholder="password" class="form-control input-md" required="">
					</div>
				</div>
				<div class="form-group">
					<label class="col control-label" for="password">Verify Password</label>
					<div class="col">
						<input id="password1" name="vpassword" type="password" placeholder="password" class="form-control input-md" required="">
					</div>
				</div>
				<div class="form-group" style="width:100%;">
					<label class="col control-label" for="submit"></label>
					<div class="col">
						<input type='submit' id="submit" name="submit" class="btn btn-outline-dark" value='Register'>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	
		<?php
		require('footer.php');
		}//end if login check
	//}//end reg check
?>