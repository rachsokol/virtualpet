<?
session_name('virtual_pet'); //unique session name
session_start();
require'cfd.php';
if(isset($_SESSION['USERNAME'])){
    require'header.php';
    if(isset($_POST['play'])){
       $_SESSION['pid'] = $_POST['pid'];
       $pid = $_SESSION['pid'];
       $username = $_SESSION['USERNAME'];
       
       $sql = "SELECT pid, name, img, type, happy, health, archive from pet where pid = " . $pid . ";";
       $res = mysqli_query($db, $sql) or die(mysqli_error($db));
       while ($row = mysqli_fetch_assoc($res)) {
           echo "<h3>", $row['name'] , "</h3>";
           $type = $row['type'];
           $happy = $row['happy'];
           $archive = $row['archive'];
           $health = $row['health'];
           $img = $row['img'];
       }
        
    }else{
        echo "Pet was not selected.";
    }
    $sql1 = "SELECT coins from currency where username = '" . $username . "';";
    $res1 = mysqli_query($db, $sql1) or die(mysqli_error($db));
    $row1 = mysqli_fetch_assoc($res1);
    $_SESSION['coins'] = $row1['coins'];
    $coins = $_SESSION['coins'];

?>
    <body>
        <div class="row">
        <div class="col">
        <div id="message"></div>
       <canvas id="canvas" style="margin-top:2%; border: 4px #00aaaa solid;"></canvas>
       </div>
       <div class="col" style="margin-top:1%;">
    <div id="info" style="color:red;"></div>
    <h4 >Currency:</h4>
    
    <label id="currency" style="font-size:20pt"> </label>
    <img src="images/newcon.png" style="border:none;" width="30" height="30">
    <h4 style="padding-top:50px;">Inventory: </h4>
    <div id="inventory"></div>
    <hr>
    <h4>Shop: </h4>
    <div id="shop"></div>
    </div>
    </div>
     <script>
// Create the canvas
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
canvas.width = 900;
canvas.height = 500;

// Entity setup
var type = "<?echo $type;?>";
var pet = new Image();
pet.src = "<?echo $img;?>";

function Entity(id, x, y) {
    var self = {
        id: id,
        x: x,
        y: y
    };

    self.drawPet = function() {
        ctx.drawImage(pet, self.x, self.y); 
    };

    return self;
}
//load and draw pet
window.onload = function() {
var entity = Entity(1, 450, 350);
entity.drawPet();
}


// Health Bar Functions
function drawHealthBarBorder(x, y, width, thickness) {
    ctx.beginPath();
    ctx.rect(x, y, width, thickness);
    ctx.stroke();
    ctx.closePath();
}

function drawHealthBar(x, y, per, width, thickness) {
    ctx.beginPath();
    ctx.rect(x - width/2, y, width * (per / 100), thickness);

    if (per > 63) {
        ctx.fillStyle = "green";
    } else if (per > 37) {
        ctx.fillStyle = "gold";
    } else if (per > 13) {
        ctx.fillStyle = "orange";
    } else {
        ctx.fillStyle = "red";
    }
    ctx.fill();
    ctx.closePath();
 
}

// Happiness Bar Functions
function drawHappyBarBorder(x, y, width, thickness) {
    ctx.beginPath();
    ctx.rect(x, y, width, thickness);
    ctx.stroke();
    ctx.closePath();
}

function drawHappyBar(x, y, per, width, thickness) {
    ctx.beginPath();
    ctx.rect(x - width/2, y, width * (per / 100), thickness);

    if (per > 63) {
        ctx.fillStyle = "blue";
    } else if (per > 37) {
        ctx.fillStyle = "gold";
    } else if (per > 13) {
        ctx.fillStyle = "orange";
    } else {
        ctx.fillStyle = "red";
    }
    ctx.fill();
    ctx.closePath();
 
}
ctx.font = "13px Arial";
ctx.fillStyle = "blue";
ctx.fillText("Happiness", 10, 45);
drawHappyBarBorder(10, 49, 80, 13);
var happy = <?php echo $happy; ?>;
drawHappyBar(50, 50, happy, 80, 10);

ctx.font = "13px Arial";
ctx.fillStyle = "blue";
ctx.fillText("Health", 10, 10);
drawHealthBarBorder(10, 14, 80, 13);
var health = <?php echo $health; ?>;
var newhealth = 0;
var value = 0;

drawHealthBar(50, 15, health, 80, 10);



var currency = <?php echo $coins; ?>; // Initial currency amount
document.getElementById("currency").innerHTML = currency;

function updateCoins(currency){
    
    // console.log(coins);

    // console.log("updatecoins" + currency);
    $.ajax({ 
  type: "POST", 
  url: "update.php", // Replace with the actual PHP file name 
  data: {currency: currency, username: "<?echo $username;?>"}, 
  dataType: 'json',
  success: function(data) { 
//   console.log('Updated!');
//   console.log(data);
    document.getElementById("headercoins").innerHTML = currency;
    document.getElementById("currency").innerHTML = currency;
  },
        error: function(xhr, status, error) {
            console.error("AJAX error: " + status + " - " + error);
        } 
});
//console.log(currency, coins)
//location.reload("header.php");
document.getElementById("currency").innerHTML = currency;
}

function timer(health){
const d = new Date();
let daynum = d.getDay()
}

var archive = <?echo $archive;?>;
function updateHealth(value){
    health += value
    if (health > 100) {
        health = 100;  // Ensure health doesn't exceed 100
        document.getElementById("message").innerHTML = "Your pet is healthy!<br>";
        
    }
    if (health < 0) {
        health = 0;  // Ensure health doesn't go below 0
    }
        $.ajax({ 
      type: "POST", 
      url: "update.php", // Replace with the actual PHP file name 
      data: {archive: 1, pid: <?echo $pid?>, health : health}, 
      dataType: 'json',
       success: function(data) { 
                // console.log('Updated!');
                // console.log(data);
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + " - " + error);
            }
    });
    
     drawHealthBar(50, 15, health, 80, 10);
}

