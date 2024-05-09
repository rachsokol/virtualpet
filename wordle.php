<?
session_name('virtual_pet'); //unique session name
session_start();
require('cfd.php');
$title = "Wordle";
if(isset($_SESSION['USERNAME'])){
    require('header.php');
    $username = $_SESSION['USERNAME'];
    $sql = "SELECT coins from currency WHERE username = '$username';";
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($res);
    $coins = $row['coins'];
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordle</title>
    <link rel="stylesheet" href="word_style.css">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <link
    rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  
</head>
<body>
    <h1>Word Wise</h1>
    <div class="container" style="margin-bottom:20px; width:50%;">
    <span style="font-size:14pt">This is a word guessing game. Guess a word and type it in. The letter will turn yellow if it is the right letter in the wrong spot. It will turn green if it is the right letter in the right spot. And it will turn grey if it is a letter that is not in the word. Happy Guessing!</span>
    </div>
    <div id="game-board">

    </div>
     <div id="keyboard-cont" style="margin-bottom:5rem;">
        <div class="first-row">
            <button class="keyboard-button">q</button>
            <button class="keyboard-button">w</button>
            <button class="keyboard-button">e</button>
            <button class="keyboard-button">r</button>
            <button class="keyboard-button">t</button>
            <button class="keyboard-button">y</button>
            <button class="keyboard-button">u</button>
            <button class="keyboard-button">i</button>
            <button class="keyboard-button">o</button>
            <button class="keyboard-button">p</button>
        </div>
        <div class="second-row">
            <button class="keyboard-button">a</button>
            <button class="keyboard-button">s</button>
            <button class="keyboard-button">d</button>
            <button class="keyboard-button">f</button>
            <button class="keyboard-button">g</button>
            <button class="keyboard-button">h</button>
            <button class="keyboard-button">j</button>
            <button class="keyboard-button">k</button>
            <button class="keyboard-button">l</button>
        </div>
        <div class="third-row">
            <button class="keyboard-button">Del</button>
            <button class="keyboard-button">z</button>
            <button class="keyboard-button">x</button>
            <button class="keyboard-button">c</button>
            <button class="keyboard-button">v</button>
            <button class="keyboard-button">b</button>
            <button class="keyboard-button">n</button>
            <button class="keyboard-button">m</button>
            <button class="keyboard-button">Enter</button>
        </div>
    </div>
    <script
src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="module">
import { WORDS } from "./words.js";

const NUMBER_OF_GUESSES = 6;
let guessesRemaining = NUMBER_OF_GUESSES;
let currentGuess = [];
let nextLetter = 0;
let rightGuessString = WORDS[Math.floor(Math.random() * WORDS.length)];
//console.log(rightGuessString);

function initBoard() {
    let board = document.getElementById("game-board");

    for (let i = 0; i < NUMBER_OF_GUESSES; i++) {
        let row = document.createElement("div");
        row.className = "letter-row";
        
        for (let j = 0; j < 5; j++) {
            let box = document.createElement("div");
            box.className = "letter-box";
            row.appendChild(box);
        }

        board.appendChild(row);
    }
}

initBoard();

document.addEventListener("keyup", (e) => {

    if (guessesRemaining === 0) {
        return;
    }

    let pressedKey = String(e.key);
    if (pressedKey === "Backspace" && nextLetter !== 0) {
        deleteLetter();
        return;
    }

    if (pressedKey === "Enter") {
        checkGuess();
        return;
    }

    let found = pressedKey.match(/[a-z]/gi);
    if (!found || found.length > 1) {
        return;
    } else {
        insertLetter(pressedKey);
    }
})

function insertLetter (pressedKey) {
    if (nextLetter === 5) {
        return;
    }
    pressedKey = pressedKey.toLowerCase();

    let row = document.getElementsByClassName("letter-row")[6 - guessesRemaining];
    let box = row.children[nextLetter];
    animateCSS(box, "pulse");
    box.textContent = pressedKey;
    box.classList.add("filled-box");
    currentGuess.push(pressedKey);
    nextLetter += 1;
}

function deleteLetter () {
    let row = document.getElementsByClassName("letter-row")[6 - guessesRemaining];
    let box = row.children[nextLetter - 1];
    box.textContent = "";
    box.classList.remove("filled-box");
    currentGuess.pop();
    nextLetter -= 1;
}

function checkGuess () {
    let row = document.getElementsByClassName("letter-row")[6 - guessesRemaining];
    let guessString = '';
    let rightGuess = Array.from(rightGuessString);

    for (const val of currentGuess) {
        guessString += val;
    }

    if (guessString.length != 5) {
        toastr.error("Not enough letters!");
        return;
    }

    if (!WORDS.includes(guessString)) {
        toastr.error("Word not in list!");
        return;
    }

    
    for (let i = 0; i < 5; i++) {
        let letterColor = '';
        let box = row.children[i];
        let letter = currentGuess[i];
        
        let letterPosition = rightGuess.indexOf(currentGuess[i])
        // is letter in the correct guess
        if (letterPosition === -1) {
            letterColor = 'grey';
        } else {
            // now, letter is definitely in word
            // if letter index and right guess index are the same
            // letter is in the right position 
            if (currentGuess[i] === rightGuess[i]) {
                // shade green 
                letterColor = 'green';
            } else {
                // shade box yellow
                letterColor = 'yellow';
            }

            rightGuess[letterPosition] = "#";
        }

        let delay = 250 * i;
        setTimeout(()=> {
            //flip box
            animateCSS(box, 'flipInX');
            //shade box
            box.style.backgroundColor = letterColor;
            shadeKeyBoard(letter, letterColor);
        }, delay)
    }

    if (guessString === rightGuessString) {
        <?
        $username = $_SESSION['USERNAME'];
        ?>
        var currency = <? echo $coins?> + 10;
        //var username = "<? echo $username;?>";
         $.ajax({ 
      type: "POST", 
      url: "update.php", // Replace with the actual PHP file name 
      data: {currency: currency, username: "<? echo $username;?>"}, 
      dataType: 'json',
      success: function(data) { 
      console.log('Updated!');
      console.log(data);
      },
                error: function(jqXHR) {
                   alert( jqXHR.responseText);
    //            console.error("AJAX error: " + status + " - " + error);
                } 
    });
        toastr.success("You guessed right! You earned 10 coins!");
        guessesRemaining = 0;
        currency = 10;
        setTimeout(function(){
             window.location.reload();
         }, 2000);
        return
    } else {
        guessesRemaining -= 1;
        currentGuess = [];
        nextLetter = 0;

        if (guessesRemaining === 0) {
            toastr.error("You've run out of guesses! Game over!");
            toastr.info(`The right word was: "${rightGuessString}"`);
            currency = 10;
        setTimeout(function(){
             window.location.reload();
         }, 2000);
        }
    }
}

function shadeKeyBoard(letter, color) {
    for (const elem of document.getElementsByClassName("keyboard-button")) {
        if (elem.textContent === letter) {
            let oldColor = elem.style.backgroundColor;
            if (oldColor === 'green') {
                return;
            } 

            if (oldColor === 'yellow' && color !== 'green') {
                return;
            }

            elem.style.backgroundColor = color;
            break;
        }
    }
}

document.getElementById("keyboard-cont").addEventListener("click", (e) => {
    const target = e.target;
    
    if (!target.classList.contains("keyboard-button")) {
        return;
    }
    let key = target.textContent;

    if (key === "Del") {
        key = "Backspace";
    } 

    document.dispatchEvent(new KeyboardEvent("keyup", {'key': key}));
})

const animateCSS = (element, animation, prefix = 'animate__') =>
  // We create a Promise and return it
  new Promise((resolve, reject) => {
    const animationName = `${prefix}${animation}`;
    // const node = document.querySelector(element);
    const node = element;
    node.style.setProperty('--animate-duration', '0.3s');
    
    node.classList.add(`${prefix}animated`, animationName);

    // When the animation ends, we clean the classes and resolve the Promise
    function handleAnimationEnd(event) {
      event.stopPropagation();
      node.classList.remove(`${prefix}animated`, animationName);
      resolve('Animation ended');
    }

    node.addEventListener('animationend', handleAnimationEnd, {once: true});
});
</script>

</body>
</html>
<?
require("footer.php");
}else{
    header("Location: " . $config_basedir );
}
?>