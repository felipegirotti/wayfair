<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Wayfair\Minesweeper\Business\BoardGame,
    \Wayfair\Minesweeper\Business\Validate\ValidatorInputs,
    Wayfair\Minesweeper\Infrastructure\ViewCLI;

$board = [
    [0, 0, 0, 0],
    [0, 1, 0, 0],
    [0, 0, 1, 0],
    [1, 0, 0, 0],
];
$boardGame = new BoardGame($board, new ValidatorInputs());
$view = new ViewCLI();

echo PHP_EOL, "scenario 1", PHP_EOL;
$view->show($boardGame->uncover());
echo PHP_EOL, "scenario 2", PHP_EOL;
$view->show($boardGame->uncover(2, 1));
echo PHP_EOL, "scenario 3", PHP_EOL;
$view->show($boardGame->uncover(1, 2));
echo PHP_EOL, "scenario 4 end game", PHP_EOL;
$view->show($boardGame->uncover(1, 1));