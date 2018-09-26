<?php
include 'inc/Game.php';

session_start();

$_SESSION["status"] = "on";
?>
<!DOCTYPE html>
<html>
    <head>
        <title> CST336 Eric's Tic-Tac-Toe</title>
        
        <style>
            @import url("css/styles.css");
        </style>
        
        
    </head>
    <body>
        <header>
            
            <h1>Tic Tac Toe Arena</h1>
            
        </header>
        
        <div id="main">

            <form action = "index.php" method="post">
                <h2>Where Do You Want To Mark:</h2> <br />
                T=Top, C=Center, B=Bottom, L=Left, R=Right <br /> <br />
                    <input type="radio" name="position"
                    <?php if (isset($position) && $position==0) echo "checked";?>
                    value="0">TL
                    <input type="radio" name="position"
                    <?php if (isset($position) && $position==1) echo "checked";?>
                    value="1">TC
                    <input type="radio" name="position"
                    <?php if (isset($position) && $position==2) echo "checked";?>
                    value="2">TR <br /> <br />
                    <input type="radio" name="position"
                    <?php if (isset($position) && $position==3) echo "checked";?>
                    value="3">CL
                    <input type="radio" name="position"
                    <?php if (isset($position) && $position==4) echo "checked";?>
                    value="4">CC
                    <input type="radio" name="position"
                    <?php if (isset($position) && $position==5) echo "checked";?>
                    value="5">CR <br /> <br />
                    <input type="radio" name="position"
                    <?php if (isset($position) && $position==6) echo "checked";?>
                    value="6">BL
                    <input type="radio" name="position"
                    <?php if (isset($position) && $position==7) echo "checked";?>
                    value="7">BC
                    <input type="radio" name="position"
                    <?php if (isset($position) && $position==8) echo "checked";?>
                    value="8">BR <br />
                    <input type="submit">
            </form>
            <br />
        </div>
        <div id="boardLeft"> </div>
        <div id="boardRight"> </div>
        <div id="boardTop"> </div>
        <div id="boardBot"> </div>
            <?php
            if (isset($_POST["position"])) {
                if (!play($_POST["position"])) {
                    echo "
                        <div id='incorrect'>
                            This location has already been used, <br />
                            please choose another location!
                        </div>
                        ";
                }
            }
            if (isset($_SESSION["end"])) {
                $last = $_SESSION["game"];
                $last->forceEnd();
            }
            if (isset($_SESSION["result"])) {
                if (strcmp($_SESSION["result"], win) == 0) {
                    echo "
                        <div id='result'>
                            YOU WON!
                        </div>
                        ";
                        session_destroy();
                }
                else if (strcmp($_SESSION["result"], lose) == 0) {
                    echo "
                        <div id='result'>
                            YOU LOST!
                        </div>
                        ";
                        session_destroy();
                }
                else {
                    echo "
                        <div id='result'>
                            YOU TIED!
                        </div>
                        ";
                        session_destroy();
                }
            }
            ?>
            <footer>
            <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
            <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
            <hr>
            
            CST336 Internet Programming. 2018 &copy; Eric Orozco Viscarra <br />
            
            <strong>Disclaimer:</strong> The information in this website is ficticious. <br /> It is used for academic purposes only. <br />
            <br />
            
            <img src="../../img/csumb.png" alt="CSUMB logo" />
            <img src="../../img/buddy.png" alt="Buddy Ribbon" />
            
        </footer>
    </body>
</html>