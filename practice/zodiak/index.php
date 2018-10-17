<?php
global $animals;
$animals = array("rat","ox","tiger","rabbit","dragon","snake","horse","goat","monkey","rooster","dog","pig");
function yearList($rows = 1, $columns = 1) {
    $startYear = 2020;
    $endYear = 2020+ ($rows*$columns);
    global $animals;
    $sum = 0;
    for ($i=$startYear; $i<=$endYear; $i++) {
        if (($i-2020)%$row == 0) {
            echo "<tr> Year $i";
        }
        echo "<td>";
        if ($i == 1776) {
            echo "<strong> USA INDEPENDENCE!</strong>";
        }
        if ($i % 100 == 0) {
            echo "<strong> Happy New Century!</strong>";
        }
        if ($i%13==2) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==3) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==4) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==5) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==6) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==7) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==8) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==9) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==10) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==11) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==12) {
            echo "<img src='img/".$animals[($i%13)-2].".png' alt='".$animals[($i%13)-2]."'";
        }
        else if ($i%13==0) {
            echo "<img src='img/".$animals[($i%13)+11].".png' alt='".$animals[($i%13)+11]."'";
        }
        else {
             echo "<img src='img/".$animals[($i%13)+10].".png' alt='".$animals[($i%13)+10]."'";
        }
        echo "</td>";
        $count += $i;
        if (($i-2020)%$row == $row-1) {
            echo "<tr> Year $i";
        }
    }
    return $sum;
}
//"rat","ox","tiger","rabbit","dragon","snake","horse","goat","monkey","rooster","dog","pig"

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Chinese Zodiac Tasks</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <main>
            <h1> Chinese Zodiak List</h1>
            
            <form method="GET">
                
                Rows: 
                <input type="number" name = "rows" >
                <br />
                Columns:
                <input type="number" name = "columns" >
                <input type="submit" value = "Submit!" >
            </form>
            <table style = "width:75%">
                <?php
                    echo yearList($_GET['rows'], $_GET['columns']);
                ?>
            </table>
        </main>
       

    </body>
</html>