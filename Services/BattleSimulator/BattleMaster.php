<?php

namespace Services\BattleSimulator;

use App\Models\Squad;
use Services\BattleLogger\BattleLogger;

class BattleMaster
{
    /**
     * @var BattleLogger
     */
    private $logger;

    /**
     * BattleMaster constructor.
     */
    public function __construct(BattleLogger $battleLogger)
    {
        $this->logger = $battleLogger;
    }

    /**
     * Determine the winner by comparing the attack probabilities
     * If attacking Squad unit wins all its members receive experience
     * If defending Squad unit loses it suffers the damage
     *
     * @param Squad $attacker
     * @param Squad $defender
     */
    public function runBattle(Squad $attacker, Squad $defender): void
    {
        $attackerProbability = $attacker->calculateAttackProbability();
        $defenderProbability = $defender->calculateAttackProbability();

        if ($attackerProbability >= $defenderProbability) {
            // Winner receives the experience
            $this->gainExperience($attacker);

            // Loser suffers damage
            $damage = $attacker->calculateDamage();
            $this->receiveDamage($defender, $damage);
            $this->writeLogs($attacker, $defender, $damage);

            // Remove composed units from defending Squad unit if they hove no more health
            $this->dieIfWasted($defender);
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
        $units = $squad->getUnits();
        foreach ($units as $unit) {
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
        foreach ($squad->getUnits() as $unit) {
            if ($unit->getHealth() <= 0) {
                $squad->removeUnit($unit);
            }
        }
    }

    /**
     * @param Squad $attacker
     * @param Squad $defender
     * @param float $damage
     */
    private function writeLogs(Squad $attacker, Squad $defender, float $damage): void
    {
        $attackingSquadArmyId = $attacker->getArmyId();
        $attackingSquadId = $attacker->getSquadId();
        $defendingSquadArmyId = $defender->getArmyId();
        $defendingSquadId = $defender->getSquadId();

        $this->logger->logFight(
            $attackingSquadArmyId,
            $attackingSquadId,
            $defendingSquadArmyId,
            $defendingSquadId,
            $damage
        );
    }
}