function updateHappy(value){
    happy += value;
    if (happy > 100) {
        happy = 100; // Ensure happy doesn't exceed 100
    document.getElementById("message").innerHTML = "Your pet is happy! <br>";

    }
    if (happy < 0) {
        happy = 0;  // Ensure happy doesn't go below 0
    }
    
    $.ajax({ 
  type: "POST", 
  url: "update.php", // Replace with the actual PHP file name 
  data: {happy: happy, pid: <?echo $pid?>}, 
  dataType: 'json',
  success: function(data) { 
    //console.log('Updated!');
   // console.log(data);
    
  } 
});

    
     drawHappyBar(50, 50, happy, 80, 10);
}

//self.updateInventory = function(id, amount){
  function updateInventory(id, amount){
    <?
    $username = $_SESSION['USERNAME'];
    ?>
    //console.log(id, amount);
    

    $.ajax({ 
  type: "POST", 
  url: "update.php", // Replace with the actual PHP file name 
  data: {"id": id, "amount": amount, "username": "<? echo $username ?>"}, 
  dataType: 'json',
  success: function(data) { 
    console.log('Updated!');
    console.log(data);
    
        },
    error: function(xhr, status, error) {
        // console.log('sfasdasd');
        console.log(status)
        console.log(error)
        // console.error("AJAX error: " + status + " - " + error);
    }
});
}


