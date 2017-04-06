<?php

namespace Wayfair\Minesweeper\Infrastructure;

class ViewCLI implements View
{

    public function show(array $board)
    {
        foreach ($board as $row) {

            foreach ($row as $column) {

                echo " {$column} ";

            }

            echo PHP_EOL;
        }
    }
}
