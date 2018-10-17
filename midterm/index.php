<?php
session_start();

if (strcmp($_GET['month'], "")!=0 && isset($_GET['num'])) {
    
}
else {
    echo "<h1>Error: You have to select a month and how many locations you would like to visit</h1>";
}

function makeCalender() {
    if ($_GET['month'] == "November") {
        $days = 30;
    }
    else if ($_GET['month'] == "December") {
        $days = 31;
    }
    else if ($_GET['month'] == "January") {
        $days = 31;
    }
    else {
        $days = 28;
    }
    $France = array("bordeaux", "le_havre", "lyon", "montpellier", "paris", "strasbourg");
    $Mexico = array("acapulco", "cabos", "cancun", "chichenitza", "huatulco", "mexico_city");
    $USA = array("chicago", "hollywood", "las_vegas", "ny", "washington_dc", "yosemite");
    $arr = array();
    shuffle($France);
    shuffle($Mexico);
    shuffle($USA);
    if ($_GET['country'] == "France") {
        $picked = $France;
        $country = $_GET['country'];
    }
    else if ($_GET['country'] == "Mexico") {
        $picked = $Mexico;
        $country = $_GET['country'];
    }
    else {
        $picked = $USA;
        $country = $_GET['country'];
    }
    $randDays = array();
    for ($i=0; $i < $_GET['num']; $i++) {
        array_push($arr, array_pop($picked));
        $randDay = rand(0, $days);
        while (in_array($randDay, $randDays)) {
            $randDay = rand(0, $days);
        }
        array_push($randDays, $randDay);
    }
    if ($_GET['alpha'] == 2) {
        rsort($arr);
    }
    else if ($_GET['alpha'] == 1) {
        sort($arr);
    }
    
    for ($i = 0; $i < $days; $i++) {
        $num = $i+1;
        if ($i%7 == 0) {
            echo "<tr>";
        }
        echo "<td>$num";
        if (in_array($i, $randDays)) {
            $name = array_pop($arr);
            echo "<br />";
            echo "<img src='img/".$country."/".$name.".png' />";
            echo "<br />";
            $name = str_replace('_', ' ', $name);
            echo ucwords($name);
        }
        echo "</td>";
        if ($i%7 == 6) {
            echo "</tr>";
        }
    }
    $monthA = $_GET['month'];
    $number = $_GET['num'];
    $_SESSION["$monthA"] = "Month: $monthA, Visiting $number places in $country";
}

function monthly() {
    if (isset($_SESSION['November'])) {
        echo $_SESSION['November'];
        echo "<br/>";
    }
    if (isset($_SESSION['December'])) {
        echo $_SESSION['December'];
        echo "<br/>";
    }
    if (isset($_SESSION['January'])) {
        echo $_SESSION['January'];
        echo "<br/>";
    }
    if (isset($_SESSION['February'])) {
        echo $_SESSION['February'];
        echo "<br/>";
    }
}
function isValid () {
    if (strcmp($_GET['month'], "")!=0 && isset($_GET['num'])) {
       return true; 
    }
    else {
        return false;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Midterm Winter Planner!</title>
        <style>
            
            body {
                text-align:center;
            }
            table {
                outline: solid black 1px;
            }
            
        </style>
    </head>
    <body>
        <header> 
            <h1> Winter Vacation Planner</h1>
        </header>
        
        <form action="index.php" method="GET">
            
            Select Month:
            <select name="month">
                
                <option value=""> Select</option>
                <option <?= ($_GET['month'] == "November")?" selected":"" ?> value="November">November</option>
                <option <?= ($_GET['month'] == "December")?" selected":"" ?> value="December">December</option>
                <option <?= ($_GET['month'] == "January")?" selected":"" ?> value="January">January</option>
                <option <?= ($_GET['month'] == "February")?" selected":"" ?>value="February">February</option>
                
            </select>
            <br />
            <br />
            Number of locations: 
            <input type="radio" name="num" value=3> <strong>Three</strong>
            <input type="radio" name="num" value=4> <strong>Four</strong>
            <input type="radio" name="num" value=5> <strong>Five</strong>
            
            <br />
            <br />
            Select Country:
            <select name="country">
                
                
                <option value="USA">USA</option>
                <option <?= ($_GET['country'] == "Mexico")?" selected":"" ?> value="Mexico">Mexico</option>
                <option <?= ($_GET['country'] == "France")?" selected":"" ?> value="France">France</option>
            </select>
            
            <br />
            <br />
            Visit locations in alphabetical order: 
            
            <input type="radio" name="alpha" value=1> <strong>A-Z</strong>
            <input type="radio" name="alpha" value=2> <strong>Z-A</strong>
            
            <br />
            <br />
            
            <input type="submit" value="Create Itinerary">
        </form>
        
        
        
        <calender>
            
            <?php
            if (isValid()) {
                echo "<br /> <br />";
                echo $_GET['month'];
            ?>
            Itinerary
            <table align ="center" border = 1 style="width: 75%">
                <?= makeCalender(); ?>
            </table>
            <?php
            }
            ?>
        </calender>
        
        <monthly>
            
            Monthly Itinerary
            <br/>
            <br/>
            <?= monthly(); ?>
        </monthly>
    </body>
</html>