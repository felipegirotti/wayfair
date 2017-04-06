<?php

namespace Wayfair\Minesweeper\Business;

use Wayfair\Minesweeper\Business\Validate\ValidatorInputs;

class BoardTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var BoardGame
     */
    private $boardGame;

    public function setUp() {
        $board = [
            [0, 0, 0, 0],
            [0, 1, 0, 0],
            [0, 0, 1, 0],
            [1, 0, 0, 0],
        ];

        $this->boardGame = new BoardGame($board, new ValidatorInputs());
    }

    public function testStartGame()
    {
        $board = $this->boardGame->uncover();
        foreach ($board as $row) {
            foreach ($row as $column) {
                $this->assertEquals("*", $column);
            }
        }
    }

    public function testScenarioRow2Column1()
    {
        $board = $this->boardGame->uncover(2, 1);
        for ($row = 0; $row < count($board); $row++) {
            for ($column = 0; $column < count($board[$row]); $column++) {
                if ($row == 2 && $column == 1) {
                    $this->assertEquals("3", $board[2][1]);
                } else {
                    $this->assertEquals("*", $board[$row][$column]);
                }
            }
        }
    }

    public function testScenario3Row1Column2()
    {
        $this->boardGame->uncover(2, 1);
        $board = $this->boardGame->uncover(1, 2);
        for ($row = 0; $row < count($board); $row++) {
            for ($column = 0; $column < count($board[$row]); $column++) {
                if ($row == 2 && $column == 1) {
                    $this->assertEquals("3", $board[2][1]);
                } elseif ($row == 1 && $column == 2) {
                    $this->assertEquals("2", $board[$row][$column]);
                } else {
                    $this->assertEquals("*", $board[$row][$column]);
                }
            }
        }
    }

    public function testScenario4EndGame()
    {
        $this->boardGame->uncover(2, 1);
        $this->boardGame->uncover(1, 2);
        $board = $this->boardGame->uncover(1, 1);
        $bombs = ["11", "22", "30"];
        for ($row = 0; $row < count($board); $row++) {
            for ($column = 0; $column < count($board[$row]); $column++) {
                if ($row == 2 && $column == 1) {
                    $this->assertEquals("3", $board[2][1]);
                } elseif ($row == 1 && $column == 2) {
                    $this->assertEquals("2", $board[$row][$column]);
                } elseif (in_array("{$row}{$column}", $bombs)) {
                    $this->assertEquals("@", $board[$row][$column]);
                } else {
                    $this->assertEquals("*", $board[$row][$column]);
                }
            }
        }
    }
}