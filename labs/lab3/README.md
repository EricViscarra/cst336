# CST336_SilverJack

Rubric:
    Each of 4 players gets the necessary cards to get close to 42
    The cards are not duplicated
    The total points per player is displayed properly
    The winner(s) is(are) displayed properly with the earned points
    
    Players' pictures and corresponding names are displayed RANDOMLY
    
    Your contribution in GitHub is similar to your teammates
    The average elapsed time is less than 1 second and shown on the page
    There is an external CSS file with at least 10 rules
    
Andy: +
Eric: @
Elizabeth: #
Jeremy: $

Front-End:
- index.php $ #
-   displaying players' pictures + name randomly.
-   using php functions to display cars + points

- styles.css -> styling the webpage + formatting #


Back-End:
- Player.php: holds an image + name, functions: displayPlayer(), displayName(), displayPoints(), displayHand() +
- Card.php: hold path to images, card value @
- Deck.php: holds Card objects @
- Game.php: holds players, holds deck, functions: logic checking, point checking, what to on win, etc. #