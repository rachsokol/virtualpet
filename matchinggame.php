<?
session_name('virtual_pet'); //unique session name
session_start();
require('cfd.php');
$title = "Matching";
if(isset($_SESSION['USERNAME'])){
    require('header.php');
?>
  <style>
      * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}



.memory-game {
  width: 640px;
  height: 640px;
  margin: auto;
  display: flex;
  flex-wrap: wrap;
  perspective: 1000px;
}

.memory-card {
  width: calc(25% - 10px);
  height: calc(33.333% - 20px);
  margin: 5px;
  position: relative;
  transform: scale(1);
  transform-style: preserve-3d;
  transition: transform .5s;
  box-shadow: 1px 1px 1px rgba(0,0,0,.3);
}

.memory-card:active {
  transform: scale(0.97);
  transition: transform .2s;
}

.memory-card.flip {
  transform: rotateY(180deg);
}
img {border: 3px #00aaaa solid; border-radius:5px;}
.front-face,
.back-face {
  width: 100%;
  height: 100%;
  padding: 20px;
  position: absolute;
  border-radius: 5px;
  background: #b2e5e5;
  backface-visibility: hidden;
}

.front-face {
  transform: rotateY(180deg);
}

</style>
</head>

<body>
  <h3 id="win"></h3>
  
  <div class="container" style="width:50%; padding-bottom:20px;">
  <span style="font-size:15pt;">This is a memory game. Click on two cards to see if they match. Do this until all of the cards have been revealed. If you win, you will earn 5 coins.</span>
  </div>
  <section class="memory-game" style="margin-bottom:20px;">
    <div class="memory-card" data-framework="blackcat">
      <img class="front-face" src="matching/cat1.svg" alt="Black Cat" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>
    <div class="memory-card" data-framework="blackcat">
      <img class="front-face" src="matching/cat1.svg" alt="Black Cat" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>

    <div class="memory-card" data-framework="vue">
      <img class="front-face" src="matching/cat2.svg" alt="Vue" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>
    <div class="memory-card" data-framework="vue">
      <img class="front-face" src="matching/cat2.svg" alt="Vue" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>

    <div class="memory-card" data-framework="angular">
      <img class="front-face" src="matching/cat3.svg" alt="Angular" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>
    <div class="memory-card" data-framework="angular">
      <img class="front-face" src="matching/cat3.svg" alt="Angular" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>

    <div class="memory-card" data-framework="ember">
      <img class="front-face" src="matching/cat4.svg" alt="Ember" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>
    <div class="memory-card" data-framework="ember">
      <img class="front-face" src="matching/cat4.svg" alt="Ember" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>

    <div class="memory-card" data-framework="backbone">
      <img class="front-face" src="matching/cat5.svg" alt="Backbone" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>
    <div class="memory-card" data-framework="backbone">
      <img class="front-face" src="matching/cat5.svg" alt="Backbone" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>

    <div class="memory-card" data-framework="react">
      <img class="front-face" src="matching/cat6.svg" alt="React" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>
    <div class="memory-card" data-framework="react">
      <img class="front-face" src="matching/cat6.svg" alt="React" >
      <img class="back-face" src="matching/fish.svg" alt="JS Badge" >
    </div>
  </section>

  <script>
const cards = document.querySelectorAll('.memory-card');

let hasFlippedCard = false;
let lockBoard = false;
let firstCard, secondCard;
let win = 0;
let username = "<?echo $username;?>";

function flipCard() {
  if (lockBoard) return;
  if (this === firstCard) return;

  this.classList.add('flip');

  if (!hasFlippedCard) {
    hasFlippedCard = true;
    firstCard = this;

    return;
  }

  secondCard = this;
  checkForMatch();
}

function checkForMatch() {
  let isMatch = firstCard.dataset.framework === secondCard.dataset.framework;

  isMatch ? disableCards() : unflipCards();
}

function disableCards() {
  firstCard.removeEventListener('click', flipCard);
  secondCard.removeEventListener('click', flipCard);
  win += 1;
//   console.log(win);
  gameover();
  resetBoard();
}

function unflipCards() {
  lockBoard = true;

  setTimeout(() => {
    firstCard.classList.remove('flip');
    secondCard.classList.remove('flip');

    resetBoard();
  }, 1500);
}
<?
$username = $_SESSION['USERNAME'];

$sql1 = "SELECT coins from currency where username = '" . $username . "';";
    $res1 = mysqli_query($db, $sql1) or die(mysqli_error($db));
    $row1 = mysqli_fetch_assoc($res1);
    $_SESSION['coins'] = $row1['coins'];
    $coins = $_SESSION['coins'];
?>

var currency = <?php echo $coins; ?>; // Initial currency amount

console.log(currency);
function updateCoins(currency,username){

console.log(currency);

    $.ajax({ 
  type: "POST", 
  url: "update.php", // Replace with the actual PHP file name 
  data: {currency: currency, username: username}, 
  dataType: 'json',
  success: function(data) { 
   console.log('Updated!');
   console.log(data);
    document.getElementById("currency").innerHTML = currency;
  },
        error: function(xhr, status, error) {
            console.error("AJAX error: " + status + " - " + error);
        } 
});
alert("You won the game. You have earned 5 coins");
setTimeout(function(){
             window.location.reload();
         }, 1000);
//console.log(currency, coins)
}
function gameover(){
    username = "<?php echo $username;?>";
    currency = <?php echo $coins; ?>;
    if(win === 6){

    currency += 5;

    updateCoins(currency, username);

    }
}


function resetBoard() {
  [hasFlippedCard, lockBoard] = [false, false];
  [firstCard, secondCard] = [null, null];
}

(function shuffle() {
  cards.forEach(card => {
    let randomPos = Math.floor(Math.random() * 12);
    card.style.order = randomPos;
  });
})();


cards.forEach(card => card.addEventListener('click', flipCard));

</script>
</body>
</html>
<?
require("footer.php");
}else{
    header("Location: " . $config_basedir );
}
?>