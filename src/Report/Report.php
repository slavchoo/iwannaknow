<?php

declare(strict_types=1);

namespace App\Report;

use IteratorAggregate;
use Traversable;
use ArrayIterator;

class Report implements IteratorAggregate
{
    private $items = [];

    public function __construct(iterable $items = [])
    {
        $this->items = $items;
    }

    public function addItem(array $item)
    {
        $this->items[] = $item;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}
