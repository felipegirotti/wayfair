# Implement CLI version of a game similar to Minesweeper

### Sample board
``` php
$board = [
  [0, 0, 0, 0],
  [0, 1, 0, 0],
  [0, 0, 1, 0],
  [1, 0, 0, 0],
];
```

## Scenarios

- On game start a board is defined and a masked version of the board is displayed
expected output

```
 * * * *
 * * * *
 * * * *
 * * * *
```

- Users can uncover items on the board by passing the row and column they wish to uncover.	
Uncover expected output for uncovering row 2 column 1

```
* * * *
* * * *
* 3 * *
* * * *
```

- Consecutive uncover expected output for uncovering row 1 column 2

```
* * * *
* * 2 *
* 3 * *
* * * *
```

- When a user uncovers a bomb the game ends and all bombs are shown to the user

```
* * * *
* @ 2 *
* 3 @ *
@ * * *
```



## Run the unit tests (just simple):

`./phpunit`

## Run Game View

` php src/Minesweeper/Game.php`