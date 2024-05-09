<?php
session_name('virtual_pet'); 
session_start();
require("cfd.php");
//updated for login tracker!
//start of the login process
if($_POST['submit'] && $_POST['submit'] == "Login"){
	//get the username and password from the form
	$username = $_POST['username'];
	$password = $_POST['password'];
	//get the details related to the account in the query
	$sql = 'SELECT password, username FROM login WHERE username = "' . mysqli_real_escape_string($db,$username) . '" LIMIT 1;';
	//run the query
	$r = mysqli_fetch_assoc(mysqli_query($db,$sql));
	//this is the salt and password from the db
	// The first 64 characters of the hash is the salt
	$salt = substr($r['password'], 0, 64);
	//add the salt to the provided password
	$hash = $salt . $password;
	// Hash the password as we did before
	for($i = 0; $i < 100000; $i ++ ) {
	  $hash = hash('sha256', $hash);
	}//end for
	//add the salt back to the hashed password 
	//(cause that is how it is in the database)
	$hash = $salt . $hash;
	//echo $hash ."<br>". $r['password'];
	//make sure our new hashed password matches what we got from the database
	if($hash == $r['password']) {
		// Ok! we have a match
		//move the username into the session username 
		$_SESSION['USERNAME'] = $r['username'];
		if($r['admin'] == 1){
			$_SESSION['ADMINSTATUS'] = 1;
		}else if($r['admin'] == 2){
			$_SESSION['ADMINSTATUS'] = 2;
		}else{
			$_SESSION['ADMINSTATUS'] = 0;
		}//end if admin check
	/*	//login tracker
		//get last log on
		$lastsql = "Select max(datelogged) as dl from logintracker where username = '".$_SESSION['USERNAME']."' order by datelogged limit 1;";
		$lastresult = mysqli_query($db,$lastsql);
		$numrowslast = mysqli_num_rows($lastresult);
		$rowlast = mysqli_fetch_assoc($lastresult);
		$insertlast = "insert into logintracker(username, datelogged) values('".$_SESSION['USERNAME']."', NOW());";
		mysqli_query($db,$insertlast);
			*/
		if($numrowslast != 1){
			//never logged in before 
			$_SESSION['LASTLOGIN'] = "Welcome, this is your first logon! ";
		}else{
			//have logged in before
			$_SESSION['LASTLOGIN'] = date("m-j-Y g:iA", strtotime($rowlast['dl']));
		}//endif
	
		if(isset($_GET['url'])){
			header("Location: " . $_GET['url']);
		}else{
			if($_SESSION['ADMINSTATUS'] >= 1){
				header("Location: " . $config_basedir . "admin.php");
			}else{
				header("Location: " . $config_basedir . "/index.php");
				//session_name('virtual_pet');
				
				
            	$username = $_SESSION['USERNAME'];
            
            	$sql = "SELECT max(DT) from lastlogged 
            	WHERE username = '$username';";
            	$res = mysqli_query($db, $sql) or die(mysqli_error($db));
            	$row = mysqli_fetch_assoc($res);
                $last = $row['max(DT)'];
            // 	if($res == 1){
            // 	echo "<h2>",$last,"</h2>";
            // 	}else{
            // 	    echo "<h2>Error</h2>", $sql;
            // 	}
            	if(!empty($last)){
            	    $curr = date("Y-m-d H:i:s");
            	    //in seconds
            	    $currdate = strtotime($curr);
            	    $lastdate = strtotime($last);
            	    $timeaway = $currdate - $lastdate;
            	    //if timeaway is greater than 24 hours
            	   // echo $currdate;
            	   // echo $timeaway;
            	    if($timeaway >= 86400){
            	       // $query = "SELECT happy, health from pet WHERE username = '$username';";
            	       // $result = mysqli_query($db, $query) or die(mysqli_error($db));
            	       // $row1 = mysqli_fetch_assoc($result);
            	       // $happy = $row1['happy'];
            	       // $health = $row1['health'];
            	        
            	        $days = round($timeaway/60/60/24);
            	       // $health = $health - (10 * $days);
            	       // $happy = $happy - (10 * $days);
            	       // if($health < 0){
            	       //     $health = 0;
            	       // }
            	       // if($happy < 0){
            	       //     $happy = 0;
            	       // }
            	       // echo $happy;
            	       // echo $health;
            	       $value = 10 * $days;
            	        $sql = "UPDATE pet set health = health - ".$value.", happy = happy - ".$value." WHERE username = '".$username."';";
            	        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
            	        
            	       // $query = "SELECT happy, health from pet WHERE username = '".$username."';";
            	       // $result = mysqli_query($db, $query) or die(mysqli_error($db));
            	       // while ($row = mysqli_fetch_assoc($res)) {
            	            
            	       //     if($row['happy'] < 0){
            	       //         $row['happy'] = 0;
            	       //     }
            	       //     if($row['health'] < 0){
            	       //         $row['health'] = 0;
            	       //     }
            	       //     if($row['health'] < 0 || $row['happy'] < 0){
            	                
            	                $sql = "UPDATE pet set health = 0 WHERE username = '".$username."' AND health < 0;";
            	                $res = mysqli_query($db, $sql) or die(mysqli_error($db));
            	                $sql = "UPDATE pet set happy = 0 WHERE username = '".$username."' AND happy < 0;";
            	                $res = mysqli_query($db, $sql) or die(mysqli_error($db));
            	            
            	        
            	    }
            	}
	
	$query = "INSERT INTO lastlogged (username, DT) VALUES('".$username."', NOW());";
	$result = mysqli_query($db, $query) or die(mysqli_error($db));	
				
			}//end if
		}//end if
	}else{
		header("Location: " . $config_basedir . "/login.php?error=1");
	}//end if
}else{//this display if it is not a login attempt
	if(isset($_GET['error'])){//if there is an error in the login process
		$msg = "<h2 class='alert alert-danger'>Incorrect login, please try again!</h2>";
	}//end ifisset error
	if(isset($_GET['new'])){//if they had a correct registration, then they can now login
		$msg = "<h3 class='alert alert-info'>Welcome please login with your new account!</h3>";
	}//end ifisset new
	require('header.php');
	echo $msg; //display message if there is one
	//this next section is done if a user tries to log in from a page 
	//other than login and sends them back to the same page 
	//after a successful login.
	if(isset($_GET['url'])){
		$file = "/login.php?url=" . $_GET['url'];
	}else{
		$file = "/login.php";
	}//end if
	?>
<div class="mx-auto mt-5 mb-5 col-xl-4 col-lg-5 col-md-7 col-sm-8 col-xs-9"  >
	<form class="form-horizontal form-login rounded p-4 " action='login.php' method='POST' id='otherlogin'>
		<fieldset>
			<legend>Please log in below</legend>
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
				<label class="col control-label" for="submit"></label>
				<div class="col">
					<input type='submit' id="submit" name="submit" class="btn btn-outline-dark" value='Login'>
				</div>
				</div>
		</fieldset>
	</form>
	</div>
	<?php
	require('footer.php');
}//end if else