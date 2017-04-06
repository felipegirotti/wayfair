<?php

namespace Wayfair\Minesweeper\Business\Validate;

class ValidatorInputs
{

    /**
     * @param array $board
     * @param $row
     * @param $column
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function validate(array $board, $row, $column)
    {
        if (!array_key_exists($row, $board)) {
            throw new \InvalidArgumentException("row {$row} not valid");
        }

        if (!array_key_exists($column, $board[$row])) {
            throw new \InvalidArgumentException("column {$column} not valid");
        }

        return true;
    }
}