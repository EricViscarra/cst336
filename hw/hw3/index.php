<?php
function isValid() {
    if (isset($_GET["age"])) {
        if (!isset($_GET["gender"]) || empty($_GET["age"]) || empty($_GET["price"])) {
            echo "<div id = 'error'>";
            echo "<h1> ERROR: ALL FIELDS ARE NOT FILLED IN!</h1>";
            echo "</div>";
            return false;
        }
        else {
            return true;
        }
    }
    return false;
}

function findGift() {
    $male = array("football", "soccerball", "basketball", "watch", "childbook", "teenbook", "adultbook", "quiz", "pocketknife", "lego", "actionfigure", "car", "dartboard", "mug", "tie");
    $female = array("doll", "childbook", "teenbook", "adultbook", "purse", "quiz", "lego", "bracelet", "necklace", "car", "mug", "scarf", "sunglasses", "lotion");
    $child = array("basketball", "football", "soccerball", "childbook", "actionfigure", "doll", "puzzle", "lego", "car");
    $teen = array("basketball", "football", "soccerball", "watch", "wallet", "teenbook", "quiz", "puzzle", "pocketknife", "lego", "bracelet", "necklace", "dartboard", "scarf", "sunglasses", "lotion");
    $adult = array("watch", "wallet", "adultbook", "purse", "pocketknife", "bracelet", "necklace", "dartboard", "mug", "tie", "scarf", "sunglasses");
    $zeroten = array("lotion", "football", "soccerball", "basketball", "actionfigure", "doll", "puzzle", "childbook", "teenbook", "adultbook", "mug");
    $tentwentyfive = array("lotion", "football", "soccerball", "basketball", "lego", "pocketknife", "wallet", "quiz", "tie", "scarf", "sunglasses");
    $twentyfivefifty = array("watch", "bracelet", "necklace", "car", "purse", "dartboard");
    $ideas = array();
    if ($_GET["gender"] == "male") {
        $ideas = $male;
    }
    else {
        $ideas = $female;
    }
    if ($_GET["age"] < 13) {
        $ideas = array_intersect($ideas, $child);
    }
    else if ($_GET["age"] < 20) {
        $ideas = array_intersect($ideas, $teen);
    }
    else {
        $ideas = array_intersect($ideas, $adult);
    }
    if ($_GET["price"] == "010") {
        $ideas = array_intersect($ideas, $zeroten);
    }
    else if ($_GET["price"] == "1025") {
        $ideas = array_intersect($ideas, $tentwentyfive);
    }
    else {
        $ideas = array_intersect($ideas, $twentyfivefifty);
    }
    
    shuffle($ideas);
    $gift = array_pop($ideas);
    
    if ($gift == "actionfigure" || $gift == "basketball" || $gift == "football" || $gift == "quiz" || $gift == "soccerball") {
        echo "<img src='img/$gift.jpg' alt='$gift' />";
    }
    else {
        echo "<img src='img/$gift.JPG' alt='$gift' />";
    }
    
    if ($gift == "childbook" || $gift == "teenbook" || $gift == "adultbook") {
        $gift = "Book";
    }
    if ($gift == "actionfigure") {
        $gift = "Action Figure";
    }
    $gift = ucfirst($gift);
    
    echo "<div id = 'result'>";
    echo "<h2> You Should Get Them: $gift</h2>";
    echo "</div>";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Gift Ideas </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            
            <h1>Find The Perfect Gift For Your Recipient!</h1>
            
        </header>

        <main>
            <hr />
            <form method "GET">
                <div id="first">
                    My gift is for: <br />
                    Him
                    <input type="radio" name="gender" value="male"
                    <?= ($_GET['gender'] == "male")?" checked":"" ?> ><br>
                    Her
                    <input type="radio" name="gender" value="female"
                    <?= ($_GET['gender'] == "female")?" checked":"" ?> ><br>
                </div>
                <hr />
                <div id="second">
                    How old is the recipient? (1-100) <br />
                    <input type="number" name="age" min="1" max="100" value="<?=$_GET['age']?>" > <br/>
                </div>
                <hr />
                <div id="third">
                    How much would you like to spend on this gift? <br />
                    <select name="price">
                        
                        <option value="">Select One</option>
                        <option <?= ($_GET['price'] == "010")?" selected":"" ?> value="010">Under $10</option>
                        <option <?= ($_GET['price'] == "1025")?" selected":"" ?> value="1025">$10-$25</option>
                        <option <?= ($_GET['price'] == "2550")?" selected":"" ?> value="2550">$25-$50</option>
                        
                    </select>
                </div>
                <br />
                <input type="submit" value="Find Gift!">
                
            </form>
            
            <?php
                if (isValid()) {
                    findGift();
                }
            ?>
        </main>
        
        <footer>
            
            <hr>
            
            CST336 Internet Programming. 2018 &copy; Eric Orozco Viscarra <br />
            
            <strong>Disclaimer:</strong> The information in this website is ficticious. <br /> It is used for academic purposes only. <br />
            <br />
            
            <img src="../../img/csumb.png" alt="CSUMB logo" />
            <img src="../../img/buddy.png" alt="Buddy Ribbon" />
            
        </footer>
    </body>
</html>