// Inventory System
function Inventory() {
  
    var self = {
        items: []
    };
     <?
    $query = "SELECT item, amount from inventory where username = '$username';";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_assoc($result)){
        // $id = $row['item'];
        // $amount = $row['amount'];
       // $items[] = array($row['item'], $row['amount']);
        //$ids[] = array($row['item']);
        //$amounts[] = array($row['amount']);
        ?>
        self.items.push({id: "<?echo $row['item'];?>", amount: <? echo $row['amount']; ?>})
        <?
    }
    ?>
    //console.log(<?// echo $items; ?>);
   // self.items.push(id:<?// echo json_encode($ids);?>);

    self.addItem = function(id, amount) {
        for(var i = 0 ; i < self.items.length; i++){
			if(self.items[i].id === id){
				self.items[i].amount += amount;
				self.refreshRender();
				return;
			}
		}
		
 		self.items.push({id:id,amount:amount});
 		updateInventory(id, amount);
		self.refreshRender();
		
    };

    self.removeItem = function(id, amount) {
        for(var i = 0 ; i < self.items.length; i++){
			if(self.items[i].id === id){
				self.items[i].amount -= amount;
				if(self.items[i].amount <= 0)
					self.items.splice(i,1);
				
				return;
			}
		}    
		//self.updateInventory(id, amount);
		//does nothing
		updateInventory(id, amount);
		self.refreshRender();
    };

    self.hasItem = function(id, amount) {
        for(var i = 0 ; i < self.items.length; i++){
			if(self.items[i].id === id){
				return self.items[i].amount >= amount;
			}
		}  
		return false;
    };
    
    self.useItem = function(itemId) {
        var itemIndex = self.items.findIndex(item => item.id === itemId);
        if (itemIndex !== -1) {
            var usedItem = self.items[itemIndex];
            Item.List[usedItem.id].event(usedItem.value);
            usedItem.amount--;
            // if (usedItem.amount > 1) {
            //     usedItem.amount--;
            //     //updateInventory(id, amount);
            // } else {
            //   self.items.splice(itemIndex, 1);
            // }
            
            self.refreshRender();
        } else {
            console.log("Item with ID " + itemId + " not found in inventory");
        }
};

   self.refreshRender = function(id, amount) {
    var str = "";
    for(var i = 0; i < self.items.length; i++) {
        if (Item.List[self.items[i].id]) {
            let item = Item.List[self.items[i].id];
            //if item is deleted in the database, don't display it
            if(self.items[i].amount > 0){
            str += "<button style=\"background-color:#00aaaa;\" data-item-id='" + item.id + "'>Use " + item.name + " x" + self.items[i].amount + "</button><br>";
            }
           amount = self.items[i].amount;
            id = item.id;
            //console.log(self.items[i].id);
        } else {
            console.log("Item with ID: " + self.items[i].id + " not found in Item.List");
        }
         
            updateInventory(id, amount);
    }

    document.getElementById("inventory").innerHTML = str;

    var inventoryButtons = document.querySelectorAll("#inventory button");

    function handleItemClick(id, amount) {
        var itemId = this.getAttribute('data-item-id');
        self.useItem(itemId);
        //updateInventory(id, amount);
        //self.removeItem(id,amount);
        //self.refreshRender(); 
        // updatehealth(value);
    }

    inventoryButtons.forEach(function(button) {
        button.removeEventListener("click", handleItemClick);
        button.addEventListener("click", handleItemClick);
    });
};
    return self;
}

var Item = function(id, name, useFunction, imageUrl, eventFunction) { 
    var self = { 
        id: id, 
        name: name, 
        use: useFunction, 
        imageUrl: imageUrl, 
        event: eventFunction // Add event property 
    }; 
    
    Item.List[id] = self; 
    
    return self; 
}
Item.List = {};

function kibbleEvent() {
    updateHealth(10);
  
    
}

function treatEvent() {

    updateHealth(5);
   
}
function cannedFoodEvent() {

    updateHealth(15);
   
}
function boneEvent() {

    updateHappy(8);

}
function ballEvent() {

    updateHappy(15);

}
function mouseEvent() {

    updateHappy(10);

}

function shoelaceEvent() {
    
    updateHappy(5);

}

var inventory = Inventory();

var kibble = new Item("kibble", "Kibble", function() {
    var item = Item.List["kibble"];
    var itemAmount = 1;
}, "../images/bowl.png", kibbleEvent, 10);

var treat = new Item("treat", "Treat", function() {
    var item = Item.List["treat"];
    var itemAmount = 1;
}, "../images/bowl.png", treatEvent, 5);

