<?php
session_name('virtual_pet'); 
session_start();
require("cfd.php");
$title = "Mini Games";
if(isset($_SESSION['USERNAME'])){
    require("header.php");
    ?>
    <head>
        <style>
.col-sm-4 {
  position: relative;
  text-align:center;
  width: 25%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: 350px;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.col-sm-4:hover .image {
  opacity: 0.3;
}

.col-sm-4:hover .middle {
  opacity: 1;
}
a {
    text-decoration:none;
}
img {border: 4px #00aaaa solid; border-radius:5px;}
.text {

  background-color:#00aaaa;
  color: white;
  font-size: 20px;
  padding: 5px 10px;
}
        </style>
    </head>
    <h1>Mini Games</h1>
    <div class="contatiner">
        <div class="row">
            <div class="col-sm-4">
                        <img src="images/newmatch2.png" class="image" alt="matchinggame" style="width:100%">
                        <div class="middle">
                        <h4 class="btn"><a href="matchinggame.php" class="text">Match the Cat</a></h4>
                        </div>
                  </div>
              
            <div class="col-sm-4">
                  <img src="images/snakenew.png" alt="snakegame" class="image" style="width:100%">
                  <div class="middle">
                    <h4 class="btn"><a href="snake.php" class="text">Snake</a></h4>
                  </div>
            </div>
             <div class="col-sm-4">
                  <img src="images/wordle.png" alt="wordgame" class="image" style="width:100%">
                  <div class="middle">
                    <h4 class="btn"><a href="wordle.php" class="text">Word Wise</a></h4>
                  </div>
            </div>
            </div>
         </div>
    <?
require("footer.php");   
}else{
    header("Location: " . $config_basedir );
}