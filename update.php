<?
session_name('virtual_pet');
session_start();
require'cfd.php';

header("Content-Type: application/json");
if(isset($_POST['health'])){
$newhealth = intval($_POST['health']);
$pid = intval($_POST['pid']);
$sql = "UPDATE pet
    SET health = ".$newhealth."
    WHERE pid = ".$pid.";";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    if ($res == 1) {
        echo $newhealth;
    };
};
if(isset($_POST['happy'])){
$happy = intval($_POST['happy']);
$pid = intval($_POST['pid']);
$sql = "UPDATE pet
    SET happy = ".$happy."
    WHERE pid = ".$pid.";";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    if ($res == 1) {
        echo $happy;
    };
};
if(isset($_POST['happy'])){
    $pid = intval($_POST['pid']);
    $archive = invtval($_POST['archive']);
    $health = inval($_POST['health']);
    $sql = "UPDATE pet
    SET health = ".$health.", archive = ".$archive."
    WHERE pid = ".$pid.";";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    if ($res == 1) {
        echo $health;
    };
};
if(isset($_POST['currency'])){
    $coins = intval($_POST['currency']);
    $username = ($_POST['username']);
    
    $query = "SELECT coins from currency where username = '$username';";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);

    // if(mysqli_num_rows($result) == 0){
    //     $sql =  "INSERT INTO currency (coins, username) VALUES (".$coins.",'".$username."');";
    //     $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    // }else{
        
        $sql = "UPDATE currency
        SET coins = ".$coins."
        WHERE username = '".$username."';";
        $res = mysqli_query($db, $sql) or die(mysqli_error($db));
        if ($res == 1) {
            echo $coins;
        }
    // };
};
if(isset($_POST['id'])){
    $item = ($_POST['id']);
    $amount = intval($_POST['amount']);
    $username = ($_POST['username']);
    error_log($amount);
        if($amount < 1){
            $query = "DELETE FROM inventory WHERE item = '$item' AND username = '$username';";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            error_log($query);
        }else{
        $query = "SELECT item from inventory where item = '$item' AND username = '$username';";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        
            if(mysqli_num_rows($result) == 0){
                $sql =  "INSERT INTO inventory (item, amount, username) VALUES ('".$item."', ".$amount.",'".$username."');";
                $res = mysqli_query($db, $sql) or die(mysqli_error($db));
            }else{
                $sql = "UPDATE inventory
                SET amount = ".$amount."
                WHERE item = '".$item."' AND username = '".$username."';";
                $res = mysqli_query($db, $sql) or die(mysqli_error($db));
            }
            if ($res == 1) {
                $msg = json_encode(array("id" => $item, "amount" => $amount));
                echo $msg;
            };
        }
};
?>