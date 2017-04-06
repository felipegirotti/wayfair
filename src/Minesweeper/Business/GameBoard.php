<?php

namespace Wayfair\Minesweeper\Business;
use Wayfair\Minesweeper\Business\Validate\ValidatorInputs;

/**
 * Created by PhpStorm.
 * User: felipegirotti
 * Date: 4/5/17
 * Time: 11:07 PM
 */
class BoardGame
{
    /**
     * @var array
     */
    private $board = [];
    /**
     * @var ValidatorInputs
     */
    private $validator;

    /**
     * @param array $board
     * @param ValidatorInputs $validateInputs
     */
    public function __construct(array $board, ValidatorInputs $validateInputs)
    {
        $this->board = $board;
        $this->boardShow = $this->cloneEmptyBoard($board);
        $this->validator = $validateInputs;
    }

    private function cloneEmptyBoard(array $board)
    {
        $flat = array();

        for ($row = 0; $row < count($board); $row++) {
            for ($column = 0; $column < count($board[$row]); $column++) {
                $flat[$row][$column] = "*";
            }
        }

        return $flat;
    }

    /**
     * @param null $row
     * @param null $column
     * @return array|void
     */
    public function uncover($row = null, $column = null)
    {
        if (is_null($row) || is_null($column)) {
            return $this->boardShow;
        }

        if ($this->board[$row][$column] === 1) {
            return $this->endGame();
        }

        $this->validator->validate($this->board, $row, $column);

        $bombs = $this->discoveryBombsAround($row, $column);

        $this->boardShow[$row][$column] = $bombs;

        return $this->boardShow;
    }

    private function discoveryBombsAround($row, $column)
    {
        $rowsSearch = $this->combAround($row);
        $columnsSearch = $this->combAround($column);
        $bombs = 0;
        foreach ($rowsSearch as $rowSearch) {
            if ($this->board[$rowSearch]) {
                $bombs += $this->totalBombsColumns($this->board[$rowSearch], $columnsSearch);
            }
        }

        return $bombs;
    }

    private function totalBombsColumns(array $boardRow, array $columnsSearch) {
        $bombs = 0;
        foreach ($columnsSearch as $columnSearch) {

            if ($boardRow[$columnSearch]) {
                $bombs += $boardRow[$columnSearch];
            }

        }

        return $bombs;
    }


    private function combAround($number)
    {
        return [$number -1, $number, $number + 1];
    }

    private function endGame()
    {
        for ($row = 0; $row < count($this->board); $row++) {
            for ($column = 0; $column < count($this->board[$row]); $column++) {
                if ($this->board[$row][$column] === 1) {
                    $this->boardShow[$row][$column] = "@";
                }
            }
        }

        return $this->boardShow;
    }
}