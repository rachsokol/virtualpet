<?php
session_name('virtual_pet'); 
session_start();
require("cfd.php");
$title = "Home";
require("header.php");
if(isset($_SESSION['USERNAME'])){
    ?>
    <div class="center" style="width:50%; margin:auto;">
    <h2>How To Play</h2>
    
    <ol>
        <li>Adopt a pet</li>
        <li>View your pets in 'My Pets'</li>
        <li>Play games to earn Coins</li>
        <li>Use your Coins to buy supplies to take care of your pet</li>
    </ol>
    <h4>Visit pet daily or your pet will become unhappy and run away!</h4>
    </div>
    <?
    function createPet($db){
        
        if($_POST['type'] == 'cat'){
       $randomcat = rand(1,3);
       switch($randomcat){
            case 1:
                $img = "images/cat1.svg";
                break;
            case 2:
                $img = "images/cat2.svg";
                break;
            case 3:
                $img = "images/cat3.svg";
                break;
       }
    }else if($_POST['type']=='dog'){
        $randomdog = rand(1,6);
        switch($randomdog){
            case 1:
                $img = "images/dog1.svg";
                break;
            case 2:
                $img = "images/dog2.svg";
                break;
            case 3:
                $img = "images/dog3.svg";
                break;
            case 4:
                $img = "images/dog4.svg";
                break;
            case 5:
                $img = "images/dog5.svg";
                break;
            case 6:
                $img = "images/dog6.svg";
                break;
        }
        
    }
    
        $username = $_SESSION['USERNAME'];
        $happy = 50;
        $health = 50;
        $name = $_POST['name'];
        $type = $_POST['type'];
        
        $sql = "INSERT into pet (username, type, name, img, happy, health) VALUES ( '".$username."', '".$type."', '".$name."','".$img."',50, 50);";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    }
    
    ?>

    <div class="mx-auto mt-5 col-xl-4 col-lg-5 col-md-7 col-sm-8 col-xs-9"  >
	<form class="form-horizontal form-login rounded p-4 " action='index.php' method='POST' >
		<fieldset>
			<legend>Adopt a pet</legend>
			<div class="form-group">
				<label class="col control-label" for="name">Name</label>  
				<div class="col">
					<input id="name" name="name" type="text" placeholder="name" class="form-control input-md" required="">   
				</div>
			</div>
			<div class="form-group">
				<label class="col control-label" for="type">Type</label>
				<div class="col">
				    <select name="type" id="type" class="form-control" required="">
                      <option value='cat'>Cat</option>
                      <option value='dog'>Dog</option>
                    </select>
				</div>
			</div>
			<div class="form-group">
				<label class="col control-label" for="create"></label>
				<div class="col">
					<input type='submit' id="create" name="create" class="btn btn-outline-dark" value='Create'>
				</div>
				</div>
		</fieldset>
	</form>
	</div>
    <?
if($_POST['create']){
    createPet($db);
}

}else{
?>
<div class="mx-auto mt-5 col-xl-4 col-lg-5 col-md-7 col-sm-8 col-xs-9"  >
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
	<br><br>
<?

}//end login check
require("footer.php");
?>