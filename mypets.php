<?php
session_name('virtual_pet'); 
session_start();
require("cfd.php");
$title = "Home";
if(isset($_SESSION['USERNAME'])){
    require("header.php");
function selectPet($db){
        $username = $_SESSION['USERNAME'];
        $sql = "SELECT pid, name, img, type, happy, health, archive from pet where username = '" . $username . "' AND archive = 0;";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        while ($row = mysqli_fetch_assoc($res)) {
            $row['name'];
            $happy = $row['happy'];
            $health = $row['health'];
            $pid = $row['pid'];
            $name = $row['name'];
            
            if($happy == 0 && $health == 0){
                $sql1 = "Update pet
                SET archive = 1
                WHERE pid = $pid;";
                $res1 = mysqli_query($db, $sql1) or die(mysqli_error($db));
            
                echo "<h4 style=\"margin-left:25%;\">Your pet ", $name, " ran away because you didn't take care of it :(</h4> <br>";
            }
        }
        
        $sql = "SELECT pid, name, img, type, happy, health, archive from pet where username = '" . $username . "' AND archive = 0;";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        echo "<h2>My Pets</h2>";
        echo "<div class=\"container\" style=\"margin-top:5%;\">";
        echo "<div class=\"row\">";
        while ($row = mysqli_fetch_assoc($res)) {
            $type = $row['type'];
            $pid = $row['pid'];
            $name = $row['name'];
            $img = $row['img'];
            $happy = $row['happy'];
            $health = $row['health'];
         //echo $img;
            echo "<div class=\"col-sm-3\" style=\"padding-bottom:5%;\">";
            echo "<div class=\"card\" style=\"border: 4px #00aaaa solid;\">";
            echo "<img src=\"",$img,"\" alt=\"Avatar\" style=\"width:100%; height:250px;\">";
           
            echo "<form method=\"post\" action=\"virtualpet.php\">";
            echo "<div class=\"container-card\" style=\"background-color:#00aaaa;\">";
            echo "<h4 style=\"text-align:center;\"><label name=\" name\">",$name , "</label></h4>";
            echo "<input type=\"text\" style=\"display:none;\" name=\"pid\" value=\"$pid\">";
            echo "<label style=\"display:none\" name=\"pid\">", $row['pid'], "</label>";
            echo "<label name=\" happy\">Happiness: ", $happy, "</label><br>";
            echo "<label name=\" health\">Health: ", $health, "</label><br>";
            echo "<input type=\"submit\" name=\"play\" class=\"btn btn-outline-dark
        \" value=\"Play\">";
            echo "</form>";
            ?>
            </div>
            </div>
            </div>
            <?
        }//end while
        if(empty($name)){
            echo "<h3>You haven't adopted any pets yet! Go back to home to adopt a pet.</h3>";
        }
        
            echo "</div>";
            
    }
selectPet($db);
require("footer.php");
}else{
    header("Location: " . $config_basedir );
}
?>