<?
require'cfd.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Coffee shop company database">
    <meta name="author" content="Rachel Sokol">
    <title>Virtual Pet | <? echo (isset($title) ?  $title : "")?></title>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: white;
   /*color: white;*/
   text-align: center;
}
  .card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 250px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container-card {
  padding: 2px 16px;
}
  canvas {border:1px solid #000000;background-image: url('images/livingroom2.png');}
  caption {font-size:20pt;text-align:center;}
  body {font-family: lobster; font-size:14pt;background-color:#f3f3f3;}
  main { width: 40%; margin: auto; padding: 10px;}
  .form-login {border: 2px solid black;box-shadow: 0px 0px 3px 3px rgba(0, 0, 0, 0.5);background-color:#00aaaa;  padding:6px;}
  input{width:60%;}
  aside { text-align: right;}
  h1 {text-align: center; font-family:lobster;}
  h2{text-align:center;}
  h3{text-align:center;}
 /* img {border: 5px #FF5733 solid;border-radius:10px;}*/
  th, td {border: black 2px solid; margin:auto;}
  table{border: black 2px solid; background-color:#b3a99d;}
  a:link{ color:#493a21}
  a:visited{color:#493a21}
  a:hover{ color:black}
  a:active {color:#493a21}
  #fancyfont {font-family:cursive;}
  #sources {border: 2px #000000 solid; border-radius:10px;padding:5px;}
  #color {border: 2px #FF5733 solid;}
  #backgroundcolor {background-color:#FF5733;}
    header, nav, main, footer, aside, figure { display: block; }
  @media (min-width: 600px) {
  header { grid-area: header; }
  nav { grid-area: nav; }
  body { grid-area: body; }
  footer { grid-area: footer; }
/*  .card {*/
/*  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);*/
/*  transition: 0.3s;*/
/*  width: 50%;*/
/*}*/
  #wrapper { display: grid;
  grid-template:
  "header header"
  "nav nav"
  "body"
  "footer footer" 
/ 55% }
}
@media (min-width: 1024px) {
header { grid-area: header; }
nav { grid-area: nav; }
body { grid-area: body; }
footer { grid-area: footer; }
#wrapper { margin: auto; max-width: 1200px; display: grid;

grid-template:
"header header header"
"nav nav nav"
"body"
"footer footer footer"
/ 150px; } 
}

  </style>
  </head>
  <body>
<?
$username = $_SESSION['USERNAME'];
$sql1 = "SELECT coins from currency where username = '" . $username . "';";
    $res1 = mysqli_query($db, $sql1) or die(mysqli_error($db));
    $row1 = mysqli_fetch_assoc($res1);
    $coins = $row1['coins'];
?>
   <nav style="background-color:#00cccc" class="navbar navbar-expand-lg navbar-nav justify-content-center">
    <ul class="navbar-nav  mt-2 mt-lg-0 ">
        <?
        if(isset($_SESSION['USERNAME'])){
        ?>
        <li class="nav-item" style="padding-right:50px;">
            <img src="images/newcon.png" style="border:none;" width="30" height="30">
        <a id="headercoins" style="color:white;" class="navbar-brand" href=""><?echo $coins;?></a>
        </li>
        <?
        }
        ?>
        <li class="nav-item">
        <a style="font-size:25px;font-family: 'Bruno Ace SC', cursive; color:white;" class="navbar-brand" href="index.php">My Virtual Pet</a>
        </li>
      <li class="nav-item">
        <a style="color:white;" class="nav-link" href="mypets.php">My Pets</a>
      </li>
      <li class="nav-item">
        <a style="color:white;" class="nav-link" href="games.php">Mini Games</a>
      </li>
        <?
                if(isset($_SESSION['USERNAME'])){
                    echo "<li class=\"nav-item\">";
                    echo "<a style=\"color:white;\"class=\"nav-link\" href='logout.php'>Logout</a>";
                    echo "</li>";
                }else{
                    echo "<li class=\"nav-item\">";
                    echo "<a style=\"color:white;\" class=\"nav-link\" href='login.php'>Login</a><br>";
                    echo "</li>";
                    echo "<li class=\"nav-item\">";
                    echo "<a style=\"color:white;\" class=\"nav-link\" href='register.php'>Register</a>";
                    echo "<li>";
                    
                }//end if
                ?>
      
                </ul>
     
</nav>
 <div class="container">