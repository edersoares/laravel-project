<?php

namespace App\Contracts;

interface Repository
{
    public function storage($storage);

    public function all();

    public function one();
}