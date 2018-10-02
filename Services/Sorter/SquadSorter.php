<?php

namespace Services\Sorter;

use App\Models\Squad;
use Services\Sorter\Contracts\SortInterface;

class SquadSorter implements SortInterface
{
    /**
     * @param array $allSquads
     * @return array
     */
    public function sort(array $allSquads): array
    {
        uasort($allSquads, function (Squad $a, Squad $b) {
            if ($a->getHealth() === $b->getHealth()) {
                return 0;
            }

            return $a->getHealth() > $b->getHealth() ? 1 : -1;
        });

        return $allSquads;
    }
}