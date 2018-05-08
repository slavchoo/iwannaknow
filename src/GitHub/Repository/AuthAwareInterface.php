<?php

declare(strict_types=1);

namespace App\GitHub\Repository;

interface AuthAwareInterface
{
    public function authinteficate($token);
}
