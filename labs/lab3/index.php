<!DOCTYPE html>
<html>
    <head>
        <title>Silver Jack</title>
        <meta charset="utf-8"/>
        <link href="https://fonts.googleapis.com/css?family=Diplomata+SC" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Londrina+Outline" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css">
    </head>
    </br>
    <header>
        <h1 id= 'silverJack'><strong>Silver Jack</strong></h1>
    </header>
    <body>
       
        
        <?php
            include "core/Game.php";
            $game = new Game();
            $game->play();
        ?>

        
        <footer>
            <hr>
             CST 336: Group Project<br />
            <strong>Members:</strong> <small>Elizabeth Limon, Andy Kor, Jeremy Shaw, Eric Orozco.</small>
            <br />
            Silver Jack
            <br />
        </footer>
    </body>
</html>