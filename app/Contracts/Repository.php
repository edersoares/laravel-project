<?php

namespace App\Contracts;

interface Repository
{
    public function all();

    public function one();
}