<?
require'cfd.php';

$query = "SELECT health, happy from pet;";
$result = mysqli_query($db, $query) or die(mysqli_error($db));
       while ($row = mysqli_fetch_assoc($result)) {
           $health = $row['health'];
           $happy = $row['happy'];
       }
       if($health >= 30){
       $newhealth = $health - 30;
       }else{
           $newhealth = 0;
       }
       if($happy >= 20){
       $newhappy = $happy -20;
       }else{
           $newhappy = 0;
       }
var_dump($health);
var_dump($newhealth);
$sql = "UPDATE pet SET health = $health, happy = $happy;";
$res = mysqli_query($db, $sql) or die(mysqli_error($db));




// const d = new Date();
// let daynum = d.getDay()

// const minute = 1000 * 60;
// const hour = minute * 60;
// const day = hour * 24;


//how long it has been since they logged in


?>



















