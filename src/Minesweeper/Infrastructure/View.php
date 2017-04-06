<?php

namespace Wayfair\Minesweeper\Infrastructure;

interface View
{
    public function show(array $board);
}