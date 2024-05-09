<?
session_name('virtual_pet'); //unique session name
session_start();
require('cfd.php');
$title = "Snake";
if(isset($_SESSION['USERNAME'])){
   require('header.php'); 
    $username = $_SESSION['USERNAME'];
    $sql = "SELECT coins from currency WHERE username = '$username';";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($res);
    $coins = $row['coins'];
?>
  <head>
    <meta charset="utf-8">
    <title>Snake Game JavaScript | Virtual Pet</title>
    <link rel="stylesheet" href="snake.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
   <!-- <script src="snake.js" defer></script>-->
  </head>
  <body>
    <div class="container" style="margin-top:3%; margin-bottom:10rem;">
        <div class="container" style="margin-bottom:20px; width:50%;">
        <span style="font-size:14pt;">Use your arrow pad and move the snake (blue) to eat the food (red). Don't run into the walls or into yourself. Try to beat the high score.</span>
        </div>
    <div class="wrapper" style="margin-left:30%;">
      <div class="game-details">
        <span class="score">Score: 0</span>
        <span class="high-score">Overall High Score: 0</span>
      </div>
      <div class="play-board"></div>
      <div class="controls">
        <i data-key="ArrowLeft" class="fa-solid fa-arrow-left-long"></i>
        <i data-key="ArrowUp" class="fa-solid fa-arrow-up-long"></i>
        <i data-key="ArrowRight" class="fa-solid fa-arrow-right-long"></i>
        <i data-key="ArrowDown" class="fa-solid fa-arrow-down-long"></i>
      </div>
    </div>
    </div>
    <script>
    <?
     $username = $_SESSION['USERNAME'];
    $sql = "SELECT coins from currency WHERE username = '$username';";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($res);
    $coins = $row['coins'];
    ?>
const playBoard = document.querySelector(".play-board");
const scoreElement = document.querySelector(".score");
const highScoreElement = document.querySelector(".high-score");
const controls = document.querySelectorAll(".controls i");

let gameOver = false;
let foodX, foodY;
let snakeX = 5, snakeY = 5;
let velocityX = 0, velocityY = 0;
let snakeBody = [];
let setIntervalId;
let score = 0;
let coins = 0;
let currency = <?echo $coins;?>;
let username = "<?echo $username;?>";

// Getting high score from the local storage
let highScore = localStorage.getItem("high-score") || 0;
highScoreElement.innerText = `Overall High Score: ${highScore}`;

const updateFoodPosition = () => {
    // Passing a random 1 - 30 value as food position
    foodX = Math.floor(Math.random() * 30) + 1;
    foodY = Math.floor(Math.random() * 30) + 1;
}

const handleGameOver = () => {
    // Clearing the timer and reloading the page on game over
    clearInterval(setIntervalId);
    if(score < 15){
        coins = Math.round(score / 2)
        currency += coins;
        console.log(currency);
    }else{
        coins = score
        currency += score;
    }
    if(currency > 0){
        $.ajax({ 
      type: "POST", 
      url: "update.php", // Replace with the actual PHP file name 
      data: {currency: currency, username: username}, 
      dataType: 'json',
      success: function(data) { 
      console.log('Updated!');
      console.log(data);
      },
            error: function(jqXHR) {
                alert( jqXHR.responseText);
                //console.error("AJAX error: " + status + " - " + error);
            } 
    });
}
    
    alert("Game Over! You earned " + coins + " coins! Press OK to replay...");
    location.reload();
}

const changeDirection = e => {
    // Changing velocity value based on key press
    if(e.key === "ArrowUp" && velocityY != 1) {
        velocityX = 0;
        velocityY = -1;
    } else if(e.key === "ArrowDown" && velocityY != -1) {
        velocityX = 0;
        velocityY = 1;
    } else if(e.key === "ArrowLeft" && velocityX != 1) {
        velocityX = -1;
        velocityY = 0;
    } else if(e.key === "ArrowRight" && velocityX != -1) {
        velocityX = 1;
        velocityY = 0;
    }
}

// Calling changeDirection on each key click and passing key dataset value as an object
controls.forEach(button => button.addEventListener("click", () => changeDirection({ key: button.dataset.key })));

const initGame = () => {
    if(gameOver) return handleGameOver();
    let html = `<div class="food" style="grid-area: ${foodY} / ${foodX}"></div>`;

    // Checking if the snake hit the food
    if(snakeX === foodX && snakeY === foodY) {
        updateFoodPosition();
        snakeBody.push([foodY, foodX]); // Pushing food position to snake body array
        score++; // increment score by 1
        highScore = score >= highScore ? score : highScore;
        localStorage.setItem("high-score", highScore);
        scoreElement.innerText = `Score: ${score}`;
        highScoreElement.innerText = `High Score: ${highScore}`;
    }
    // Updating the snake's head position based on the current velocity
    snakeX += velocityX;
    snakeY += velocityY;
    
    // Shifting forward the values of the elements in the snake body by one
    for (let i = snakeBody.length - 1; i > 0; i--) {
        snakeBody[i] = snakeBody[i - 1];
    }
    snakeBody[0] = [snakeX, snakeY]; // Setting first element of snake body to current snake position

    // Checking if the snake's head is out of wall, if so setting gameOver to true
    if(snakeX <= 0 || snakeX > 30 || snakeY <= 0 || snakeY > 30) {
        return gameOver = true;
    }

    for (let i = 0; i < snakeBody.length; i++) {
        // Adding a div for each part of the snake's body
        html += `<div class="head" style="grid-area: ${snakeBody[i][1]} / ${snakeBody[i][0]}"></div>`;
        // Checking if the snake head hit the body, if so set gameOver to true
        if (i !== 0 && snakeBody[0][1] === snakeBody[i][1] && snakeBody[0][0] === snakeBody[i][0]) {
            gameOver = true;
        }
    }
    playBoard.innerHTML = html;
}

updateFoodPosition();
setIntervalId = setInterval(initGame, 100);
document.addEventListener("keyup", changeDirection);
    </script>
    <br>
    <br>
  </body>
</html>
<?
require("footer.php");
}else{
    header("Location: " . $config_basedir );
}
?>