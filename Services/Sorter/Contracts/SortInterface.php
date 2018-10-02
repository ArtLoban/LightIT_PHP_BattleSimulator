<?php

namespace Services\Sorter\Contracts;

interface SortInterface
{
    /**
     * @param array $items
     * @return array
     */
    public function sort(array $items): array;
}