<?php

namespace Services\BattleSimulator;

use App\Models\Squad;

class BattleMaster
{
    /**
     * Determine the winner by comparing the attack probabilities
     * If attacking Squad unit wins all its members receive experience
     * If defending Squad unit loses it suffers the damage
     *
     * @param array $rivals
     */
    public function runBattle(array $rivals): void
    {
        $attackerProbability = $rivals['attacker']->calculateAttackProbability();
        $defenderProbability = $rivals['defender']->calculateAttackProbability();

        if ($attackerProbability >= $defenderProbability) {
            // Winner receives the experience
            $this->gainExperience($rivals['attacker']);

            // Loser suffers damage
            $damage = $rivals['attacker']->calculateDamage();

            $this->receiveDamage($rivals['defender'], $damage);

            // Remove composed units from defending Squad unit if they hove no more health
            $this->dieIfWasted($rivals['defender']);
        }

        return;
    }

    /**
     * @param Squad $squad
     */
    private function gainExperience(Squad $squad): void
    {
        $squad->incrementExperience();
    }

    /**
     * @param Squad $squad
     * @param float $damage
     */
    private function receiveDamage(Squad $squad, float $damage): void
    {
        foreach ($squad->getUnits() as $unit) {
            $unit->receiveDamage($damage);
        }
    }

    /**
     * Remove units from Squad if their health value drops sub zero
     *
     * @param Squad $squad
     */
    private function dieIfWasted(Squad $squad): void
    {
        foreach ($squad->getUnits() as $key => $unit) {
            if ($unit->getHealth() <= 0) {
                $wastedUnit = $squad->getUnits()[$key];
                $squad->removeUnit($wastedUnit);
            }
        }
    }

}