var cannedfood = new Item("cannedfood", "Canned Food", function() {
    var item = Item.List["cannedfood"];
    var itemAmount = 1;
}, "../images/bowl.png", cannedFoodEvent, 15);

    
var ball = new Item("ball", "Ball", function() {
    var item = Item.List["ball"];
    var itemAmount = 1;
}, "../images/bowl.png", ballEvent, 15);

var bone = new Item("bone", "Bone", function() {
    var item = Item.List["bone"];
    var itemAmount = 1;
}, "../images/bowl.png", boneEvent, 8);
    
var mouse = new Item("mouse", "Mouse", function() {
    var item = Item.List["mouse"];
    var itemAmount = 1;
}, "../images/bowl.png", mouseEvent, 10);

var shoelace = new Item("shoelace", "Shoelace", function() {
    var item = Item.List["shoelace"];
    var itemAmount = 1;
}, "../images/bowl.png", shoelaceEvent, 10);



function Shop(currency) {
    var type = "<? echo $type; ?>";
    if(type == "cat"){
        var self = {
            currency: currency,
            items: [{id:"kibble", price: 5}, {id:"cannedfood", price: 7}, {id:"treat", price: 2}, {id:"mouse", price: 5},{id:"shoelace", price: 2}]
        };
    }else if(type == "dog"){
         var self = {
            currency: currency,
            items: [{id:"kibble", price: 5}, {id:"cannedfood", price: 7}, {id:"treat", price: 2}, {id:"bone", price: 3}, {id:"ball", price: 15}]
        };
    }
    self.buyItem = function(id, amount) {
        for(var i = 0 ; i < self.items.length; i++){
            if(self.items[i].id === id){
                var totalPrice = self.items[i].price * amount;
                if (totalPrice <= self.currency) {
                    inventory.addItem(id, amount);
                    self.currency -= totalPrice;
                    updateCoins(self.currency);
                    // console.log(self.currency);
                    return;
                } else{
                    document.getElementById("info").innerHTML = "Not enough currency to buy this item.";
                    return;
                }
            }
        }
        console.log("Item not found in the shop.");
    };

    // self.sellItem = function(id, amount) {
    //     for(var i = 0 ; i < self.items.length; i++){
    //         if(self.items[i].id === id){
    //             var totalPrice = self.items[i].price * amount;
    //             if (inventory.hasItem(id, amount)) {
    //                 inventory.removeItem(id, amount);
    //                 currency += totalPrice;
    //                 return;
    //             } else {
    //                 console.log("You don't have enough of this item to sell.");
    //                 return;
    //             }
    //         }
    //     }
    //     console.log("Item not found in the shop.");
    // };

    self.refreshRender = function() {
        var str = "";
        for(var i = 0 ; i < self.items.length; i++){
            let item = Item.List[self.items[i].id];
            str += "<button style=\"background-color:#00aaaa;\" onclick=\"shop.buyItem('" + item.id + "', 1)\">" + item.name + " | " + self.items[i].price + "<img src=\"images/newcon.png\" style=\"border:none;\" height=\"20\" width=\"20\"></button><br>";
            // str += "<button onclick=\"shop.sellItem('" + item.id + "', 1)\">Sell " + item.name + " for " + self.items[i].price + " currency</button><br>";
        }

        document.getElementById("shop").innerHTML = str;
    };

    return self;
}

var shop =  new Shop(currency);


inventory.refreshRender();
shop.refreshRender();

//https://www.google.com/search?sca_esv=984acc50bffcff5a&rlz=1C1CHBF_enUS1044US1044&q=canvas+html5+game+with+%22inventory%22&sa=X&ved=2ahUKEwij8b_awMWEAxWtmokEHWn0D0EQ5t4CegQIIhAB&biw=1536&bih=730&dpr=1.25&safe=active&ssui=on#fpstate=ive&vld=cid:976149b7,vid:gBUB2tYqknw,st:0
//https://www.youtube.com/watch?v=Tm-PXo9udWQ
     </script> 
     </div>
    </body>
</html>
<?
require("footer.php");
}//end login
else{
    header("Location: " . $config_basedir );
}
?>
