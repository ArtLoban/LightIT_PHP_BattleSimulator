<?php

namespace Services\BubbleSorter;

class BubbleSorter
{
    /**
     * Sort the array of Squad units
     *
     * @param array $units
     * @return array
     */
    public function sort(array $units): array
    {
        for ($j = 0; $j < count($units) - 1; $j++){
            for ($i = 0; $i < count($units) - $j - 1; $i++){
                // if $health property value of the current item is bigger than $health property of the next one
                if ($units[$i]->getHealth() > $units[$i + 1]->getHealth()){
                    // change their places
                    $tmp_var = $units[$i + 1];
                    $units[$i + 1] = $units[$i];
                    $units[$i] = $tmp_var;
                }
            }
        }

        return $units;
    }

}